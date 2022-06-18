<?php

namespace App\Traits\Facilities;

use Throwable;
use Illuminate\Support\Str;
use App\Models\Services\Rent;
use App\Interfaces\MessageBrocker;
use App\Models\Properties\Facility;
use App\Models\Facilities\MapCategory;
use App\Models\Facilities\FacilityCategory;

/**
 * 
 */
trait FacilitiesTrait
{

  protected $message = null;
  protected $status  = false;
  protected $code    = 404;

  ## SHARED BY ALL BROCK

  protected function FacilitiyResponse()
  {
    return [
      'code'    => $this->code,
      'status'  => $this->status,
      'message' => $this->message
    ];
  }


  ## FACILITY
  protected function getAllFacilities()
  {
    $allFacilities = Facility::orderBy('name', 'asc')->get();
    return $allFacilities;
  }

  protected function getAllFacilitiesByPages()
  {
    $allFacilities = Facility::orderBy('type', 'asc')->paginate(16);
    return $allFacilities;
  }

  protected function storeFacilitiy($data)
  {
    $preparedData = [
      'name' => Str::ucfirst($data['name']), 
      'icon' => Str::lower($data['icon']), 
      'type' => Str::lower($data['type'])
    ];

    $exist = $this->checkFacilitiyByName($preparedData['name']);

    if(is_null($exist)) {
      $created = Facility::create($preparedData);
      if ($created->id > 0) {
        $this->message = 'Created Successfuly!';
        $this->code    = 200;
        $this->status  = true;
      }else {
        $this->message = __(MessageBrocker::GENERAL_FAIL);
        $this->status  = false;
      }
    }else {
      $this->message = 'Facility '.$data["name"].' exist! in our records';
      $this->status  = true;
      $this->code    = 201;
    }
    

    return $this->FacilitiyResponse();
  }

  protected function checkFacilitiyByName($name)
  {
    return Facility::where('name', $name)->first();
  }

  protected function checkFacilitiyById($id)
  {
    return Facility::findOrFail($id);
  }


  ## FACILITY CATEGORIES
  protected function facilityCategoryWith()
  {
    return FacilityCategory::with('mapCategoryFacilities');
  }

  protected function facilitiyCategoryById($id)
  {
    return $this->facilityCategoryWith()->findOrFail($id);
  }

  protected function allFacilityCategories()
  {
    return $this->facilityCategoryWith()
      ->orderBy('name', 'asc')
      ->get();
  }

  protected function facilityCategoriesByPages()
  {
    return $this->facilityCategoryWith()
      ->orderBy('name', 'asc')
      ->paginate(4);
  }

  protected function storeFacilitiyCategory($data)
  {
    $name = $data['name'];
    $exist = $this->checkFacilitiyCategoryByName($name);
    if (is_null($exist)) {
      $preparedData = ['name' => Str::ucfirst($name), 'slug' => Str::slug($name)];
      $created      = FacilityCategory::create($preparedData);
      if ($created->id > 0) {
        $this->message = 'Created Successfuly!';
        $this->code    = 200;
        $this->status  = true;
      }else {
        $this->message = __(MessageBrocker::GENERAL_FAIL);
        $this->status  = false;
      }
    }else {
      $this->message = 'Facilitiy Category '.$name.' exist! in our records';
      $this->status  = true;
      $this->code    = 201;
    }

    return $this->FacilitiyResponse();
  }

  protected function checkFacilitiyCategoryByName($name)
  {
    return FacilityCategory::where('name', $name)->first();
  }


  ## MAP FACILITY CATEGORIES
  protected function mapFacilitiyCategoryById($id)
  {
    return MapCategory::findOrFail($id);
  }

  protected function mapFacilitiyCategoriesList()
  {
    return MapCategory::orderBy('id', 'asc')->get();
  }

  protected function mapFacilitiyCategoriesByPages()
  {
    return MapCategory::orderBy('id', 'asc')->paginate(16);
  }

