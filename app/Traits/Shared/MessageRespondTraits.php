<?php

namespace App\Traits\Shared;

use Illuminate\Support\Str;
use App\Services\AccountService;
use App\Interfaces\PasswordBroker;
use App\Models\Companies\Company;
use App\Models\Roots\Role;
use App\Services\AuthService;
use App\Services\HouseUnitService;
use App\Services\LocationService;
use Illuminate\Support\Facades\Hash;

/**
 * 
 */
trait MessageRespondTraits
{
  protected function isPhoneExist($phone) {
    $is_phone_exist = (new AuthService())->HandleFindPhonenumber($phone['phone']);
    return is_null($is_phone_exist) ? PasswordBroker::INVALID_USER : $this->validCredential($phone);
  }

  protected function resetPassowrdLink($phone)
  {
    # check existance of phonenumber
    if (($response = $this->isPhoneExist($phone)) == PasswordBroker::INVALID_USER) {
      return json_encode(['passwordBroker' => $response]);
    }

    # generate token and add token to database with phonenumber
    $reset_token = (new AuthService())->HandleGenerateResetToken($response);

    $url = route('password.reset', $reset_token->token);
    $request_id = 2;

    return json_encode([
      'message'  => $this->generateLinkMessageContent($url),
      'request'  => $request_id,
      'receiver' => reformatPhonenUmber($response),
      'passwordBroker' => PasswordBroker::RESET_LINK_SENT
    ]);
  }

  protected function validCredential($phone) {
    return $phone['phone'];
  }

  protected function generateLinkMessageContent($url)
  {
    return "Please click the following link to reset your password, $url ,Thank you";
  }


  # for only one units
  protected function checkUnitsInAppointments($appointment) {
    return (count($appointment->unit_id) == 1) ?? false;
  }

  protected function getWhoToContactFromUnit($unit_id) {

    $houseOwneship = (new HouseUnitService)->handleHouseUnitByID($unit_id[0])->houseOwneship;
    $ownership = $houseOwneship->ownership;
    $user      = $this->getUserByAccount($ownership);

    // if is owner redirect to NHA else to Dalali respectively
    if(myRoleID($user) == Role::IS_OWNER) {
      # redirect to NHA...
      // $redirectTo = (new Company)->superCompany()->account->user;
      $redirectTo = $this->getUserByAccount((new Company)->superCompany()); 

    }else {
      $redirectTo = $user;
    }

    return json_encode([
      'otherData' => [
        'house' => $houseOwneship->house_id,
        'unit' => $unit_id[0]
      ],
      'user' => $redirectTo->only('name', 'email', 'phone')
    ]);
  }

  protected function getUnitUploader($appointment)
  {
    return (!($morethanOne = $this->checkUnitsInAppointments($appointment))) ? $morethanOne :
      $this->getWhoToContactFromUnit($appointment->unit_id);
  }

  protected function generateMessageTosent($appointment)
  {
    if(!($response = json_decode($this->getUnitUploader($appointment)))) {
      return $response;
    }else {
      $message = "Hellow " . $response->user->name. "\r\nPlease Refer to the message to make sure the house has been set for an appointment is available or rented" . "Thankyou!\r\n". "\r\nTafadhali Rejelea ujumbe ili kuhakikisha kuwa nyumba ilowekwa kwenye miadi inapatikana au imekodishwa\r\n" . "Ahsante!\r\n\r\n". route('account.property.house.unit.show', ['id' => $response->otherData->house, 'unit' => $response->otherData->unit]);  

      return json_encode([
        'message' => $message,
        'user' => (array)$response->user
      ]);
    }
  }


  # for appointment accepted
  protected function generateAcceptedMessage($appointment)
  {
    // dd($appointment);

    $location = getLocationByWard((new LocationService)->handleWardByID($appointment->ward_id));
    $user = (new AccountService)->HandleGetUserByID($appointment->user_id)->only('name', 'email', 'phone');

    $message = "Dear " . $user['name'] . "\r\nYou have successfully booked a visit to the existing houses in ". $location. ". Thank you!".
      "\r\nUmefanikiwa kuweka miadi ya kutembelea nyumba zilizopo " . $location . ". Ahsante!\r\n". route('account.appointment.view', $appointment->id);

    return json_encode([
      'message' => $message,
      'user' => $user
    ]);
  }




  ## shared functions
  protected function getUserByAccount($target) 
  {
    return ((class_basename($target) == 'Company') ? $target->account : $target)->user;
  }



}
