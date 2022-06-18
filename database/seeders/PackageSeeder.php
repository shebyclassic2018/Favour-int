<?php

namespace Database\Seeders;

use App\Models\Roots\Role;
use Illuminate\Support\Str;
use App\Models\Roots\Package;
use App\Models\Roots\Service;
use Illuminate\Database\Seeder;
use App\Models\Roots\PackageRole;
use App\Models\Financials\NgataTarif;
use Database\Seeders\PackageRoleSeeder;

class PackageSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // $packages = [
    //     'Ngata Poa', 'Ngata Mchongo', 'Propety Owner', 'Ngata Premium',
    //     'Chap Chap', 'Kwako ni Kwako', 'Property Developer', 'Rental Owner'
    // ];

    $services = Service::all(); # ["1: Rent", "2: Rent-To-Own", "3: Market Place", "4: Investiment"],

    $RentPackages = ['Ngata Poa', 'Ngata Mchongo', 'Propety Owner', 'Ngata Premium'];
    // $RentTownPackages = ['Chap Chap', 'Kwako ni Kwako'];
    // $investimentPackages = ['Property Developer', 'Rental Owner'];

    # HACK We should discuss this package as soon as possible
    // $ternantPackages = ['Rent'];

    foreach ($RentPackages as $key => $package) {
      Package::create([
        'service_id' => $services[0]->id,
        'title' => $package,
        'rate' => (($package == 'Ngata Premium') ? 3 : (($package == 'Ngata Mchongo') ? 2 : 1)),
        'slug' => Str::slug($package)
      ]);
    }

    // foreach ($RentTownPackages as $key => $package) {
    //   Package::create([
    //     'service_id' => $services[1]->id,
    //     'title' => $package,
    //     'rate' => (($package == 'Kwako ni Kwako') ? 2 : 1),
    //     'slug' => Str::slug($package)
    //   ]);
    // }

    // foreach ($investimentPackages as $key => $package) {
    //   Package::create([
    //     'service_id' => $services[3]->id,
    //     'title' => $package,
    //     'rate' => (($package == 'Rental Owner') ? 2 : 1),
    //     'slug' => Str::slug($package)
    //   ]);
    // }

    $this->call(PackageRoleSeeder::class);
   
  }
}
