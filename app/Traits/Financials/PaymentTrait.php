<?php

namespace App\Traits\Financials;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Peoples\Account;
use App\Services\RentalService;
use App\Interfaces\StatusBroker;
use App\Services\AccountService;
use App\Interfaces\MessageBrocker;
use App\Services\FinancialService;
use App\Traits\Security\CipherTrait;
use App\Interfaces\Services\PaymentBroker;
use App\Http\Controllers\API\Gateways\Airtel\AirtelGatewayController;
use App\Http\Controllers\API\Gateways\Vodacom\VodacomGatewayController;
use App\Models\Financials\FeePayment;
use App\Models\Link;
use App\Models\Roots\PackageRole;

/**
 * 
 */
trait PaymentTrait
{
  use CipherTrait;

  protected function prepareRentPayments($id)
  {
    $data = $this->valuePreparedToPaymentRent($id);
    # save data to payment service
    $response = getEncodedDecodedJson($this->sendDataToRentPayment($data['payloadInstance'], $data['rentPaymentValue']), 'decode');
    if (!$response->status) {
      return redirect()->route('account.home');;
    }

    ## preare cellurant Data
    return $this->prepareCellulantData($response->content);
  }

  private function sendDataToRentPayment($target, $data)
  {
    return (new FinancialService)->HandleRentalPayment($target, $data);
  }

  protected function prepareCellulantData($data)
  {
    $requestDescription = PaymentBroker::RENT_PAYMENT_REQ_DESC;
    $currencyCode   = "TZS";
    $paymentService = $data->payment_service;
    $payLoad = $data->pay_load;

    $dataToBeSentToCellulant = [
      "merchantTransactionID" =>  $payLoad->ref_number->content,
      "requestAmount" => $payLoad->payloadable->amount,
      "currencyCode"  => $currencyCode,
      "accountNumber" => $paymentService->accountNumber,
      "serviceCode"   => $paymentService->serviceCode,
      "dueDate"       => $payLoad->due_date,
      "requestDescription" => $requestDescription,
      "countryCode"     => $data->countryCode,
      "languageCode"    => "en",
      "payerClientCode" => "",
      "MSISDN" => $data->paidThrough,
      "customerName"  => authUser()->name,
      "customerEmail" => authUser()->email
    ];

    /* 
    * add this data into json on ploject (it is optinal)
    * uncomment if you want data to be saved on json file while sent to Cellurant
    */
    # jsonAppend($dataToBeSentToCellulant);

    # Add possible feedback routes;
    foreach ($this->getPossibleRoutes() as $key => $route) {
      $dataToBeSentToCellulant[$key] = $route;
    }

    $redirectUrl = $this->secureDataTobeSentCellulant($dataToBeSentToCellulant);
    if (is_null($redirectUrl)) {
      return redirect()->route('account.home');
    }

    return redirect($redirectUrl);
  }

  protected function secureDataTobeSentCellulant($dataToBeSentToCellulant)
  {
    $redirect_url = null;
    if (method_exists($this, 'cipher_big_encrypt')) {
      $ivKey     = env('ONLINE_TINGG_IV_KEY');
      $secretKey = env('ONLINE_TINGG_SECRET_KEY');
      $payload   = $dataToBeSentToCellulant;
      $dataEncrypted =  $this->cipher_big_encrypt($ivKey, $secretKey, $payload);

      $redirect_url = 'https://online.tingg.africa/v2/express/?accessKey=' . env('ONLINE_TINGG_ACCESS_KEY') . '&params=' . $dataEncrypted . '&countryCode=' . $payload["countryCode"];
    }
    return $redirect_url;
  }

  protected function getPossibleRoutes()
  {
    return [
      "successRedirectUrl" => route('successPayment'),
      "failRedirectUrl"    => route('failedPayment'),
      "pendingRedirectUrl" => route('account.home'),
      "paymentWebhookUrl"  => route('cellulantWebhook'),
    ];
  }

