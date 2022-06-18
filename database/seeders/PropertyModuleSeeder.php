<?php

namespace Database\Seeders;

use App\Models\Roots\MenuItem;
use App\Models\Roots\Module;
use Illuminate\Database\Seeder;

class PropertyModuleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Property Controll
    $property =  Module::where('slug', 'property-control')->first();

    # Property Management
    $property->menuItems()->create([
      'type' => 'divider',
      'parent_id' => null,
      'order' => MenuItem::count() + 1
    ]);

    $house = $property->menuItems()->create([
      'type' => 'item',
      'parent_id' => null,
      'order' => MenuItem::count() + 1,
      'title' => 'Houses',
      'url' => "#houses",
      'icon_class' => 'si si-home'
    ]);

      $property->menuItems()->create([
        'type' => 'item',
        'parent_id' => $house->id,
        'order' => MenuItem::count() + 1,
        'title' => 'Checkout',
        'url' => "/app/houses/verify/unverified",
        'icon_class' => 'si si-check'
      ]);

    $myProperties = $property->menuItems()->create([
      'type' => 'item',
      'parent_id' => null,
      'order' => MenuItem::count() + 1,
      'title' => 'My Properties',
      'url' => "#my-properties",
      'icon_class' => 'si si-check'
    ]);

      $property->menuItems()->create([
        'type' => 'item',
        'parent_id' => $myProperties->id,
        'order' => MenuItem::count() + 1,
        'title' => 'House',
        'url' => "/account/property/house",
        'url_name' => "account.property.house.index",
        'icon_class' => 'fa fa-home'
      ]);

      // $property->menuItems()->create([
        //     'type' => 'item',
        //     'parent_id' => $myProperties->id,
        //     'order' => MenuItem::count() + 1,
        //     'title' => 'Land',
        //     'url' => "javascript:void(0)", # FIXME '/account/property/land',
        //     'icon_class' => 'fa fa-home'
      // ]);

      // $property->menuItems()->create([
        //     'type' => 'item',
        //     'parent_id' => $myProperties->id,
        //     'order' => MenuItem::count() + 1,
        //     'title' => 'Materials',
        //     'url' => "javascript:void(0)", # FIXME '/account/property/material',
        //     'icon_class' => 'fa fa-home'
      // ]);

    $MyHome = $property->menuItems()->create([
      'type' => 'item',
      'parent_id' => null,
      'order' => MenuItem::count() + 1,
      'title' => 'My Home',
      'url' => "javascript:void(0)", # FIXME '#my-home',
      'icon_class' => 'fa fa-house-user'
    ]);

      # TODO Activate them,
      // $property->menuItems()->create([
      //     'type' => 'item',
      //     'parent_id' => $MyHome->id,
      //     'order' => MenuItem::count() + 1,
      //     'title' => 'House (IoT)',
      //     'url' => "/account/iot",
      //     'icon_class' => 'fa fa-users'
      // ]);

      // $property->menuItems()->create([
      //     'type' => 'item',
      //     'parent_id' => $MyHome->id,
      //     'order' => MenuItem::count() + 1,
      //     'title' => 'My Location',
      //     'url' => "/account/location",
      //     'icon_class' => 'fa fa-users'
      // ]);

      // ## and more



    # PERMISSION

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
