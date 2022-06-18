<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peoples\Ownership;
use App\Models\Peoples\HouseOwnership;

class OwnershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = ['Account', 'Company'];
        for ($i = 0; $i < 10; $i++) {

            $prop_id = random_int(1, 10);
            $is_owner = true;
            $ownership_type = $type[random_int(0, 1)];
            $ownership_id = random_int(1, 10);

            HouseOwnership::create([
                'house_id' => $prop_id,
                'is_owner' => random_int(0, 1),
                'ownership_type' => $ownership_type,
                'ownership_id' => $ownership_id,
            ]);
        }
    }
}
