<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Financials\Channel;
use App\Models\Financials\NgataTarif;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel = 'Mwanga Hakika Bank';
        Channel::create([
            'title'   => $channel,
            'abbr'   => 'MHB',
            'type'  => 'Banks',
            'slug'  => Str::slug($channel),
            'url'  => 'https://mhbbank.co.tz/',
            'logo'  => 'mhb-logo.png',
            'is_used' => true
        ]);

        $channel = 'Vodacome';
        Channel::create([
            'title'   => $channel,
            'abbr'   => 'M-PESA',
            'type'  => 'MNOs',
            'slug'  => Str::slug($channel),
            'logo'  => 'payment_default.webp',
            'is_used' => true
        ]);

        $channel = 'Tigo';
        Channel::create([
            'title'   => $channel,
            'abbr'   => 'TIGO-PES',
            'type'  => 'MNOs',
            'slug'  => Str::slug($channel),
            'logo'  => 'payment_default.webp',
            'is_used' => true
        ]);
    }

    
}
