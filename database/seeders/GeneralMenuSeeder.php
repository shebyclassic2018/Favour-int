<?php

namespace Database\Seeders;

use App\Models\Roots\Menu;
use Illuminate\Support\Str;
use App\Models\Roots\Module;
use App\Models\Roots\Service;
use App\Models\Roots\MenuItem;
use Illuminate\Database\Seeder;

class GeneralMenuSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    $menu =  Menu::where('name', 'super-admin')->first();

    // Summary Controll
      $summary =  Module::where('slug', 'summary-control')->first();
      $summary->menuItems()->create([
        'menu_id' => $menu->id,
        'type' => 'divider',
        'parent_id' => null,
        'order' => MenuItem::count() + 1
      ]);

      $summary->menuItems()->create([
        'menu_id' => $menu->id,
        'type' => 'item',
        'parent_id' => null,
        'order' => MenuItem::count() + 1,
        'title' => 'Dashboard',
        'url' => "/app/dashboard",
        'url_name' => "app.dashboard",
      
        'icon_class' => 'si si-speedometer'
      ]);

      # PERMISSIONS
      $summary->permissions()->create([
        'name' => 'Admin Dashboard',
        'slug' => 'app.dashboard'
      ]);

      $summary->permissions()->create([
        'name' => 'Dashboard',
        'slug' => 'account.home'
      ]);

    # End ==========================================================

    // Access Controll
      $access =  Module::where('slug', 'access-control')->first();
      $access->menuItems()->create([
        'menu_id' => $menu->id,
        'type' => 'divider',
        'parent_id' => null,
        'order' => MenuItem::count() + 1
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
          'title' => 'Private Profile',
          'url' => "/app/staff/profile",
          'url_name' => "app.staff.index",
          'icon_class' => 'fa fa-user-secret'
        ]);

        $access->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'item',
          'parent_id' => $accountItem->id,
          'order' => MenuItem::count() + 1,
          'title' => 'Ngata Profile',
          'url' => "/app/staff/company",
          'url_name' => "app.staff.company.index",
          'icon_class' => 'si si-puzzle'
        ]);

      # Administrator
        # Role
          $rolePermissions =  ['index', 'create', 'edit', 'destroy'];
          foreach ($rolePermissions as $rolePermission) {
            if ($rolePermission == 'index') {
              $access->permissions()->create([
                'name' => 'Access Roles',
                'slug' => 'app.roles.' . $rolePermission,
              ]);
            } else {
              $access->permissions()->create([
                'name' => Str::ucfirst($rolePermission) . ' Role',
                'slug' => 'app.roles.' . $rolePermission,
              ]);
            }
          }
        # End Role

        # User
          $userPermissions =  ['index', 'create', 'edit', 'destroy', 'password'];
          foreach ($userPermissions as $userPermission) {
            if ($userPermission == 'index') {
              $access->permissions()->create([
                'name' => 'Access User Details',
                'slug' => 'app.users.' . $userPermission,
              ]);
            } else if ($userPermission == 'update') {
              $access->permissions()->create([
                'name' => Str::ucfirst($userPermission) . ' Profile',
                'slug' => 'app.users.' . $userPermission,
              ]);
            } else if ($userPermission == 'password') {
              $access->permissions()->create([
                'name' => Str::ucfirst($userPermission) . ' Profile Password',
                'slug' => 'app.users.' . $userPermission,
              ]);
            } else {
              $access->permissions()->create([
                'name' => Str::ucfirst($userPermission) . ' User Details',
                'slug' => 'app.users.' . $userPermission,
              ]);
            }
          }
        # End User

        # Profile
          $staffPermisssions = ['index', 'create', 'edit', 'destroy'];
          foreach ($staffPermisssions as $staffPermisssion) {
            if ($staffPermisssion == 'index') {
              $access->permissions()->create([
                'name' => 'Access Staff Account',
                'slug' => 'app.staff.profile.' . $staffPermisssion,
              ]);
            } else {
              $access->permissions()->create([
                'name' => Str::ucfirst($staffPermisssion) . ' Staff Account',
                'slug' => 'app.staff.profile.' . $staffPermisssion,
              ]);
            }
          }
        # End Profile
      # End Administrator

      # Client Access
        # Account
          $clientAccountList = ['index', 'edit'];
          foreach ($clientAccountList as $clientAccount) {
            if ($clientAccount == 'index') {
              $access->permissions()->create([
                'name' => 'Access Account',
                'slug' => 'account.access.user.' . $clientAccount,
              ]);
            } else {
              $access->permissions()->create([
                'name' => Str::ucfirst($clientAccount) . ' Account',
                'slug' => 'account.access.user.' . $clientAccount,
              ]);
            }
          }
        # End

        # Rent
          $clientRentPermisiions = ['index', 'edit'];
          foreach ($clientRentPermisiions as $clientRentPermisiion) {
            if ($clientRentPermisiion == 'index') {
              $access->permissions()->create([
                'name' => 'Access Rent',
                'slug' => 'account.access.rent.' . $clientRentPermisiion,
              ]);
            } else {
              $access->permissions()->create([
                'name' => Str::ucfirst($clientRentPermisiion) . ' Rent',
                'slug' => 'account.access.rent.' . $clientRentPermisiion,
              ]);
            }
          }
        # End
      # End Client Access

    # End ===============================================

    // Property Controll
      $property =  Module::where('slug', 'property-control')->first();

      # Property Management
      $property->menuItems()->create([
        'menu_id' => $menu->id,
        'type' => 'divider',
        'parent_id' => null,
        'order' => MenuItem::count() + 1
      ]);

      $house = $property->menuItems()->create([
        'menu_id' => $menu->id,
        'type' => 'item',
        'parent_id' => null,
        'order' => MenuItem::count() + 1,
        'title' => 'Houses',
        'url' => "#houses",
        'icon_class' => 'si si-home'
      ]);

        $property->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'item',
          'parent_id' => $house->id,
          'order' => MenuItem::count() + 1,
          'title' => 'Checkout',
          'url' => "/app/houses/verify/unverified",
          'url_name' => "app.houses.verify.unverified",
          'icon_class' => 'si si-check'
        ]);

        # PERMISSION
        $housesInAdmins = ['unverified', 'edit', 'destroy'];
        foreach ($housesInAdmins as $housesInAdmin) {
          if ($housesInAdmin == 'unverified') {
            $property->permissions()->create([
              'name' => 'Checkout Houses',
              'slug' => 'app.houses.verify.'. $housesInAdmin,
            ]);
          } else {
            $property->permissions()->create([
              'name' => Str::ucfirst($housesInAdmin) . ' Unverified House',
              'slug' => 'app.houses.verify.'. $housesInAdmin,
            ]);
          }
        }

        $clientHouses = ['index', 'builder', 'create', 'edit', 'destroy'];
        foreach ($clientHouses as $clientHouse) {
          if ($clientHouse == 'index') {
            $property->permissions()->create([
              'name' => 'Access Houses',
              'slug' => 'account.property.house.' . $clientHouse,
            ]);
          }else if ($clientHouse == 'builder') {
            $property->permissions()->create([
              'name' => 'House Unit Builder',
              'slug' => 'account.property.house.' . $clientHouse,
            ]);
          } else {
            $property->permissions()->create([
              'name' => Str::ucfirst($clientHouse) . ' House',
              'slug' => 'account.property.house.' . $clientHouse,
            ]);
          }
        }

    # End ===================================================

    // Service & Offer
      $serviceOffer =  Module::where('slug', 'service-offers')->first();
      $serviceOffer->menuItems()->create([
        'menu_id' => $menu->id,
        'type' => 'divider',
        'parent_id' => null,
        'order' => MenuItem::count() + 1
      ]);

      $services = $serviceOffer->menuItems()->create([
        'menu_id' => $menu->id,
        'type' => 'item',
        'parent_id' => null,
        'order' => MenuItem::count() + 1,
        'title' => 'Our Plans',
        'url' => "#our-plans",
        'icon_class' => 'si si-check'
      ]);

        $ourPlansList = Service::where('slug', 'rent')->get();
        foreach ($ourPlansList as $value) {
          $serviceOffer->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => $services->id,
            'order' => MenuItem::count() + 1,
            'title' => $value->title,
            'url' => "javascript:void(0)", # FIXME 'url' => '/' . str_replace('.', '/', str_replace('service', 'account', $value->url)),
            'url_name' => "account." . $value->url . ".index",
            'icon_class' => 'fa fa-home'
          ]);
        }

        $serviceOffer->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'item',
          'parent_id' => $services->id,
          'order' => MenuItem::count() + 1,
          'title' => 'All Services',
          'url' => "javascript:void(0)", # FIXME /'url' => "/account/plans",
          'url_name' => "account.plans.index",
          'icon_class' => 'si si-paper-clip'
        ]);

        // $serviceOffer->menuItems()->create([
        //   'menu_id' => $menu->id,
        //   'type' => 'item',
        //   'parent_id' => null,
        //   'order' => MenuItem::count() + 1,
        //   'title' => 'Offers',
        //   'url' => "javascript:void(0)", # FIXME /account/offer',
        //   'icon_class' => 'si si-shuffle'
        // ]);

        # TODO: PERMISSION

        # PERMISSION
        # My-Service
        //     $pagePermissions = ['general', 'edit', 'destroy'];
        //     foreach ($pagePermissions as $settingPermission) {
        //       if($settingPermission == 'general') {
        //         $toolsSettings->permissions()->create([
        //           'name' => 'Access Settings',
        //           'slug' => 'app.settings.'.$settingPermission,
        //         ]);
        //       }else {
        //         $toolsSettings->permissions()->create([
        //           'name' => Str::ucfirst($settingPermission).' Settings',
        //           'slug' => 'app.settings.'.$settingPermission,
        //         ]);
        //       }
        //     }
        //   # End My-Service

        $serviceOffer->permissions()->create([
            'name' => 'Access My-Service',
            'slug' => 'account.service.plans.index',
        ]);

        $serviceOffer->permissions()->create([
            'name' => 'Edit My-Plans',
            'slug' => 'account.service.plans.edit',
        ]);

        $serviceOffer->permissions()->create([
            'name' => 'Access Offers',
            'slug' => 'account.offer.general',
        ]);
      # ENd
    # End =====================================================================


    // Financial Controll
      $financial =  Module::where('slug', 'financial-control')->first();
      $financial->menuItems()->create([
        'menu_id' => $menu->id,
        'type' => 'divider',
        'parent_id' => null,
        'order' => MenuItem::count() + 1
      ]);

      // $bank =  $financial->menuItems()->create([
        //   'menu_id' => $menu->id,
        //   'type' => 'item',
        //   'parent_id' => null,
        //   'order' => MenuItem::count() + 1,
        //   'title' => 'Bank & Cards',
        //   'url' => "#financial",
        //   'icon_class' => 'si si-wallet'
        // ]);
        //   $financial->menuItems()->create([
        //     'menu_id' => $menu->id,
        //     'type' => 'item',
        //     'parent_id' => $bank->id,
        //     'order' => MenuItem::count() + 1,
        //     'title' => 'Bank',
        //     'url' => "/account/financials/banks",
			  //     'url_name' => "account.financials.banks.index",
        //     'icon_class' => 'si si-tag'
        //   ]);

        //   $financial->menuItems()->create([
        //     'menu_id' => $menu->id,
        //     'type' => 'item',
        //     'parent_id' => $bank->id,
        //     'order' => MenuItem::count() + 1,
        //     'title' => 'MNO',
        //     'url' => "/account/financials/mnos",
			  //     'url_name' => "account.financials.mnos.index",
        //     'icon_class' => 'si si-screen-smartphone'
      //   ]);

      $financial->menuItems()->create([
        'menu_id' => $menu->id,
        'type' => 'item',
        'parent_id' => null,
        'order' => MenuItem::count() + 1,
        'title' => 'Payment Gateway',
        'url' => "/app/gateways",
        'url_name' => "app.gateways.index",
        'icon_class' => 'si si-wallet'
      ]);

      $withFund =  $financial->menuItems()->create([
        'menu_id' => $menu->id,
        'type' => 'item',
        'parent_id' => null,
        'order' => MenuItem::count() + 1,
        'title' => 'Withdraw & Fund',
        'url' => "#with-fund",
        'icon_class' => 'si si-diamond'
      ]);
        $financial->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'item',
          'parent_id' => $withFund->id,
          'order' => MenuItem::count() + 1,
          'title' => 'Withdraw',
          'url' => "javascript:void(0)", # FIXME '/account/financial/withdraw',
          'icon_class' => 'si si-printer'
        ]);

        $financial->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'item',
          'parent_id' => $withFund->id,
          'order' => MenuItem::count() + 1,
          'title' => 'Funds',
          'url' => "javascript:void(0)", # FIXME '/account/financial/funds',
          'icon_class' => 'si si-drawer'
        ]);

      # PERMISSION
      # Financial

        # Settings Super
          $gatewayPermissions = ['index', 'create', 'edit', 'destroy'];
          foreach ($gatewayPermissions as $gKey => $gatewayPermission) {
            if ($gKey == 0) {
              $financial->permissions()->create([
                'name' => 'Gateway Details',
                'slug' => 'app.gateways.' . $gatewayPermission,
              ]);
            } else {
              $financial->permissions()->create([
                'name' => Str::ucfirst($gatewayPermission) . ' Gateway Details',
                'slug' => 'app.gateways.' . $gatewayPermission,
              ]);
            }
          }
        # End Financial

        # Bank
          $bankPermission = ['index', 'create', 'edit', 'destroy'];
          // $accessTo       = 'bank';
          foreach ($bankPermission as $bankKey => $bank) {
            if ($bankKey == 0) {
              $financial->permissions()->create([
                'name' => 'Access Bank Details',
                'slug' => 'account.financials.banks.' . $bank,
              ]);
            } else {
              $financial->permissions()->create([
                'name' => Str::ucfirst($bank) . ' Bank Details',
                'slug' => 'account.financials.banks.' . $bank,
              ]);
            }
          }
        # End Bank

        # MNO
          $mnosPermission = ['index', 'create', 'edit', 'destroy'];
          foreach ($mnosPermission as $mnoskey => $mons) {
            if ($mnoskey == 0) {
              $financial->permissions()->create([
                'name' => 'Access MNO Details',
                'slug' => 'account.financials.mnos.' . $mons,
              ]);
            } else {
              $financial->permissions()->create([
                'name' => Str::ucfirst($mons) . ' MNO Details',
                'slug' => 'account.financials.mnos.' . $mons,
              ]);
            }
          }
        # End MNO

        # Withdraw
          $financial->permissions()->create([
            'name' => 'Access Withdraw Details',
            'slug' => 'account.financials.withdraw.index',
          ]);

          // $financial->permissions()->create([
          //   'name' => 'Delete Withdraw Details',
          //   'slug' => 'account.financial.withdraw.delete',
          // ]);
        # End Withdraw

        # Analytics
          $financial->permissions()->create([
            'name' => 'Access Analytics',
            'slug' => 'account.financials.analytics.index',
          ]);
        # End Withdraw
    # End =====================================================================


    // Page Controll
      $page =  Module::where('slug', 'page-control')->first();
      $page->menuItems()->create([
        'menu_id' => $menu->id,
        'type' => 'divider',
        'parent_id' => null,
        'order' => MenuItem::count() + 1
      ]);

      $page->menuItems()->create([
        'menu_id' => $menu->id,
        'type' => 'item',
        'parent_id' => null,
        'order' => MenuItem::count() + 1,
        'title' => 'Pages',
        'url' => "/app/pages",
        'icon_class' => 'si si-paper-clip'
      ]);

      # PERMISSION
      $pagePermisiions = ['index', 'create', 'edit', 'destroy'];
      foreach ($pagePermisiions as $pagePermisiion) {
        if ($pagePermisiion == 'index') {
          $page->permissions()->create([
            'name' => 'Access Pages',
            'slug' => 'app.pages.' . $pagePermisiion,
          ]);
        } else {
          $page->permissions()->create([
            'name' => Str::ucfirst($pagePermisiion) . ' Page',
            'slug' => 'app.pages.' . $pagePermisiion,
          ]);
        }
      }
    # End =====================================================================

    // Tools $ Settings Control
      $toolsSettings =  Module::where('slug', 'tools-settings')->first();

      $toolsSettings->menuItems()->create([
        'menu_id' => $menu->id,
        'type' => 'divider',
        'parent_id' => null,
        'order' => MenuItem::count() + 1
      ]);

      $toolsSettings->menuItems()->create([
        'menu_id' => $menu->id,
        'type' => 'item',
        'parent_id' => null,
        'order' => MenuItem::count() + 1,
        'title' => 'Analytics',
        'url' => "javascript:void(0)", # FIXME '/account/financial/analytics',
        'icon_class' => 'si si-bar-chart'
      ]);

      $setting = $toolsSettings->menuItems()->create([
        'menu_id' => $menu->id,
        'type' => 'item',
        'parent_id' => null,
        'order' => MenuItem::count() + 1,
        'title' => 'Settings',
        'url' => "#settings",
        'icon_class' => 'si si-settings'
      ]);

        $toolsSettings->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'item',
          'parent_id' => $setting->id,
          'order' => MenuItem::count() + 1,
          'title' => 'General (NHA)',
          'url' => "javascript:void(0)", # FIXME "/app/settings/general",
          'url_name' => "app.settings.general",
          'icon_class' => 'si si-vector'
        ]);

        $toolsSettings->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'item',
          'parent_id' => $setting->id,
          'order' => MenuItem::count() + 1,
          'title' => 'Menus',
          'url' => "javascript:void(0)", # FIXME 'url' => "/app/menus",
          'url_name' => "app.menus.menus",
          'icon_class' => 'si si-list'
        ]);

        $property->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'item',
          'parent_id' => $setting->id,
          'order' => MenuItem::count() + 1,
          'title' => 'Location',
          'url' => "javascript:void(0)",  # FIXME 'url' => "/app/location/cities",
          'url_name' => "app.location.cities.index",
          'icon_class' => 'si si-directions'
        ]);

        $toolsSettings->menuItems()->create([
          'menu_id' => $menu->id,
          'type' => 'item',
          'parent_id' => $setting->id,
          'order' => MenuItem::count() + 1,
          'title' => 'Backups',
          'url' => "javascript:void(0)",  # FIXME 'url' => "/app/backups",
          'url_name' => "app.backups",
          'icon_class' => 'si si-cloud-upload'
        ]);

      # PERMISSION
      # Settings
        $settingPermissions = ['general', 'edit', 'destroy'];
        foreach ($settingPermissions as $settingPermission) {
          if ($settingPermission == 'general') {
            $toolsSettings->permissions()->create([
              'name' => 'Access General Settings',
              'slug' => 'app.settings.' . $settingPermission,
            ]);
          } else {
            $toolsSettings->permissions()->create([
              'name' => Str::ucfirst($settingPermission) . ' General Settings',
              'slug' => 'app.settings.' . $settingPermission,
            ]);
          }
        }

        $locationPermissions = ['cities', 'districts','storeWard'];
        foreach ($locationPermissions as $locationPermission) {

          if ($locationPermission == 'cities') {
            $toolsSettings->permissions()->create([
              'name' => 'Access '. Str::ucfirst($locationPermission),
              'slug' => 'app.location.'.$locationPermission,
            ]);
          }

          if ($locationPermission == 'districts') {
            $toolsSettings->permissions()->create([
              'name' => 'Access '. Str::ucfirst($locationPermission),
              'slug' => 'app.location.cities.'.$locationPermission,
            ]);
          }

          if ($locationPermission == 'storeWard') {
            $toolsSettings->permissions()->create([
              'name' => Str::ucfirst('store wards'),
              'slug' => 'app.location.cities.districts.'. $locationPermission,
            ]);
          }
        }
      # END Settings

      # Backups
        $backupPermissions = ['index', 'create', 'download', 'destroy'];
        foreach ($backupPermissions as $backupPermission) {
          if ($backupPermission == 'index') {
            $toolsSettings->permissions()->create([
              'name' => 'Access Backups',
              'slug' => 'app.backups.' . $backupPermission,
            ]);
          } else {
            $toolsSettings->permissions()->create([
              'name' => Str::ucfirst($backupPermission) . ' Backup',
              'slug' => 'app.backups.' . $backupPermission,
            ]);
          }
        }
      # END Backups

      # Menus
        $menuPermissions = ['index', 'builder', 'create', 'edit', 'destroy'];
        foreach ($menuPermissions as $menuPermission) {
          if ($menuPermission == 'index') {
            $toolsSettings->permissions()->create([
              'name' => 'Access Menus',
              'slug' => 'app.menus.' . $menuPermission,
            ]);
          } elseif ($menuPermission == 'builder') {
            $toolsSettings->permissions()->create([
              'name' => 'Access Menus ' . Str::ucfirst($menuPermission),
              'slug' => 'app.menus.' . $menuPermission,
            ]);
          } else {
            $toolsSettings->permissions()->create([
              'name' => Str::ucfirst($menuPermission) . ' Menu',
              'slug' => 'app.menus.' . $menuPermission,
            ]);
          }
        }
    # END Menus
    # End =====================================================================




    // app.houses.



    # My House
    // $access->permissions()->create([
    //   'name' => 'Access My-House',
    //   'slug' => 'account.access.my-house.index',
    // ]);

    // $access->permissions()->create([
    //     'name' => 'Edit My-House',
    //     'slug' => 'account.access.my-house.edit',
    // ]);

    // # My Location
    // $access->permissions()->create([
    //     'name' => 'Access My-Location',
    //     'slug' => 'account.access.my-location.index',
    // ]);

    // $access->permissions()->create([
    //     'name' => 'Edit My-Location',
    //     'slug' => 'account.access.my-location.edit',
    // ]);

  }
}