  protected function mapFacilitiyCategoryPost($data)
  {
    try {
      $facilitiyCategory = $this->facilitiyCategoryById((int)$data['facility_type']);
      $facilities = $data['facilities'];
      $status   = (isset($data['status']) && $data['status'] == 'on') ? true : false;

      foreach ($facilities as $facility) {
        $exist = $this->checkCategoryFacilityExist($facilitiyCategory->id, $facility);
        if (is_null($exist)) {
          $facilitiyCategory->mapCategoryFacilities()->create(['facility_id' => $facility, 'status' => $status]);
        }
      }

      $this->message = 'Facilitiy Maped to ' . $facilitiyCategory->name . ' Successfuly!';
      $this->code    = 200;
      $this->status  = true;
      return getEncodedDecodedJson($this->FacilitiyResponse());
    } catch (Throwable $th) {
      //throw $th;
      #TODO: Send $th->getNessage() notification to admin
      $this->message = __(MessageBrocker::GENERAL_FAIL);
      $this->status  = false;
      dd(getEncodedDecodedJson($this->FacilitiyResponse()));
      return getEncodedDecodedJson($this->FacilitiyResponse());
    }





    // if (is_null($exist)) {
    //   $preparedData = ['facility_id' => $facility, 'status' => $status];
    //   $created      = $facilitiyCategory->mapCategoryFacilities()->create($preparedData);;
    //   if ($created->id > 0) {
    //     $this->message = 'Facilitiy Maped to ' . $created->facilityCategory->name . ' Successfuly!';
    //     $this->code    = 200;
    //     $this->status  = true;
    //   } else {
    //     $this->message = __(MessageBrocker::GENERAL_FAIL);
    //     $this->status  = false;
    //   }
    // } else {
    //   $this->message = 'Facilitiy arleady Maped to ' . $exist->facilityCategory->name . ' in our records';
    //   $this->status  = true;
    //   $this->code    = 201;
    // }

    // return $this->FacilitiyResponse();

  }

  protected function mapFacilitiyCategoryPreUpdate($targetId, $request)
  {

    if($targetId != (int)$request['facility_type']) {
      $this->message = 'Target ID missmatch!!';
      return getEncodedDecodedJson($this->FacilitiyResponse());
    }

    $status   = (isset($data['status']) && $data['status'] == 'on') ? true : false;
    $facilitiyCategory = $this->facilitiyCategoryById($targetId);

    $existFacilities   = $facilitiyCategory->mapCategoryFacilities->pluck('facility_id');
    $newFacilities     = $request['facilities'];
    $removedFacilities = [];

    foreach ($existFacilities as $existFacility) {
      if (!in_array($existFacility, $newFacilities)) {
        array_push($removedFacilities, $existFacility);
      }
    }

    $target = $facilitiyCategory->mapCategoryFacilities;


    # Update
    $updatedStatus = $this->mapFacilitiyCategoryUpdate($facilitiyCategory, $newFacilities, $status);


    # Delete if any
    if (count($removedFacilities) > 0) {
      $deletedStatus = $this->mapFacilitiyCategoryDeleteArray($facilitiyCategory, $removedFacilities);
    }

    if ($updatedStatus) {
      $this->message = 'Facilitiy Maped to ' . $facilitiyCategory->name . ' Successfuly!';
      $this->code    = 200;
      $this->status  = true;
    }
 
    return getEncodedDecodedJson($this->FacilitiyResponse());
  }

  protected function mapFacilitiyCategoryUpdate($targetId, $data, $status)
  {
    try {
      foreach ($data as $facility_id) {
        $targetId->mapCategoryFacilities()->updateOrCreate(['facility_id' => $facility_id]);
        $targetId->mapCategoryFacilities()->update(['status' => $status]);
      }
      return true;
    } catch (Throwable $th) {
      return false;
    }
  }

  protected function mapFacilitiyCategoryDeleteArray($target, $facilityIds)
  {
    try {
      foreach ($facilityIds as $facility_id) {
        $target->mapCategoryFacilities()->where('facility_id', $facility_id)->first()->delete();
      }
      return true;
    } catch (Throwable $th) {
      return false;
    }
  }

  protected function mapFacilitiyCategoryDeleteSingle($target, $facility_id)
  {
    return $target->where('facility_id', $facility_id)->delete();
  }

  protected function checkCategoryFacilityExist($category, $facility)
  {
    return MapCategory::where('facility_type', $category)->where('facility_id', $facility)->first();
  }



  ## FACILITY UNIT

  protected function prepareFacilityArray($request) {
    $newFacilityTemp = [];

    # create ne general Array
    if (($commonFeatures = $request['common'])) {
      foreach ($commonFeatures as $common) {
        array_push($newFacilityTemp, $common);
      }
    }

    if (isset($request['outside'])) {
      $outsideFeatures = $request['outside'];
      foreach ($outsideFeatures as $outside) {
        array_push($newFacilityTemp, $outside);
      }
    }

    if (isset($request['additional'])) {
      $additionalFeatures = $request['additional'];
      foreach ($additionalFeatures as $additional) {
        array_push($newFacilityTemp, $additional);
      }
    }

    $quantities = (isset($request['quantity'])) ? $request['quantity'] : null;

    return ['facilities' => $newFacilityTemp, 'quantities' => $quantities];
  }


  protected function facilitiyUnityPreCreate($unit, $request) 
  {
    # add Unit Facility
    $updatedStatus = $this->facilitiyUnityStore($unit, $this->prepareFacilityArray($request));
    $this->status  = $updatedStatus;
    return getEncodedDecodedJson($this->FacilitiyResponse());
  }

