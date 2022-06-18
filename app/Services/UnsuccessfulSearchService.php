<?php

namespace App\Services;

use App\Models\Companies\Company;
use App\Models\GuestSearches;
use App\Models\Roots\District;
use App\Models\Roots\Station;

class UnsuccessfulSearchService
{
  protected $ward_id;
  protected $phone;
  protected $price;
  protected $rooms;
  protected $goal;
  protected $status;

  public function HandleFindPreferenceByValue(Array $values, $status)
  {
    $this->ward_id  = $values['ward_id'];
    $this->price    = $values['price'];
    $this->rooms    = $values['rooms'];
    $this->goal     = $values['goals'];
    $this->status  = $status;

    return GuestSearches::with('ward')
      ->where('status', $this->status)
      ->where('ward_id', $this->ward_id)
      ->where('price', $this->price)
      ->where('rooms', $this->rooms)
      ->where('goals', $this->goal)
      ->get();
  }

  public function findAllRequest($page)
  {
    $collectionData = [];
    ## if individual
    if (isAccountTypeCompany(authUser())) {
      $company = returnCompany(authUser());

      // if level is super | NGATA
      if ($company->level == Company::IS_SUPPER && is_null($company->zone)) {
        $collectionData = GuestSearches::with('ward')
          ->orderBy('created_at', 'DESC')
          ->paginate($page + 5);
      }else {

        if((!is_null($collectionOfZones = $company->zone))) {

          $locationServices = new LocationService;
          $wards = $locationServices->handleWardList()
            ->whereIn('district_id', $locationServices->handleDistrictList()->whereIn('city_id', $collectionOfZones)->pluck('id'))
            ->pluck('id');

          $collectionData =  GuestSearches::with('ward')
            ->whereIn('ward_id', $wards) #FIXME REMOVE THIS LINE
            ->where('status', GuestSearches::PENDING)
            ->orderBy('created_at', 'DESC')
            ->paginate($page);
        }
      }
    }

    ## if individual
    if (isAccountTypeIndividual(authUser())) {
      $collectionData =  GuestSearches::with('ward')
        ->where('ward_id', returnAccount(authUser())->station->ward_id) #FIXME REMOVE THIS LINE
        ->where('status', GuestSearches::PENDING)
        ->orWhere('status', GuestSearches::FOUND)
        ->orderBy('created_at')
        ->orderBy('created_at', 'DESC')
        ->paginate($page);
    }

    return $collectionData;
  }

  function HandleUpdate($id, $value) {
    return $this->HandleSingleItemByID((int)$id)->update($value);
  }

  public function HandleSingleItemByID($id) {
    return GuestSearches::findOrFail($id);
  }

}
