<?php

namespace Database\Seeders;

use App\Models\Roots\City;
use App\Models\Roots\Ward;
use App\Models\Roots\District;
use App\Models\Roots\Station;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = ['Dar es salaam', 'Morogoro', 'Tanga', 'Tabora', 'Mbeya'];
        $abbr = ['DSM', 'MG', 'TA', 'TBR', 'MBY'];

        foreach ($cities as $key => $city) {
            City::create([
                'name' => $city,
                'abbr' => $abbr[$key]
            ]);
        }

        $this->DistrictSeeder();
    }

    protected function DistrictSeeder() {
        $districts = ['Kigamboni', 'Temeke', 'Mvomero', 'M/Mjini'];
        $cityId = [1, 1, 2, 2];

        foreach ($districts as $key => $district) {
            District::updateOrCreate([
                'city_id' => $cityId[$key],
                'name' => $district
            ]);
        }

        $this->WardSeeder();
    }

    protected function WardSeeder()
    {
        $wards = ['Vijibweni', 'Mbagala', 'Mazimbu', 'Turian', 'Mzumbe'];
        $districtId = [1, 2, 4, 3, 3];

        foreach ($wards as $key => $ward) {
            Ward::create([
                'district_id' => $districtId[$key],
                'name' => $ward
            ]);
        }

        $this->Stations();
    }

    protected function Stations()
    {
        Station::create([
            'ward_id'   => 1,
            'name'      => 'Vijibweni Hospital',
            'latitude'  => '-6.859851533204526',
            'longitude' => '39.32241438432255'
        ]);
    }

    
}
