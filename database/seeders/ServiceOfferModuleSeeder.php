<?php

namespace Database\Seeders;

use App\Models\Roots\Module;
use App\Models\Roots\Service;
use App\Models\Roots\MenuItem;
use Illuminate\Database\Seeder;

class ServiceOfferModuleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Service & Offer
    $serviceOffer =  Module::where('slug', 'service-offers')->first();
    $serviceOffer->menuItems()->create([
      'type' => 'divider',
      'parent_id' => null,
      'order' => MenuItem::count() + 1
    ]);

    $services = $serviceOffer->menuItems()->create([
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
          'type' => 'item',
          'parent_id' => $services->id,
          'order' => MenuItem::count() + 1,
          'title' => $value->title,
          'url' => '/' . str_replace('.', '/', str_replace('service', 'account', $value->url)),
          'url_name' => "account.".$value->url.".index",
          'icon_class' => 'fa fa-home'
        ]);
      }

      $serviceOffer->menuItems()->create([
        'type' => 'item',
        'parent_id' => $services->id,
        'order' => MenuItem::count() + 1,
        'title' => 'All Services',
        'url' => "javascript:void(0)", # FIXME /'url' => "/account/plans",
        'url_name' => "account.plans.index",
        'icon_class' => 'si si-paper-clip'
      ]);

    // $serviceOffer->menuItems()->create([
    //   'type' => 'item',
    //   'parent_id' => null,
    //   'order' => MenuItem::count() + 1,
    //   'title' => 'Offers',
    //   'url' => "javascript:void(0)", # FIXME /account/offer',
    //   'icon_class' => 'si si-shuffle'
    // ]);


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

  //   $moduleServicesOffers->permissions()->create([
  //     'name' => 'Access My-Service',
  //     'slug' => 'account.service.plans.index',
  // ]);

  // $moduleServicesOffers->permissions()->create([
  //     'name' => 'Edit My-Plans',
  //     'slug' => 'account.service.plans.edit',
  // ]);

  // $moduleServicesOffers->permissions()->create([
  //     'name' => 'Access Offers',
  //     'slug' => 'account.offer.general',
  // ]);
  }
}
