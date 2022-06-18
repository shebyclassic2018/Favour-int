<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Roots\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $modules = [
      'Summary Control', 'Access Control','Property Control',
      'Service & Offers', 'Financial Control', 'Page Control',
      'Tools & Settings'
    ];

    foreach ($modules as $module) {
      Module::create(['name' => $module, 'slug' => Str::slug($module)]);
    }
  }
}
