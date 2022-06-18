<?php
namespace App\Traits\Users;

use App\Models\Roots\Role;
use App\Services\SettingsService;



  /**
   * 
   */
  trait RoleTrait
  {

    /**
     * 
     */
    protected function roleIdByRoleName($roleName = 'Tenant') 
    { 
      $role = Role::where('name', $roleName)->get();
      if (count($role) > 0) {
        foreach ($role as $row) {
          $roleId = $row->id;
        }
        return $roleId;
      } else {
        return false;
      }
    
    }

    /**
     * 
     */
    protected function roleList($slugList) 
    {
      $roleIdList = [];
      foreach ($slugList as $value) {
        $roleId = $this->roleIdByRoleName(ucwords(str_replace('-', ' ', $value)));
        if (!in_array($roleId, $roleIdList)) {
          array_push($roleIdList, $roleId);
        }
      }

      return $roleIdList;
    }


    /**
     * 
     */
    protected function redirectNgataClient()
    {
      $clientRoleList = [];
      $resultList = $this->handleRoleList('clientList');
      foreach ($resultList as $value) {
        array_push($clientRoleList, $value->slug);
      }
      return $clientRoleList;
    }
      

    /**
     * 
     */
    protected function handleRoleList(String $action)
    {
      return (new SettingsService())->getRoleListByArgument($action);
    }
      
    
  }
  