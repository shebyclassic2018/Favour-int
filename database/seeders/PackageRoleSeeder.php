<?php

namespace Database\Seeders;

use App\Models\Roots\Role;
use Illuminate\Support\Str;
use App\Models\Roots\Package;
use Illuminate\Database\Seeder;
use App\Models\Financials\NgataTarif;
use Database\Seeders\MapPackageOfferSeeder;

class PackageRoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    # All Packages
    $packages = Package::orderBy('id', 'ASC')->take(5)->get();

    # Visiting & Rent Commision
    $visit = NgataTarif::where('name', NgataTarif::RATIOS[NgataTarif::VISITING_RATIO])->where('status', true)->first('id');
    $commision = NgataTarif::where('name', NgataTarif::RATIOS[NgataTarif::NORMAL_COM_RATIO])->where('status', true)->first('id');

    $DalaliPackage   = Role::where('slug', Str::slug('Dalali'))->first();
      $DalaliPackage->packageRole()->updateOrCreate([
        'package_id' => $packages[0]->id, 'fee' => 1000, 'duration' => 'day','visit' => $visit->id
      ]);

      $DalaliPackage->packageRole()->updateOrCreate([
        'package_id' => $packages[1]->id, 'fee' => 40000, 'duration' => 'Year', 'visit' => $visit->id
      ]);


    # For developemnt only
    $ownerPackage     = Role::where('slug', Str::slug('Property Owner'))->first();
      $ownerPackage->packageRole()->updateOrCreate([
        'package_id' => $packages[2]->id, 'fee' => 40000, 'duration' => 'Year', 'commission' => $commision->id
      ]);

      $ownerPackage->packageRole()->updateOrCreate([
        'package_id' => $packages[3]->id, 'fee' => 40000, 'duration' => 'Year', 'commission' => $commision->id,
      ]);


    // $DalaliPackage->packageRole()->create([
    //   'fee' => 40000,
    //   'visit' => $visit->id, 'commission' => $commision->id,
    //   'package_id' => $packages[3]->id, 'description' =>  '75%'
    // ]);


    // $TenantPackage    = Role::where('slug', Str::slug('Tenant'))->first();
    //   $TenantPackage->packageRole()->create([
    //     'package_id' => $packages[4]->id, 'description' =>  '25%'
    //   ]);
    //   $TenantPackage->packageRole()->create([
    //     'package_id' => $packages[5]->id, 'description' =>  '50%'
    //   ]);
    // $TenantPackage->packageRole()->create([
    //     'package_id' => $packages[6]->id, 'description' =>  '75%'
    // ]);


    // $InvestorPackage  = Role::where('slug', Str::slug('Investor'))->first();
    //   $InvestorPackage->packageRole()->create([
    //     'fee' => 100000,
    //     'visit' => $visit->id, 'commission' => $commision->id,
    //     'package_id' => $packages[6]->id, 'description' =>  '25%'
    //   ]);
    //   $InvestorPackage->packageRole()->create([
    //     'fee' => 100000,
    //     'visit' => $visit->id, 'commission' => $commision->id,
    //     'package_id' => $packages[7]->id, 'description' =>  '50%'
    //   ]);


    $this->call(MapPackageOfferSeeder::class);
  }


  public function ngataPoa($visit)
  {
    # code...
  }
}
