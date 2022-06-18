<?php

  namespace App\Services;

use App\Models\Link;
use App\Models\Services\Rent;
use App\Models\Peoples\Account;
use App\Models\Properties\Unit;
use App\Interfaces\RentalBroker;
use App\Interfaces\StatusBroker;
use App\Interfaces\AppointmentBroker;
use App\Traits\Facilities\FacilitiesTrait;
use App\Traits\Financials\DisbursementTrait;
use App\Traits\Financials\PayloadTrait;

class RentalService 
{
  use PayloadTrait, DisbursementTrait, FacilitiesTrait;

  protected $status   = false;
  protected $activity = null;
  protected $content  = null;

  public function HandlePreRent($request) {

    $houseService = new HouseUnitService;
    $unitToRent = $houseService->handleHouseUnitByID($request->unit);

    // check if user has pre-rent of anothe unit in order to restrict him/her to continue
    if (($otherInfo = $this->HandleToFindUncomplitedRentProcess(authUser()->id, $request->unit))->count() > 0) {
      $this->status   = false;
      $this->activity = AppointmentBroker::EXIST;
      $this->content  = $otherInfo;
    }

    $appointment = (new AppointmentService())->handleSingleAppointmentByID($request->id);
    $linker = (!is_null($appointment->identifier)) ? $this->getLinkerIfExist($appointment->identifier)->id : null;
    $preparedData = [
      'appointment_id' => $appointment->id,
      'unit_id'        => $request->unit,
      'contract_id'    => $unitToRent->houseOwneship->house->contract,
      'link_id'        => $linker,
      'status'         => false
    ];

    $rentInstance = returnAccount(authUser())->rents()->firstOrCreate($preparedData, $preparedData);

    # TODO: Update Unit is_available to false 
    // && $houseService->HandleUpdateHouseUnit($rentInstance->unit, ['is_available' => false])
    if (($rentInstance->id > 0) ) {
      $this->status   = true;
      $this->activity = AppointmentBroker::CREATED;
      $this->content  = $rentInstance->unit->unit_code;
    }

    return json_encode([
      'status'   => $this->status,
      'activity' => $this->activity,
      'content'  => $this->content
    ]);
  }


  protected function getLinkerIfExist($identfier)
  {
    return Link::where('identifier', $identfier)->first();
  }

  public function HandleSetAnniversaryDate($data, $contract_id)
  {
    $message = RentalBroker::GENERAL_FAIL;
    $rentInstance = $this->HandleToFindRentByID($data['rent_id']);
    $updatedValue = [
      'anniversary' => $data['anniversary'],
      'duration'    => $data['duration'],
      'amount'      => $data['finalTotal'],
      'hold_tax'    => $data['tax_value'],
      'contract_id' => $contract_id
    ];

    $response = $this->HandleRentUpdate($rentInstance, $updatedValue);

    if ($response) {
      # CREATE a REF-NUMBER & PAYLOAD
      if (method_exists($this, 'createPayload')) {
        $createPayload = $this->createPayload($rentInstance);
      }

      $message = RentalBroker::ANNIVERSARY_SET;
    }

    return json_decode(json_encode([
      'status'  => $response,
      'message' => $message,
      'content' => $rentInstance->id
    ]));
  }

  public function HandleConfirmToTakeKey($data, $id)
  {
    $rentInstance = $this->HandleToFindRentByID($id);

    // # make disbasments
    if (method_exists($this, 'createaDisbursement')) {
      $callback = getEncodedDecodedJson($this->createaDisbursement($rentInstance), 'decode');
    }

    # Handover;
    if (method_exists($this, 'handoverPreStore')) {
      $handOvercallback = getEncodedDecodedJson($this->handoverPreStore($rentInstance, $data['remarks']), 'decode');
    }

    // dd($handOvercallback->status);

    # upadte Rent.
    $confirmKey = ['key_status' => $this->getStatus($data['key_status']), 'status' => true];

    # error | success
    $response = ($callback->status && $handOvercallback->status) ? $this->HandleRentUpdate($rentInstance, $confirmKey) : $callback->status;
    $message  = ($response) ? RentalBroker::CONFIRM_TAKE_SET : RentalBroker::GENERAL_FAIL;
    $responseAfterAllJob = json_encode(['status'  => $response, 'message' => $message, 'content' => $rentInstance->id]);

    return json_decode($responseAfterAllJob);
  }

  private function getStatus($key_status)
  {
    return $key_status == 'on' ? StatusBroker::TAKEN : StatusBroker::RESTORED;
  }

  public function HandleToFindUncomplitedRentProcess(Int $userId, $unitID)
  {
    return Rent::where('account_id', $userId)->where('status', false) ->where('unit_id', '!=', $unitID)->get();
  }


  protected function HandleToFindRentByID(int $rentId) {
    return Rent::findOrFail($rentId);
  }

  protected function HandleRentUpdate(Rent $rent, array $values)
  {
    return $rent->update($values);
  }

  public function HandleToGetLatestUnitRent(Unit $unit)
  {
    return $unit->rents()->latest()->first();
  }

  public function HandleUnitRequireAnniversaryByUser(Account $account)
  {
    return $this->HandleRentWithCommonCondition($account, getEncodedDecodedJson([
      'amount_status' => StatusBroker::NOTPAID, 'key_status' => StatusBroker::NOTTAKEN]))
      ->whereNull('anniversary')
      ->orWhereNull('duration')
      ->orderBy('id', 'desc')
      ->latest()
      ->first();
  }

  public function HandleUnitRequiredPaidByUser(Account $account)
  {
    return $this->HandleRentWithCommonCondition($account, getEncodedDecodedJson([
      'amount_status' => StatusBroker::NOTPAID, 'key_status' => StatusBroker::NOTTAKEN]))
      ->orderBy('id', 'desc')
      ->latest()
      ->first();
  }

  public function HandleUnitRequiredKeyConfirmByUser(Account $account)
  {
    return $this->HandleRentWithCommonCondition($account, getEncodedDecodedJson([
      'amount_status' => StatusBroker::PAID,'key_status' => StatusBroker::NOTTAKEN]))
      ->orderBy('id', 'desc')
      ->latest()
      ->first();
  }

  public function HandleUnitRentalConfirmed(Account $account)
  {
    return $this->HandleRentWithCommonCondition($account, getEncodedDecodedJson([
      'amount_status' => StatusBroker::PAID, 'key_status' => StatusBroker::TAKEN]))
      ->orderBy('id', 'desc')
      ->latest()
      ->first();
  }

  private function HandleRentWithCommonCondition(Account $account, $condition) {
    $status = getEncodedDecodedJson($condition, 'decode');
    return $account->rents()
      ->with(['payloads', 'link', 'appointment.feedbacks', 'unit.houseOwneship.ownership'])
      ->where('amount_status', $status->amount_status)
      ->where('key_status', $status->key_status);
  }

  public function handleSigleRentWithRelationship($rentId)
  {
    return Rent::with(['unit.facilityUnits.mapCategory.facility', 'payloads.refNumber', 'appointment', 'contract', 'link'])->findOrFail($rentId);
  }
}