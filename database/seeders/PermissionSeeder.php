<?php

namespace Database\Seeders;

use App\Models\Roots\Role;
use Illuminate\Database\Seeder;
use App\Models\Roots\Permission;
use App\Models\Roots\PermissionRole;
use Illuminate\Support\Facades\Hash;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminrole = Role::findOrFail(1);
            $superAdminrole->users()->create([
                'name'     => 'Deogratias Alison',
                'phone'    => '0756979823',
                'email'    => 'deogratias.alison@ngata.co.tz',
                'password' => Hash::make('admin'),
                'email_verified_at' => now()
            ]);

            $superAdminrole->users()->create([
                'name'     => 'Shabani Rajabu',
                'phone'    => '0745681618',
                'email'    => 'shaaban.rajabu@ngata.co.tz',
                'password' => Hash::make('admin'),
                'email_verified_at' => now()
            ]);


        # GET PERMISSION ACCORDINGLY
            $superAdminPermision = Permission::all();
            // $tenantPermision     = Permission::where('slug', 'account.home')
            //     ->orWhere('slug', 'like', '%account.access%')
            //     ->orwhere('slug', 'like', '%account.financial%')
            //     ->orWhere('slug', 'like', '%account.offer%')
            //     ->orWhere('slug', 'like', '%account.service%')
            //     ->get();

        # PERMIT ROLE TO ROUTES
            $superAdminrole->permissions()->sync($superAdminPermision->pluck('id'));

            // # PERMIT ITEMS
            // PermissionRole::where('id', 3)->update(['menu_item_id' => 5]);
            // PermissionRole::where('id', 4)->update(['menu_item_id' => 5]);
            // PermissionRole::where('id', 5)->update(['menu_item_id' => 5]);
            // PermissionRole::where('id', 6)->update(['menu_item_id' => 5]);

            // PermissionRole::where('id', 47)->update(['menu_item_id' => 32]);
            // PermissionRole::where('id', 48)->update(['menu_item_id' => 32]);
            // PermissionRole::where('id', 49)->update(['menu_item_id' => 32]);
            // PermissionRole::where('id', 50)->update(['menu_item_id' => 32]);
            // PermissionRole::where('id', 51)->update(['menu_item_id' => 32]);

            // Role::findOrFail(4)->permissions()->sync($tenantPermision->pluck('id'));
    }
}
