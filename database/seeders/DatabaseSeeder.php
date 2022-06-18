<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CitySeeder;
use Database\Seeders\MenuSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\ChannelSeeder;
use Database\Seeders\PackageSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\ContractSeeder;
use Database\Seeders\HouseTypeSeeder;
use Database\Seeders\NgataTarifSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\AccountTypeSeeder;
use Database\Seeders\PropertyTypeSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ChannelSeeder::class);
        $this->call(NgataTarifSeeder::class);
        $this->call(ContractSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(HouseTypeSeeder::class);
        $this->call(PropertyTypeSeeder::class);
        $this->call(AccountTypeSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(PackageSeeder::class);
    }
}
