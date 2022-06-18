<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Roots\Module;
use App\Models\Roots\MenuItem;
use Illuminate\Database\Seeder;

class PageModuleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Page Controll
    $page =  Module::where('slug', 'page-control')->first();

    $page->menuItems()->create([
      'type' => 'divider',
      'parent_id' => null,
      'order' => MenuItem::count() + 1
    ]);

    $page->menuItems()->create([
      'type' => 'item',
      'parent_id' => null,
      'order' => MenuItem::count() + 1,
      'title' => 'Pages',
      'url' => "/app/pages",
      'icon_class' => 'si si-paper-clip'
    ]);

    # PERMISSION

    # Page management
      $pagePermisiions = ['index', 'create', 'edit', 'destroy'];
      foreach ($pagePermisiions as $pagePermisiion) {
        if($pagePermisiion == 'index') {
          $page->permissions()->create([
            'name' => 'Access Pages',
            'slug' => 'app.pages.'.$pagePermisiion,
          ]);
        }else {
          $page->permissions()->create([
            'name' => Str::ucfirst($pagePermisiion).' Page',
            'slug' => 'app.pages.'.$pagePermisiion,
          ]);
        }
      }
    # END
  }
}