  protected function facilitiyUnityStore($target, $data) 
  {
    try {
      $mapCategories = $data['facilities'];
      $quantities    = $data['quantities'];
      foreach ($mapCategories as $key => $mapCategoryId) {
        $target->facilityUnits()->create(['map_category_id' => $mapCategoryId]);
        if (!is_null($quantities) && isset($quantities[$key])) {
          $target->facilityUnits()->where('map_category_id', $mapCategoryId)->update(['quantity' => $quantities[$key]]);
        }
      }

      return true;
    } catch (Throwable $th) {
      return false;
    }
  }


  protected function facilitiyUnityPreUpdate($unit, $request) {

    // dd($request);

    $newFacilityToUpdate = [];
    $removeFacilities    = [];

    if (($existFacilities = $unit->facilityUnits)->count()) {
      # common
      $commonFeatures = $request['common'];
      foreach ($existFacilities as $commonFeature) {
        if(!in_array($commonFeature, $commonFeatures)) {
          array_push($removeFacilities, $commonFeature);
        }
      }

      # outside
      if (isset($request['outside'])) {
        $outsideFeatures = $request['outside'];
        foreach ($existFacilities as $outside) {
          if (!in_array($outside, $outsideFeatures)) {
            array_push($removeFacilities, $outside);
          }
        }
      }

      # additional
      if (isset($request['additional'])) {
        $additionalFeatures = $request['additional'];
        foreach ($existFacilities as $additionalFeature) {
          if (!in_array($additionalFeature, $additionalFeatures)) {
            array_push($removeFacilities, $additionalFeature);
          }
        }
      }
    }

    # create ne general Array
    if (($commonFeatures = $request['common'])) {
      foreach ($commonFeatures as $common) {
        array_push($newFacilityToUpdate, $common);
      }
    }

    if (isset($request['outside'])) {
      $outsideFeatures = $request['outside'];
      foreach ($outsideFeatures as $outside) {
        array_push($newFacilityToUpdate, $outside);
      }
    }

    if (isset($request['additional'])) {
      $additionalFeatures = $request['additional'];
      foreach ($additionalFeatures as $additional) {
        array_push($newFacilityToUpdate, $additional);
      }
    }

    # delete Facilities Removed.
    if (count($removeFacilities) > 0) {
      if ($this->facilitiyUnityDeleteArray($removeFacilities)) {
        $removeFacilities = [];
      }
    }

    # add update Unit Facility
    $quantity = (isset($request['quantity'])) ? $request['quantity'] : null;
    $updatedStatus = $this->facilitiyUnityUpdate($unit, $newFacilityToUpdate, $quantity);
    if ($updatedStatus) {
      // $this->message = 'Facilitiy Maped to ' . $facilitiyCategory->name . ' Successfuly!';
      // $this->code    = 200;
      $this->status  = true;
    }

    return getEncodedDecodedJson($this->FacilitiyResponse());
  }

  protected function facilitiyUnityUpdate($target, $data, $quantity)
  {
    try {
      foreach ($data as $key => $mapCategoryId) {
        $target->facilityUnits()->updateOrCreate(['map_category_id' => $mapCategoryId]);
        if (!is_null($quantity) && isset($quantity[$key])) {
          $target->facilityUnits()->where('map_category_id', $mapCategoryId)->update(['quantity' => $quantity[$key]]);
        }
      }

      return true;
    } catch (Throwable $th) {
      return false;
    }
  }

  protected function facilitiyUnityDeleteSingle($facilityUnit, $mapCategoryId)
  {
    return $facilityUnit->where('map_category_id', $mapCategoryId)->delete();
  }

  protected function facilitiyUnityDeleteArray($facilityUnitS)
  {
    try {
      foreach ($facilityUnitS as $facilityUnit) {
        $facilityUnit->delete();
      }
      return true;
    } catch (Throwable $th) {
      return false;
    }
  }


  ## HAND OVER
  protected function handoverPreStore(Rent $rent, array $mapCategories)
  {
    try {
      foreach ($mapCategories as $mapCategory) {
        $mapCategoryTemp = explode('-', $mapCategory);
        $isertValue = [
          'map_category_id' => $mapCategoryTemp[1], 
          'remarks'         => $mapCategoryTemp[0]
        ];
        ## Insert
        $this->handoverStore($rent, $isertValue);
      }

      $this->status  = true;
      return getEncodedDecodedJson($this->FacilitiyResponse());
    } catch (Throwable $th) {
      $this->status  = false;
      return getEncodedDecodedJson($this->FacilitiyResponse());
    }
  }

  protected function handoverStore(Rent $rent, array $data)
  {
    $handOver = $rent->handOvers()->updateOrCreate($data);
    return ($handOver->id > 0) ? true : false;
  }

}