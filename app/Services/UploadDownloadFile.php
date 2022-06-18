<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use App\Models\Properties\TemporaryFile;
use Illuminate\Support\Facades\Storage;

class UploadDownloadFile
{
  # TEMPORARY FILES 
  ## Public
  public function HandleGetFileBytimesLess($minuts)
  {
    $formatted_date = Carbon::now()->subMinutes($minuts)->toDateTimeString();
    return TemporaryFile::where('created_at', '<=', $formatted_date)->get();
  }

  public function HandleCreateRecord($file, $folder, $location)
  {
    $storedName = basename(Storage::disk('public')->put($location, $file));
    $created = TemporaryFile::create(['folder' => $folder, 'filename' => $storedName]);

    if ($created->id > 0) {
      return $storedName;
    }else {
      $file_path = $location . $storedName;
      if (Storage::disk('public')->exists($file_path)) {
        Storage::disk('public')->delete($file_path);
      }

      return '';
      // $uploadDownloadFile->HandleDestroyRecord($temporaryFile);
    }

    // return (!is_null($storedName) && $created->id > 0) ? $storedName : '';
  }

  public function HandleDestroyRecord(TemporaryFile $temporaryFile)
  {
    return $temporaryFile->delete();
  }



  ## =====================================================================================
  ## Protected



  # ========================================================================================
  ## RENTS
  ## Public


  ## =====================================================================================
  ## Protected



  # ========================================================================================
  ## SHARED
  ## Public


  ## =====================================================================================
  ## Private



  ## =====================================================================================
  ## Protected





  ## =====================================================================================


        // $file = $request->file('leftImage');
        // $filename = $file->getClientOriginalName();
        // $folder = 'left'; //uniqid() . '-' . now()->timestamp;
        // // $storedName = $file->store($file_location. 'tmp/'. $folder);
        // $storedName = basename(Storage::disk('public')->put($file_location, $file));

        // // TemporaryFile::create(['folder' => $folder, 'filename' => basename($storedName)]);

        // // session()->put('temporaryHouseFolder', []);
        // # store it-in session for delete them before end of this session
        // if (session()->has('temporaryHouseFolder')) {
        //     $temporaryHouseFolder = session()->get('temporaryHouseFolder');
        //     $temporaryHouseFolder[$folder] = $storedName;
        // } else {
        //     $temporaryHouseFolder[$folder] = $storedName;
        // }

        // session()->put('temporaryHouseFolder', $temporaryHouseFolder);
}
