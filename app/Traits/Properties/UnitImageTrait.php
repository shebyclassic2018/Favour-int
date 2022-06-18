<?php

namespace App\Traits\Properties;

use Illuminate\Support\Str;
use App\Models\Properties\Unit;
use App\Interfaces\MessageBrocker;
use App\Models\Properties\UnitImage;

/**
 * 
 */
trait UnitImageTrait
{
  protected $status = false;
  protected $message = null;
  protected $content = null;


  protected function deleteUnitImage($image)
  {
    # check if image exist in DB;
    $imageExist = $this->doesImageExistById($image);
    if(is_null($imageExist)) {
      $this->status  = false;
      $this->message = 'No image related to information sent';
    }

  
    if(!is_null($imageExist)) {
      # check if the filename exist in db must not be deleted in storage.
      $existFileExist = $this->doesFilenameExistInDb($image->imageid, $imageExist->path);

      // if ($existFileExist->count() <= 0) {
      //   # remove file in storage
      //   $location = env('HOUSE_REPO') . 'houses/';
      //   $removeResponse = false;
      //   // $removeResponse = ($this->removeFileFromStorage($existFileExist->path, $location)) ?? true;
      // }

      $removeResponse = ($existFileExist->count() <= 0) ? $this->removeFileFromStorage($imageExist->path, env('HOUSE_REPO') . 'houses/') : true;

      # Delete from the DB
      $deletingResponse = $removeResponse ? $this->deleteImage($imageExist) : false;

      # Response.
      $this->status  = $deletingResponse ? true : false;
      $this->message = $this->status ? 'Image Deleted Successfully' : MessageBrocker::DELETING_FAILED;
      $this->content = $this->status ? $imageExist->id : null;
    }

    return $this->callback();
  }

  protected function doesFilenameExistInDb($id, $filename)
  {
    return UnitImage::where('id','!=', $id)->where('path', $filename)->get();
  }

  protected function doesImageExistById($image)
  {
    return UnitImage::where('id', $image->imageid)
      ->where('elevation', Str::lower($image->elevation))
      ->first();
  }

  protected function removeFileFromStorage($filename, $location) {
    return deleteFileInstorage($filename, $location);
  }

  protected function deleteImage(UnitImage $unitImage) {
    return $unitImage->delete();
  }

  protected function callback() {
    return getEncodedDecodedJson([
      'status'  => $this->status,
      'message' => $this->message,
      'content' => $this->content
    ]);
  }
}
