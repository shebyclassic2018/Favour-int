<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payments\PaymentServices;

class PaymentServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentServices::updateOrCreate([
            'serviceCode' => 'NGATAHOMES',
            'serviceName' => 'Appointment',
            'accountNumber' => '005301000232',
            'type' => 'House visit payment'
        ]);
    }
}
