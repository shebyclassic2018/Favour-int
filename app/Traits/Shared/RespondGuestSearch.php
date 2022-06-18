<?php

namespace App\Traits\Shared;

/**
 * 
 */
trait RespondGuestSearch
{
  protected function processMessage($customer, $unit)
  {
    $receiver_phone  = $customer->phone;
    $request_id      = 2;

    $url = route('services.rent.getHouseDetails', [
      'houseID' => $unit->id,
      'price'   => $customer->price,
      'rooms'   => $customer->rooms,
      'ward_id' => $customer->ward_id
    ]);

    $contentToCreateMessage = [
      'url'   => $url,
      'goal'  => 'Makazi',
      'name'  => 'Mteja',
      'rooms' => $customer->rooms,
      'price' => $customer->price,
      'location' => (string)getLocationByWard($customer->ward)
    ];

    return [
      'message'  => $this->getMessageContent($contentToCreateMessage),
      'request'  => $request_id,
      'receiver' => $receiver_phone
    ];
  }


  protected function getMessageContent(array $data)
  {
    $url = $data['url'];
    $goal = $data['goal'];
    $name = $data['name'];
    $rooms = $data['rooms'];
    $price = $data['price'];
    $location = $data['location'];

    return "Ndugu $name nyumba iliyoko ($location) kwa ajili ya $goal yenye vyumba $rooms inayogharimu $price kwa mwezi,kulingana na mapendekezo yako imepakiwa, Tembelea ukurasa $url kuitazama. Ahsante";
  }

}
