<?php

namespace App\Traits\Financials;

use App\Interfaces\RemarksBroker;
use Illuminate\Support\Str;
use App\Models\Services\Rent;
use App\Interfaces\StatusBroker;
use App\Services\TarrifsService;
use App\Services\FinancialService;
use App\Models\Financials\RentDisbursement;
use App\Models\Financials\AppointmentDisbursement;
use App\Models\Roots\AccountType;
use App\Traits\Shared\FinancialHandlerTraits;
use App\Traits\Shared\PropertyHandlerTraits;

/**
 * 
 */
trait DisbursementTrait
{

  use PropertyHandlerTraits, FinancialHandlerTraits;

  protected function createaDisbursement($rentInstance)
  {
    # syssyem Info
    if (method_exists($this, 'prepareSystem')) { $systemID = $this->prepareSystem()->id;}

    # Rent has Linker will have tarrif with linker or not
    $tarrifID = $this->getRentTarriffId($rentInstance);

    # Conversation
    $conversation = $this->disbursementConversation(RentDisbursement::class);

    # Type & Agent
    $agentIdTypeInfo = getEncodedDecodedJson($this->getAgentIdType($rentInstance), 'decode');

    # Collection of those required Variables;
    $disbInfo = [
      'system'          => $systemID,
      'tarif_id'        => $tarrifID,
      'conversation_id' => $conversation,
      'type'            => $agentIdTypeInfo->type,
      'agent_id'        => $agentIdTypeInfo->agentID
    ];

    # store RentDisbursement 
    if (method_exists($this, 'createRentDisbursement')) {
      $callback = $this->createRentDisbursement($rentInstance, $disbInfo);
    }

    # return a collection in object;
    return $callback;
  }

  protected function getRentTarriffId(Rent $rent)
  {
    $tarrifService = new TarrifsService;
   
    # New contract
    if ($this->newContract($rent)) {
      return (($rent->link_id) ? $tarrifService->HandleGetSigleLinkedTarrif(true) :
        $tarrifService->HandleGetSigleCommonTarrif(true))->id;
    }

    # Continuing Contract
    if ($this->continueContract($rent)) {
      return ($tarrifService->HandleGetSigleContinuingTarrif(true))->id;
    }
  }

  protected function appointmentTarriffId()
  {
    return (new TarrifsService)->HandleGetSigleVisitTarrif(true)->id;
  }

  protected function getAgentIdType(Rent $rent)
  {
    # Ownership
    $houseOwneship = $rent->unit->houseOwneship;

    # goal to get Account ID useing account instance
    $account = (class_basename($houseOwneship->ownership) == AccountType::ACCOUNT_TYPES[AccountType::COMPANY]) ?
    $houseOwneship->ownership->account : $houseOwneship;

    # senarios
    ## 01 Dalali as Mchongo {will use Dalali as Agent }
    $user = $account->user;
    if($this->newContract($rent) && (isDalali($user) && isPackageMchongo($user))) {
      # check package_role_id
      # is company | is Individual
      $intermediator = isAccountTypeCompany($account->user) ? $houseOwneship->ownership : $account;

      $type    = class_basename($intermediator);
      $agentID = $intermediator->id;
    }
    
    if(isOwner($user) || $this->continueContract($rent)){
      ## 03 owner as Normal | Owner as Premium  { solution will use ngata as Agent}
      # syssyem Info because Unit is under owner package which lead to Agent commition to taken by Ngata.
      if (method_exists($this, 'prepareSystem')) {
        $intermediator = $this->prepareSystem();
      }

      $type    = class_basename($intermediator);
      $agentID = $intermediator->id;
    }

    $agentIdTypeInfo = ['type' => $type, 'agentID' => $agentID];

    return getEncodedDecodedJson($agentIdTypeInfo);
  }