  protected function prepareRentPaymentsByMnos($reqData, $request)
  {

    $decreateId = $this->cipher_decrypt_urlParams($reqData->rentID);
    $purpose    = PaymentBroker::RENT;
    $currencyCode   = "TZS";

    if (!$decreateId) {

      return response()->json([
        'status'  => false,
        'message' => MessageBrocker::DECRYPTION_FAIL,
        'title'   => 'error',
        'content' => []
      ]);
    }

    $data = $this->valuePreparedToPaymentRent($decreateId, $reqData);

    # save data to payment service
    $response = getEncodedDecodedJson($this->sendDataToRentPayment($data['payloadInstance'], $data['rentPaymentValue']), 'decode');
    if (!$response->status) {
      return response()->json([
        'status' => false,
        'title'  => 'Error',
        'message' => $response->message
      ]);
    }

    $rent    = $response->content;
    $payLoad = $rent->pay_load;
    # Check the Operator selected by user to redirect 
    $req = [
      'currencyCode' => $currencyCode,
      'countryCode'  => $rent->countryCode,
      'phone'        => $rent->paidThrough,
      'ref'          => $payLoad->ref_number->content,
      'amount'       => $payLoad->payloadable->amount,
      'purpose'      => $purpose,
      'pay_load_id'  => $payLoad->id
    ];

    $request->request->add($req);

    if ($reqData->operator == 'mpesa') {
      try {
        $obj = new VodacomGatewayController();
        $redirectUrl =  $obj->MPesa($request);
      } catch (Exception $e) {
        return $e->getMessage();
      }
    } else if ($reqData->operator == 'airtelmoney') {
      try {
        $obj = new AirtelGatewayController();
        $redirectUrl =  $obj->airtelMoney($request);
        // return $this->HandleAirtelMoneyRequest($req, $purpose);
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }

    return $redirectUrl;
  }

  protected function valuePreparedToPaymentRent($id, $otherRequest = null)
  {
    $payload = getSinglePayload((new RentalService)->handleSigleRentWithRelationship($id));
    $paymentServices = (new FinancialService)->handleToGetPaymentService(PaymentBroker::RENT);
    $rentPaymentValue = [
      'paymentservice' => $paymentServices->id,
      'paidThrough'    => '+255000000000',
      'countryCode'    => 'TZ',
      'status'         => StatusBroker::PENDING
    ];

    if (!is_null($otherRequest)) {
      $rentPaymentValue['paidThrough'] = $otherRequest->phone;
      $rentPaymentValue['countryCode'] = $otherRequest->countryCode;
    }

    return [
      'payloadInstance'  => $payload,
      'rentPaymentValue' => $rentPaymentValue
    ];
  }

  protected function insertIntFeePayment($user, $params)
  {
    $storedResponse = $this->prepareDataToStore($user, $params);
    return getEncodedDecodedJson(['status' => $storedResponse->id > 0 ? true : false]);
  }

  protected function getAccountOrCompanyTarget(User $user)
  {
    $account = (new AccountService)->HandleGetAccountByUser($user);
    return isAccountTypeIndividual($user) ? $account : $account->company;
  }

  protected function getFeeAmountOnCreate(User $user)
  {
    $account = (new AccountService)->HandleGetAccountByUser($user);
    return $account->packageRole->fee;
  }

  protected function getFeeAmountOnLink(User $user = null)
  {
    // $account = (new AccountService)->HandleGetAccountByUser($user);
    // return $account->packageRole->fee;
    return PackageRole::first()->fee;

  }

  protected function prepareDataToStore($user, $params)
  {
    $target      = $this->getAccountOrCompanyTarget($user);
    $givenParams = getEncodedDecodedJson($params, 'decode');

    if ($givenParams->flag == PaymentBroker::CREATE_FRAG) {
      ## check if user as create has been created orleady
      $response = $target->feePayments()->where('fee_type', StatusBroker::PACKAGE_FEE)
        ->where('is_expired', StatusBroker::NOTEXPIRED)->first();

      if (is_null($response)) {
        $pending_amount = $this->getFeeAmountOnCreate($user);
        $data = [
          'fee_type'       => $givenParams->feeType, 
          'pending_amount' => $pending_amount
        ];
        $response = $this->storeFeePayments($target, $data);
      }
    }else {
      ## check if link with current user exist in feepayment as create has been created orleady
      $linkId   = $this->getLinkIdByidentifier($givenParams->identifier)->id;
      $response = $target->feePayments()->where('link_id', $linkId)->first();

      if (is_null($response)) {
        $pending_amount = $this->getFeeAmountOnLink($user);
        $data = [
          'fee_type' => $givenParams->feeType, 
          'link_id' => $linkId, 
          'pending_amount' => $pending_amount
        ];
        $response = $this->storeFeePayments($target, $data);
      }
    } 

    return $response;
  }

  protected function upgradeFeePayment($user, $params)
  {
    $target = $this->getAccountOrCompanyTarget($user);
    $givenParams = getEncodedDecodedJson($params, 'decode');

    # UPDATE EXPIRED
    $response = $this->updateFeePayments($target, ['is_expired' => StatusBroker::EXPIRED]);

    if ($response) {
      $pending_amount = $this->getFeeAmountOnCreate($user);
      $data = [
        'fee_type'       => $givenParams->feeType,
        'pending_amount' => $pending_amount
      ];

      $response = $this->storeFeePayments($target, $data);
    }

    return $response;
  }

  // protected function prepareDataToStore($user, $params)
  // {

  // }
  protected function storeFeePayments($target, $data)
  {
    return  $target->feePayments()->create($data);
  }

  protected function updateFeePayments($target, $data)
  {
    return  $target->feePayments()->update($data);
  }

  protected function getLinkIdByidentifier($identifier)
  {
    return  Link::where('identifier', $identifier)->first();
  }



}
