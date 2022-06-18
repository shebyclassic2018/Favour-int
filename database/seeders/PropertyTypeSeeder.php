<?php

namespace Database\Seeders;

use App\Models\Properties\PropertyType;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $property_taype = ['House', 'Land', 'Constraction Materials'];

        foreach ($property_taype as $type) {
            PropertyType::create(['title' => $type, 'slug' => Str::slug($type)]);
        }

    }
}
