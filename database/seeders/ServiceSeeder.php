<?php

namespace Database\Seeders;

use App\Models\Roots\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $services = ['Rent', 'Rent-To-Own', 'Market Place', 'Investiment'];

        // $icons    = ['flaticon-badge', 'ifc-handle_with_care', 'flaticon-house',
        // 'fa fa-money', 'ifc-hammer'];


        $services = loadJasonFile('defaultData')['services']['names'];
        $icons    = loadJasonFile('defaultData')['services']['icons'];

        foreach ($services as $key => $service) {

            $service_slug = Str::slug($service);

            if ($service == 'Market Place') {
                $service_url = 'https://vifaa.ngata.co.tz';
                $service_target = '_blank';
            } else {
                $service_url = str_replace('-', '.', 'service-' . $service_slug);
                $service_target = '_self';
            }

            Service::create([
                'title'      => $service,
                'order'      => Service::count() + 1,
                'url'        => $service_url,
                'target'     => $service_target,
                'icon_class' => $icons[$key],
                'slug'       => $service_slug
            ]);
        }
    }
}
