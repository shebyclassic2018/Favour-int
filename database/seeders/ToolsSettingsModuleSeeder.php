<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Roots\Module;
use App\Models\Roots\MenuItem;
use Illuminate\Database\Seeder;

class ToolsSettingsModuleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Tools $ Settings Control
    $toolsSettings =  Module::where('slug', 'tools-settings-control')->first();

    $toolsSettings->menuItems()->create([
      'type' => 'divider',
      'parent_id' => null,
      'order' => MenuItem::count() + 1
    ]);

    $toolsSettings->menuItems()->create([
      'type' => 'item',
      'parent_id' => null,
      'order' => MenuItem::count() + 1,
      'title' => 'Analytics',
      'url' => "javascript:void(0)", # FIXME '/account/financial/analytics',
      'icon_class' => 'si si-bar-chart'
    ]);

    $toolsSettings->menuItems()->create([
      'type' => 'item',
      'parent_id' => null,
      'order' => MenuItem::count() + 1,
      'title' => 'Menus',
      'url' => "/app/menus",
      'icon_class' => 'si si-list'
    ]);

    $toolsSettings->menuItems()->create([
      'type' => 'item',
      'parent_id' => null,
      'order' => MenuItem::count() + 1,
      'title' => 'Backups',
      'url' => "/app/backups",
      'icon_class' => 'si si-cloud-upload'
    ]);

    $toolsSettings->menuItems()->create([
      'type' => 'item',
      'parent_id' => null,
      'order' => MenuItem::count() + 1,
      'title' => 'Settings',
      'url' => "/app/settings/general",
      'icon_class' => 'si si-settings'
    ]);




    # PERMISSION
    # Settings
      $pagePermissions = ['general', 'edit', 'destroy'];
      foreach ($pagePermissions as $settingPermission) {
        if($settingPermission == 'general') {
          $toolsSettings->permissions()->create([
            'name' => 'Access Settings',
            'slug' => 'app.settings.'.$settingPermission,
          ]);
        }else {
          $toolsSettings->permissions()->create([
            'name' => Str::ucfirst($settingPermission).' Settings',
            'slug' => 'app.settings.'.$settingPermission,
          ]);
        }
      }
    # END Settings

    # Backups
      $backupPermissions = ['index', 'create', 'download', 'destroy'];
      foreach ($backupPermissions as $backupPermission) {
        if($backupPermission == 'index') {
          $toolsSettings->permissions()->create([
            'name' => 'Access Backups',
            'slug' => 'app.backups.'.$backupPermission,
          ]);
        }else {
          $toolsSettings->permissions()->create([
            'name' => Str::ucfirst($backupPermission).' Backup',
            'slug' => 'app.backups.'.$backupPermission,
          ]);
        }
      }
    # END Backups

    # Menus
      $menuPermissions = ['index', 'builder', 'create', 'edit', 'destroy'];
      foreach ($menuPermissions as $menuPermission) {
        if($menuPermission == 'index') {
          $toolsSettings->permissions()->create([
            'name' => 'Access Menus',
            'slug' => 'app.menus.'.$menuPermission,
          ]);
        }elseif($menuPermission == 'builder') {
          $toolsSettings->permissions()->create([
            'name' => 'Access Menus '.Str::ucfirst($menuPermission),
            'slug' => 'app.menus.'.$menuPermission,
          ]);
        }else {
          $toolsSettings->permissions()->create([
            'name' => Str::ucfirst($menuPermission).' Menu',
            'slug' => 'app.menus.'.$menuPermission,
          ]);
        }
      }
    # END Menus
  }
}
