<?php

namespace Database\Seeders;

use App\Models\Roots\Role;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\ModuleSeeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $stuffsRoles = Role::STUFFS_ROLES_NAME;
        foreach ($stuffsRoles as $key => $role) {
            Role::create([
                'id'   => $key,
                'name' => $role,
                'slug' => Str::slug($role),
                'deletable' => false
            ]);
        }

        $clientRoles = Role::CLIENT_ROLES_NAME;
        foreach ($clientRoles as $key => $role) {
            Role::create([
                'id'   => $key,
                'name' => $role,
                'slug' => Str::slug($role),
                'deletable' => false
            ]);
        }

        $this->call(ModuleSeeder::class);
    }
}
