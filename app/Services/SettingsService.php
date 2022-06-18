<?php

namespace App\Services;

use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Roots\Role;
use App\Http\Middleware\Roles;
use App\Models\Companies\Company;
use App\Models\Peoples\Account;
use Illuminate\Support\Facades\Hash;

class SettingsService 
{

  public function getRoleList()
  {
    return Role::all();
  }

  public function getRoleListByArgument($value)
  {
    if ($value == 'clientList') {
      return Role::whereIn('id', Role::CLIENTS)->get();
    }
    
    if ($value == 'staffs') {
      return  Role::whereIn('id', Role::STUFFS)->get();
    }
  }

  public function getRoleByID($id) { return Role::where('id', $id)->first(); }
  public function getRoleByName($name) { return Role::where('name', $name)->first(); }

  public function getRoleBySlug($slug)
  {
    return Role::where('slug', 'like', '%' . $slug . '%')->first();
  }

  



  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array $data
   * @return \App\Models\User
   */
  public function createUser(array $data)
  {
    // [x]:
    // NOTE: issue of Individual account to be activated automatic is now fixed successfully

    $user = User::create([
      'name' => $data['fullname'],
      'email' => $data['email'],
      'phone' => $data['phone'],
      'password' => Hash::make($data['password']),
      'role_id' => $data['role']
    ]);

    return $user;
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  App\Models\User $user
   * @param  $accountTypeID
   * @return boolean
   */
  public function HandleSelfCreateAccount(User $user, $accountTypeID)
  {
    $selfCreatedAccount = $user->account()->create([
      'userCodeID' => generateAlphaNumeric(['name' => 'accounts', 'column' => 'userCodeID'],
      ['nature' => 'upper', 'length' => 8]), 
      'account_type_id' => $accountTypeID,
      // 'package_role_id' => PackageRole::where('role_id', $data['role'])->first()->id,
      // 'is_acc_active' => $is_acc_active
    ]);

    return $selfCreatedAccount->id > 0 ? true : false;
  }


  public function handleAccountAccess($accountId, $value)
  {

    $account = returnAccount(returnUser());
    return $account->activateOrDeactivateAccount($accountId, $value);
  
  }

  public function HandleIdenticalOfSystemAccount(Company $system, Company $comparedTo)
  {
    return (class_basename($system) == class_basename($comparedTo)) && ($system->id == $comparedTo->id) ?? false;
  }


  
}
