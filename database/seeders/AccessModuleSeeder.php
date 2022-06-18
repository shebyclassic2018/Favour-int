<?php

namespace Database\Seeders;

use App\Models\Roots\Menu;
use Illuminate\Support\Str;
use App\Models\Roots\Module;
use App\Models\Roots\MenuItem;
use Illuminate\Database\Seeder;

class AccessModuleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Access Controll

    $menus = Menu::all();
    $access =  Module::where('slug', 'access-control')->first();


    foreach ($menus as $menu) {
      if ($menu->name == 'super-admin') {
        $access->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'divider',
          'parent_id' => null,
          'order' => MenuItem::count() + 1,
          'divider_title' => 'Access Control'
        ]);

        $access->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'item',
          'parent_id' => null,
          'order' => MenuItem::count() + 1,
          'title' => 'Roles',
          'url' => "/app/roles",
          'url_name' => "app.roles.index",
          'icon_class' => 'si si-check'
        ]);

        $access->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'item',
          'parent_id' => null,
          'order' => MenuItem::count() + 1,
          'title' => 'Users',
          'url' => "/app/users",
          'url_name' => "app.users.index",
          'icon_class' => 'fa fa-users'
        ]);

      }

      if ($menu->name == 'property-owner'){
        $access->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'divider',
          'parent_id' => null,
          'order' => MenuItem::count() + 1,
          'divider_title' => 'Access Control'
        ]);

        $accountItem = $access->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'item',
          'parent_id' => null,
          'order' => MenuItem::count() + 1,
          'title' => 'Account',
          'url' => "#accounts",
          'icon_class' => 'si si-check'
        ]);

        $access->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'item',
          'parent_id' => $accountItem->id,
          'order' => MenuItem::count() + 1,
          'title' => 'Private Details',
          'url' => "/account/access/profile",
          'url_name' => "account.access.profile.index",
          'icon_class' => 'far fa-user-circle'
        ]);


        $access->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'item',
          'parent_id' => $accountItem->id,
          'order' => MenuItem::count() + 1,
          'title' => 'Company Details',
          'url' => "/account/access/company",
          'url_name' => "account.access.company.index",
          'icon_class' => 'si si-home'
        ]);

      }

      if ($menu->name == 'tenant'){

        $access->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'divider',
          'parent_id' => null,
          'order' => MenuItem::count() + 1,
          'divider_title' => 'Access Control'
        ]);

        $accountItem = $access->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'item',
          'parent_id' => null,
          'order' => MenuItem::count() + 1,
          'title' => 'Account',
          'url' => "#accounts",
          'icon_class' => 'si si-check'
        ]);

        $access->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'item',
          'parent_id' => $accountItem->id,
          'order' => MenuItem::count() + 1,
          'title' => 'Private Details',
          'url' => "/account/access/profile",
          'url_name' => "account.access.profile",
          'icon_class' => 'far fa-user-circle'
        ]);

        $access->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'item',
          'parent_id' => $accountItem->id,
          'order' => MenuItem::count() + 1,
          'title' => 'Rent Details',
          'url' => "/account/access/rental",
          'icon_class' => 'si si-home'
        ]);

        // $access->menuItems()->create([
        //   'menu_id' => $menu->id,
        //   'type' => 'item',
        //   'parent_id' => $accountItem->id,
        //   'order' => MenuItem::count() + 1,
        //   'title' => 'My Plan',
        //   'url' => "javascript:void(0)",
        //   'icon_class' => 'si si-paper-clip'
        // ]);
        ## and more

      }
    }


    # PERMISSION
    # Administrator
      # Role
        $rolePermissions =  ['index', 'create', 'edit','destroy'];
        foreach ($rolePermissions as $rolePermission) {
          if($rolePermission == 'index') {
            $access->permissions()->create([
                'name' => 'Access Roles',
                'slug' => 'app.roles.'.$rolePermission,
            ]);
          }else {
            $access->permissions()->create([
                'name' => Str::ucfirst($rolePermission).' Role',
                'slug' => 'app.roles.'.$rolePermission,
            ]);
          }
        }
      # End Role

      # User
        $userPermissions =  ['index', 'create', 'show', 'edit','destroy', 'update', 'password'];
        foreach ($userPermissions as $userPermission) {
          if($userPermission == 'index') {
            $access->permissions()->create([
                'name' => 'Access User Details',
                'slug' => 'app.users.'.$userPermission,
            ]);
          }else if($userPermission == 'update') {
            $access->permissions()->create([
                'name' => Str::ucfirst($userPermission).' Profile',
                'slug' => 'app.users.'.$userPermission,
            ]);
          }else if($userPermission == 'password') {
            $access->permissions()->create([
                'name' => Str::ucfirst($userPermission).' Profile Password',
                'slug' => 'app.users.'.$userPermission,
            ]);
          }else {
            $access->permissions()->create([
                'name' => Str::ucfirst($userPermission).' User Details',
                'slug' => 'app.users.'.$userPermission,
            ]);
          }
        }
      # End User

    # End Administrator


    # Client Access
      # Account
        $clientAccountList = ['index', 'edit'];
        foreach ($clientAccountList as $clientAccount) {
          if($clientAccount == 'index') {
            $access->permissions()->create([
              'name' => 'Access Account',
              'slug' => 'account.access.user.'.$clientAccount,
            ]);
          }else {
            $access->permissions()->create([
                'name' => Str::ucfirst($clientAccount).' Account',
                'slug' => 'account.access.user.'.$clientAccount,
            ]);
          }
        }
      # End

      # Rental
        $clientRentPermisiions = ['index', 'edit'];
        foreach ($clientRentPermisiions as $clientRentPermisiion) {
          if($clientRentPermisiion == 'index') {
            $access->permissions()->create([
              'name' => 'Access Rent',
              'slug' => 'account.access.rent.'.$clientRentPermisiion,
            ]);
          }else {
            $access->permissions()->create([
                'name' => Str::ucfirst($clientRentPermisiion).' Rent',
                'slug' => 'account.access.rent.'.$clientRentPermisiion,
            ]);
          }
        }
      # End
    # End Client Access


  }
}
