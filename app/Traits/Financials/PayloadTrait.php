<?php

namespace App\Traits\Financials;

use App\Interfaces\FinancialBroker;
use App\Services\FinancialService;
use App\Models\Financials\RefNumber;
use App\Models\Peoples\Appointment;
use App\Models\Services\Rent;

/**
 * 
 */
trait PayloadTrait
{
  protected function createPayload($payloadable)
  {
    $payloadableClass = class_basename($payloadable);
    $exp_date   = $this->getDueDate($payloadableClass, $payloadable);

    $dataTocreate = [
      'account_id'     => $this->getAccount($payloadableClass, $payloadable)->id,
      'ref_number_id'  => $this->createControlNumber($payloadableClass, $exp_date)->id,
      'due_date'       => $exp_date
    ];

     return $payloadableClass == FinancialBroker::APPOINTMENTS ? 
      $this->appointmentsPayload($payloadable, $dataTocreate) : 
      $this->rentsPayloads($payloadable, $dataTocreate);
  }

  public function getNumberToAdd($payloadable) {

    $due_date = null;
    $type = $payloadable->unit->interval_type;


    if($type == 'Day') {
      $due_date = $payloadable->anniversary->addDays($payloadable->duration);
    }

    if($type == 'Week') {
      $due_date = $payloadable->anniversary->addWeeks($payloadable->duration); 
    }

    if($type == 'Month') {
      $due_date = $payloadable->anniversary->addMonths($payloadable->duration);
    }

    if ($type == 'Year') {
      $due_date = $payloadable->anniversary->addYers($payloadable->duration);
    }

    return $due_date;



    // $JHFJD = ($type == 'Year') ? $payloadable->anniversary->addYers($payloadable->duration) :
    //   ($type == 'Day' ? $payloadable->anniversary->addDays($payloadable->duration) : 
    //   ($type == 'Week' ?  $payloadable->anniversary->addWeeks($payloadable->duration) : 
    //   ($type == 'Month' ? $payloadable->anniversary->addMonths($payloadable->duration) : 
    //   ($type == 'Year' ? $payloadable->anniversary->addYers($payloadable->duration) : 
    //   $payloadable->anniversary->addHours(24)
    //   ))));

  }

  protected function getContent($payloadableClass) {
    return ($payloadableClass == FinancialBroker::APPOINTMENTS) ? RefNumber::HOUSE_VISIT_PAYMENT : RefNumber::HOUSE_RENT_PAYMENT;
  }

  protected function getDueDate($payloadableClass, $payloadable)
  {
    return ($payloadableClass == FinancialBroker::APPOINTMENTS) ? $payloadable->appointment_date->addHours(24) : $this->getNumberToAdd($payloadable);
  }

  protected function getAccount($payloadableClass, $payloadable)
  {
    return ($payloadableClass == FinancialBroker::APPOINTMENTS) ? getUserAccountByUserID($payloadable->user_id) : $payloadable->account;
  }

  protected function createControlNumber($payloadableClass, $exp_date) 
  {
    $financial  = new FinancialService;

    return $financial->createControlNumberID([
      'content'  => generateControlNumber($this->getContent($payloadableClass)),
      'exp_date' => $exp_date
    ]);
  }

  protected function appointmentsPayload(Appointment $appointment, array $values) 
  {
    return $appointment->payload()->create($values);
  }

  protected function rentsPayloads(Rent $rent, array $values)
  {
    return $rent->payloads()->create($values);
  }

  // $financial = new FinancialService;
  // $appointment->payLoad()->create([
  //     'account_id' => getUserAccountByUserID($appointment->user_id)->id,
  //     'ref_number_id' => $financial->createControlNumberID([
  //         'content' => generateControlNumber(RefNumber::HOUSE_VISIT_PAYMENT),
  //         'exp_date' => $appointment->appointment_date->addHours(24)
  //     ])->id,
  //     'due_date' => $appointment->appointment_date->addHours(24)
  // ]);


  // protected function getMessageContent(array $data)
  // {
  //   $url = $data['url'];
  //   $goal = $data['goal'];
  //   $name = $data['name'];
  //   $rooms = $data['rooms'];
  //   $price = $data['price'];
  //   $location = $data['location'];

  //   return "Ndugu $name nyumba iliyoko ($location) kwa ajili ya $goal yenye vyumba $rooms inayogharimu $price kwa mwezi,kulingana na mapendekezo yako imepakiwa, Tembelea ukurasa $url kuitazama. Ahsante";
  // }

}