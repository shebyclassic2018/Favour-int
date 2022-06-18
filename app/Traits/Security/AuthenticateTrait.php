<?php

namespace App\Traits\Security;

use App\Models\User;



/**
 * 
 */
trait AuthenticateTrait
{
  protected $message = null;
  protected $status  = false;
  protected $code    = 404;

  ## SHARED BY ALL BROCK

  protected function autheniticateResponse()
  {
    return [
      'code'    => $this->code,
      'status'  => $this->status,
      'message' => $this->message
    ];
  }

  protected function userModel($column, $value)
  {
    return User::where($column, $value)->count();
  }

  protected function isPhoneNumberExist($request)
  {
    $phoneExist = $this->userModel('phone', dbValidPhonenUmber($request['phone']));
    return $this->existResponse($phoneExist, 'Phone number');
  }


  protected function isEmailAddressExist($request)
  {
    $phoneExist = $this->userModel('email', $request['email']);
    return $this->existResponse($phoneExist, 'Email address');
  }


  protected function existResponse($phoneExist, $initialToMessage) {
    if ($phoneExist > 0) {
      $this->message = $initialToMessage . ' taken !!';
      $this->status  = true;
      $this->code    = 201;
    } else {
      $this->message = $initialToMessage . ' not taken !!';
      $this->status  = false;
      $this->code    = 200;
    }

    return $this->autheniticateResponse();
  }
}
