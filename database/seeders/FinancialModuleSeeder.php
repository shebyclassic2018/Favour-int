<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Roots\Module;
use App\Models\Roots\MenuItem;
use Illuminate\Database\Seeder;

class FinancialModuleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Financial Controll
    $financial =  Module::where('slug', 'financial-control')->first();
    $financial->menuItems()->create([
      'type' => 'divider',
      'parent_id' => null,
      'order' => MenuItem::count() + 1
    ]);

    $bank =  $financial->menuItems()->create([
      'type' => 'item',
      'parent_id' => null,
      'order' => MenuItem::count() + 1,
      'title' => 'Bank & Cards',
      'url' => "#financial",
      'icon_class' => 'si si-credit-card'
    ]);
       $financial->menuItems()->create([
        'type' => 'item',
        'parent_id' => $bank->id,
        'order' => MenuItem::count() + 1,
        'title' => 'Bank',
        'url' => "/account/financials/banks",
        'url_name' => "account.financials.banks.index",
        'icon_class' => 'si si-tag'
      ]);

       $financial->menuItems()->create([
        'type' => 'item',
        'parent_id' => $bank->id,
        'order' => MenuItem::count() + 1,
        'title' => 'MNO',
        'url' => "/account/financials/mnos",
        'url_name' => "account.financials.mnos.index",

        'icon_class' => 'si si-screen-smartphone'
      ]);

    $withFund =  $financial->menuItems()->create([
      'type' => 'item',
      'parent_id' => null,
      'order' => MenuItem::count() + 1,
      'title' => 'Withdraw & Fund',
      'url' => "#with-fund",
      'icon_class' => 'si si-diamond'
    ]);
       $financial->menuItems()->create([
        'type' => 'item',
        'parent_id' => $withFund->id,
        'order' => MenuItem::count() + 1,
        'title' => 'Withdraw',
        'url' => "javascript:void(0)", # FIXME '/account/financial/withdraw',
        'icon_class' => 'si si-printer'
      ]);

       $financial->menuItems()->create([
        'type' => 'item',
        'parent_id' => $withFund->id,
        'order' => MenuItem::count() + 1,
        'title' => 'Funds',
        'url' => "javascript:void(0)", # FIXME '/account/financial/funds',
        'icon_class' => 'si si-drawer'
      ]);


    # PERMISSION
      # Financial
        $financialPermissions = ['index', 'create', 'store', 'edit', 'delete'];
        foreach ($financialPermissions as $fpermissionKey => $financialPermission) {
          if($fpermissionKey == 0) {
              $financial->permissions()->create([
                'name' => 'Access Financial Details',
                'slug' => 'account.financial.'.$financialPermission,
              ]);
          }else {
              $financial->permissions()->create([
                'name' => Str::ucfirst($financialPermission).' Financial Details',
                'slug' => 'account.financial.'.$financialPermission,
              ]);
          }
        }
      # End Financial

      # Bank
        $bankPermission = ['index', 'create', 'store', 'edit', 'delete'];
        // $accessTo       = 'bank';
        foreach ($bankPermission as $bankKey => $bank) {
          if($bankKey == 0) {
            $financial->permissions()->create([
                'name' => 'Access Bank Details',
                'slug' => 'account.financial.banks.'.$bank,
            ]);
          }else {
            $financial->permissions()->create([
                'name' => Str::ucfirst($bank).' Bank Details',
                'slug' => 'account.financial.banks.'.$bank,
            ]);
          }
        }
      # End Bank

      # MNO
        $mnosPermission = ['index', 'create', 'store', 'edit', 'delete'];
        foreach ($mnosPermission as $mnoskey => $mons) {
          if($mnoskey == 0) {
            $financial->permissions()->create([
              'name' => 'Access MNO Details',
              'slug' => 'account.financial.mnos.'.$mons,
            ]);
          }else {
            $financial->permissions()->create([
              'name' => Str::ucfirst($mons).' MNO Details',
              'slug' => 'account.financial.mnos.'.$mons,
            ]);
          }
        }
      # End MNO

      # Withdraw
        $financial->permissions()->create([
          'name' => 'Access Withdraw Details',
          'slug' => 'account.financial.withdraw.index',
        ]);

        $financial->permissions()->create([
          'name' => 'Delete Withdraw Details',
          'slug' => 'account.financial.withdraw.delete',
        ]);
      # End Withdraw

      # Analytics
        $financial->permissions()->create([
          'name' => 'Access Analytics',
          'slug' => 'account.financial.analytics.index',
        ]);
      # End Withdraw
  }
}
