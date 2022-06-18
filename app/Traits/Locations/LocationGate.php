<?php

namespace App\Traits\Locations;

use Illuminate\Http\Request;
use App\Services\HouseService;
use App\Services\LocationService;


/**
 *
 */
trait LocationGate
{

  protected function toStoreLocationGate(Request $request)
  {
    $locationInput = ['city' => $request->_city, 'district' => $request->_district, 'neighbourhood' => $request->_neighbourhood];
    $locatlCabbBack = findOrStoreLocation($locationInput);


    $coordValue    = explode(', ', $request->_coordinate);
    $prepared_Value = [
      'ward_id'           => $locatlCabbBack->id,
      'latitude'  => $coordValue[0],
      'longitude' => $coordValue[1],
    ];

    $callback = doesVerificationCodeExist($request->hlgCode)['house'];
    $updateLocationCB = (new HouseService())->handleUpdateHouse($callback->id, $prepared_Value);

    $codeCB = ($updateLocationCB) ? $this->removerificationCode($callback) : false;

    if ($codeCB) {
      return response()->json(paymentSuccessFeedback($codeCB, 'Success, Thank you!!'));
    } else {
      return response()->json(paymentErrorFeedback($codeCB), 201);
    }
  }


  protected function housePickupPoint(Request $request) {

    if($request->station_pickup > 0) {
      return $request->station_pickup;    
    }

    ## Prepare City, District & Ward
    $locationInput  = ['city' => $request->city, 'district' => $request->district, 'neighbourhood' => $request->neighbourhood];
    $locatlCallBack = findOrStoreLocation($locationInput)->id;

    ## Prepare Coordinates
    $coordValue    = explode(', ', $request->coordinates);

    ## Prepare Station | Pikup Point name
    $stationName = $request->pikupPoint;

    # Prepare all station Values
    $locationService = new LocationService;
    ## create
     $prepared_Value = [
      'ward_id'   => $locatlCallBack,
      'name'      => $stationName,
      'latitude'  => $coordValue[0],
      'longitude' => $coordValue[1],
    ];

    ## search
    $prepare_reach = ['ward_id' => $locatlCallBack, 'name' => $stationName];

    ## action & return (search or Create if Pickup Point With the same name Exist)
    $station     = $locationService->handleFindOrStoreStation($prepare_reach, $prepared_Value);
    return $station->id;
  }
}
