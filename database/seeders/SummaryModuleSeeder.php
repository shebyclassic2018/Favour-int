<?php

namespace Database\Seeders;

use App\Models\Roots\Menu;
use App\Models\Roots\MenuItem;
use App\Models\Roots\Module;
use Illuminate\Database\Seeder;

class SummaryModuleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Summary Controll
    $menus = Menu::all();
    $summary =  Module::where('slug', 'summary-control')->first();

    foreach ($menus as $menu) {
      if ($menu->name == 'super-admin') {

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

      }else {

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
          'url' => "/account/home", 
          'url_name' => "account.home",
          'icon_class' => 'si si-speedometer'
        ]);

      }
    }

    # PERMISSION
    $summary->permissions()->create([
      'name' => 'Admin Dashboard',
      'slug' => 'app.dashboard'
    ]);

    $summary->permissions()->create([
      'name' => 'Dashboard',
      'slug' => 'account.home'
    ]);
  }
}
