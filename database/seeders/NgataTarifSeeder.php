<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Financials\NgataTarif;
use Database\Seeders\PaymentServicesSeeder;
use Database\Seeders\AddCommonChargesSeeder;

class NgataTarifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NgataTarif::updateOrCreate([
            'code'   => 'NGA-0001', 'name'  => 'Visit Ratio',
            'initiator'  => null, 'system' => 50, 'guider'  => 50,
            'linker' => null, 'status' => true
        ]);

        NgataTarif::updateOrCreate([
            'code'   => 'NGA-0002', 'name'  => 'Normal Commission Ratio',
            'initiator'  => 50, 'system' => 50, 'guider'  => null,
            'linker' => null, 'status' => true
        ]);

        NgataTarif::updateOrCreate([
            'code'   => 'NGA-0003', 'name'  => 'Linked Commission Ratio',
            'initiator'  => 50, 'system' => 30, 'guider'  => null,
            'linker' => 20, 'status' => true
        ]);

        $this->call(AddCommonChargesSeeder::class);
        $this->call(PaymentServicesSeeder::class);
    }

}
