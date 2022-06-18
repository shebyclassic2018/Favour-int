<?php
namespace App\Traits\Users;

use App\Models\User;
use App\Traits\Users\RoleTrait;
use Illuminate\Support\Facades\Hash;

  /**
   * 
   */
  trait RegistrationTrait
  {
    use RoleTrait;

    protected $content = null;
    protected $status  = false;
    protected $code    = 404;

    ## SHARED BY ALL BROCK

    protected function registrationResponse()
    {
      return [
        'code'    => $this->code,
        'status'  => $this->status,
        'content' => $this->content
      ];
    }

    # ADMINISTRATOR
    protected function getAllClients($page = 10) 
    {
      if (method_exists($this, 'redirectNgataClient')) {
        $redirectNgataClient = $this->redirectNgataClient();
      }

      if (method_exists($this, 'roleList')) {
        $roleIdList = $this->roleList($redirectNgataClient);
      }

      return User::whereIn('role_id', $roleIdList)->orderBy('id', 'ASC')->paginate($page);
    }

    protected function getSingleUser($userId) 
    {
      return User::findOrFail($userId);
    }

    // protected function getSingleAccount($user) 
    // {
    //   User::
    // }


    // protected function getProfile($user) {
    //   User::
    // }


    protected function prepareClientData($request)
    {
      # store in user
      $storeUserResponse = $this->storeUser($request);


      # store in account
      
      if (!$storeUserResponse) {
        $this->content = 'message.failed_message';
        $this->status  = $storeUserResponse;
        $this->code    = 404;
      }else {
        $this->content = $storeUserResponse;
        $this->status  = true;
        $this->code    = 200;
      }

      return $this->registrationResponse();
    }

    private function storeUser($clientData)
    {
      $user = User::create([
        'name'      => $clientData['fullname'],
        'email'     => $clientData['email'],
        'phone'     => dbValidPhonenUmber($clientData['phone']),
        'password'  => Hash::make($clientData['password']),
        'role_id'   => $clientData['role']
      ]);

      return ($user->id > 0) ? $user : false;
    }

    private function storeAccount()
    {
        // return ($accountService->HandleSelfCreateAccount($user, $data['type'])) ? $user : false;

    }





    # OTHERS
    
  }
  