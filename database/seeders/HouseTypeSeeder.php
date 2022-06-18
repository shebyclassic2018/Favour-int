<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Properties\Icon;
use Illuminate\Database\Seeder;
use App\Models\Properties\HouseType;

class HouseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        $house_type = ['Affordable House/Budget House', 'Stand Alone', 'Apartment', 'Bungalow', 'Villa', 'Country House',
         'Condominium', 'Town home', 'Manor', 'Mobile Home', 'Coach house', 'Multi Family',
         'Cabin','Mansion','McMansion'];

        foreach ($house_type as $value) {
            HouseType::create([
                'title' => $value,
                'slug' => Str::slug($value)
            ]);
        }


        $this->Icon();

    }


    protected function Icon()
    {
        Icon::create([
            'file_name' => 'home.png',
            'slug' => Str::slug('Home.png'),
        ]);
    }
}
