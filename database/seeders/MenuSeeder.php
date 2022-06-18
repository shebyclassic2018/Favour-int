<?php

namespace Database\Seeders;

use App\Models\Roots\Menu;
use App\Models\Roots\Role;
use Illuminate\Database\Seeder;
use Database\Seeders\AgentMenuSeeder;
use Database\Seeders\OwnerMenuSeeder;
use Database\Seeders\DalaliMenuSeeder;
use Database\Seeders\TenantMenuSeeder;
use Database\Seeders\GeneralMenuSeeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();

        foreach ($roles as $role) {
            if ($role->slug == 'super-admin') {
                Menu::updateOrCreate([
                    'name' => $role->slug,
                    'description' => 'This is menu for ' . $role->name,
                    'deletable' => false
                ]);
            } else {
                Menu::updateOrCreate([
                    'name' => $role->slug,
                    'description' => 'This is menu for ' . $role->name,
                    'deletable' => false
                ]);
            }
        }

        $this->call(GeneralMenuSeeder::class);
        $this->call(AgentMenuSeeder::class);
        $this->call(TenantMenuSeeder::class);
        $this->call(OwnerMenuSeeder::class);
        $this->call(DalaliMenuSeeder::class);
    }
}
