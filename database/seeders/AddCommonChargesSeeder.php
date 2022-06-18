<?php

namespace Database\Seeders;

use App\Models\CommonCharge;
use Illuminate\Database\Seeder;

class AddCommonChargesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $commonCharges = [
            ['type' => 'House visit fee', 'amount' => 10000],
            ['type' => 'Boda',            'amount' => 1000],
            ['type' => 'Bajaj',           'amount' => 2000],
            ['type' => 'Tax',             'amount' => 3000]
        ];

        foreach ($commonCharges as $charge) {
            CommonCharge::updateOrCreate([
                'type' => $charge['type'], 'amount' => $charge['amount']
            ]);
        }
    }
}
