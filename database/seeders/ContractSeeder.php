<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Companies\Contract;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contarcts = ['TENANT CONTRACT', 'PROPERTY MANAGEMENT AGREEMENT',];
        foreach ($contarcts as $key => $value) {
            Contract::create([
                'path' => Str::slug($value) . '.docx'
            ]);
        }
    
    }
}
