<?php

namespace App\Traits\Shared;

use Illuminate\Support\Str;
use App\Models\Financials\Channel;
use App\Services\FinancialService;
use App\Interfaces\FinancialBroker;

/**
 * 
 */
trait FinancialHandlerTraits
{
  protected function processUserFinancialInfoFromForm($form, $user)
  {
    $acc_body = null;
    if (Str::contains($form['channel'], 'MNOs')) {
      $acc_body = dbValidPhonenUmber($form['acc_phone']);
    } else {
      $acc_body = reformatCreditCard($form['acc_bank']);
    };

    $channel_id = explode('-', $form['channel'])[1];
    $financial = ['channel' => $form['channel'], 'acc_body' => $acc_body];
    return $this->processUserFinancialInfo($channel_id, $financial, $user);
  }

/**
 * 
 * 
 * 
 * @return 
 */
  protected function processUserFinancialInfo($channel_id, $financial, $user)
  {
    # FIRST CHECK IF FINANCIABLE EXIST
    if (is_null($existFinacilable = singleFinancialDetails($user))) {
      // create
      return $this->createFinancialaInfoRow($user, $financial);
    } else {
      # update 
      if ($existFinacilable->channel_id != $channel_id) {
        $channels = Channel::all();
        foreach ($channels as $channel) {
          if (
            $channel_id == $channel->id
          ) {
            $financial['channel'] = ($channel->type . '-' . $channel->id);
          }
        }
      }
      $acc_body = $financial['acc_body'];
      $financial['acc_body'] = ($existFinacilable->body != $acc_body) ? $acc_body : $existFinacilable->body;
      return $this->updateFinancialaInfoRow($existFinacilable, $financial);
    }
  }

  protected function createFinancialaInfoRow($user, $financial)
  {
    return createFinancialDetails(getFinanciableUser($user), $financial);
  }

  protected function updateFinancialaInfoRow($existFinacilable, $financial)
  {
    return updateFinancialDetails($existFinacilable->id, $financial);
  }

  protected function createRentDisbursement($target, $data)
  {
    # initiate the object of Financial
    $financialService = new FinancialService;

    # determine the target classname
    $disbursedFor = class_basename($target);

    # sent to Appointment
    if ($disbursedFor !== FinancialBroker::RENTS) {
      $responce = $financialService->HandleDisbursements($this->passTarget($target), $this->passDisbursedData($data));
    }

    # send to Rent
    if ($disbursedFor == FinancialBroker::RENTS) {
      $responce = $financialService->HandleRentDisbursements($this->passTarget($target), $this->passDisbursedData($data));
    }

    # Return feeda
    return $responce;
  }

  private function passDisbursedData($data) {
    return $data;
  }

  private function passTarget($target)
  {
    return $target;
  }
}