  /**
   * 
   * @param RentDisbursement | AppointmentDisbursement $table
   */
  protected function disbursementConversation($table)
  {
    $ExistConversation = $table::where('status', StatusBroker::PENDING)->first('conversation_id');
    $useConversation = null;

    if ($ExistConversation) {
      $useConversation = $ExistConversation->conversation_id;
    } else {
      do {
        $useConversation = Str::random(15);
      } while ($table::where('conversation_id', $useConversation)->first());
    }

    return $useConversation;

    // Schema::create('rent_disbursements', function (Blueprint $table) {
    //   $table->id();
    //   $table->foreignId('rent_id')->constrained()->cascadeOnUpdate();
    //   $table->foreignId('system')->constrained('companies', 'id')->onUpdate('cascade');
    //   $table->foreignId('tarif_id')->constrained('ngata_tarifs', 'id')->onUpdate('cascade');
    //   $table->enum('status', ['Pending', 'Unacknowledged', 'Processing', 'Completed'])->default('Pending');
    //   $table->string('conversation_id');
    //   $table->string('type');
    //   $table->unsignedBigInteger('agent_id');
    // });
  }


  protected function newContract($rent) {
    return $rent->contract_type == RemarksBroker::NEW_CONTRACT;
  }

  protected function continueContract($rent)
  {
    return $rent->contract_type == RemarksBroker::CONTINUING_CONTRACT;
  }


  protected function prepareAppointmentDisbursements($appId) {

  }

  // public function getNumberToAdd($payloadable) {

  //   $due_date = null;
  //   $type = $payloadable->unit->interval_type;


  //   if($type == 'Day') {
  //     $due_date = $payloadable->anniversary->addDays($payloadable->duration);
  //   }

  //   if($type == 'Week') {
  //     $due_date = $payloadable->anniversary->addWeeks($payloadable->duration); 
  //   }

  //   if($type == 'Month') {
  //     $due_date = $payloadable->anniversary->addMonths($payloadable->duration);
  //   }

  //   if ($type == 'Year') {
  //     $due_date = $payloadable->anniversary->addYers($payloadable->duration);
  //   }

  //   return $due_date;



  //   // $JHFJD = ($type == 'Year') ? $payloadable->anniversary->addYers($payloadable->duration) :
  //   //   ($type == 'Day' ? $payloadable->anniversary->addDays($payloadable->duration) : 
  //   //   ($type == 'Week' ?  $payloadable->anniversary->addWeeks($payloadable->duration) : 
  //   //   ($type == 'Month' ? $payloadable->anniversary->addMonths($payloadable->duration) : 
  //   //   ($type == 'Year' ? $payloadable->anniversary->addYers($payloadable->duration) : 
  //   //   $payloadable->anniversary->addHours(24)
  //   //   ))));

  // }

  // protected function getContent($payloadableClass) {
  //   return ($payloadableClass == FinancialBroker::APPOINTMENTS) ? RefNumber::HOUSE_VISIT_PAYMENT : RefNumber::HOUSE_RENT_PAYMENT;
  // }

  // protected function getDueDate($payloadableClass, $payloadable)
  // {
  //   return ($payloadableClass == FinancialBroker::APPOINTMENTS) ? $payloadable->appointment_date->addHours(24) : $this->getNumberToAdd($payloadable);
  // }

  // protected function getAccount($payloadableClass, $payloadable)
  // {
  //   return ($payloadableClass == FinancialBroker::APPOINTMENTS) ? getUserAccountByUserID($payloadable->user_id) : $payloadable->account;
  // }

  // protected function createControlNumber($payloadableClass, $exp_date) 
  // {
  //   $financial  = new FinancialService;

  //   return $financial->createControlNumberID([
  //     'content'  => generateControlNumber($this->getContent($payloadableClass)),
  //     'exp_date' => $exp_date
  //   ]);
  // }

  // protected function appointmentsPayload(Appointment $appointment, array $values) 
  // {
  //   return $appointment->payload()->create($values);
  // }

  // protected function rentsPayloads(Rent $rent, array $values)
  // {
  //   return $rent->payloads()->create($values);
  // }


}