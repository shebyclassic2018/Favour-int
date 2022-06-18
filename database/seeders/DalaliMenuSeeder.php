<?php

namespace Database\Seeders;


use App\Models\Roots\Menu;
use App\Models\Roots\Module;
use App\Models\Roots\Service;
use App\Models\Roots\MenuItem;
use Illuminate\Database\Seeder;

class DalaliMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu =  Menu::where('name', 'dalali')->first();

        // Summary Controll
        $summary =  Module::where('slug', 'summary-control')->first();


        $summary->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'divider',
            'parent_id' => null,
            'order' => MenuItem::count() + 1
        ]);

        $summary->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => null,
            'order' => MenuItem::count() + 1,
            'title' => 'Dashboard',
            'url' => "/account/home", 
      'url_name' => "account.home",
            'icon_class' => 'si si-speedometer'
        ]);

        // Access Controll
        $access =  Module::where('slug', 'access-control')->first();
        $access->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'divider',
            'parent_id' => null,
            'order' => MenuItem::count() + 1,
            'divider_title' => 'Access Control'
        ]);

        $accountItem = $access->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => null,
            'order' => MenuItem::count() + 1,
            'title' => 'Account',
            'url' => "#accounts",
            'icon_class' => 'si si-check'
        ]);

        $access->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => $accountItem->id,
            'order' => MenuItem::count() + 1,
            'title' => 'Private Details',
            'url' => "/account/access/profile",
            'url_name' => "account.access.profile.index",
            'icon_class' => 'far fa-user-circle'
        ]);


        $access->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => $accountItem->id,
            'order' => MenuItem::count() + 1,
            'title' => 'Company Details',
            'url' => "/account/access/company",
            'url_name' => "account.access.company.index",
            'icon_class' => 'si si-home'
        ]);

        // Property Controll
        $property =  Module::where('slug', 'property-control')->first();

        # Property Management
        $property->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'divider',
            'parent_id' => null,
            'order' => MenuItem::count() + 1
        ]);

        $myProperties = $property->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => null,
            'order' => MenuItem::count() + 1,
            'title' => 'Manage Properties',
            'url' => "#manage-properties",
            'icon_class' => 'si si-check'
        ]);

        $property->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => $myProperties->id,
            'order' => MenuItem::count() + 1,
            'title' => 'House',
            'url' => "/account/property/house",
            'url_name' => "account.property.house.index",
            'icon_class' => 'fa fa-home'
        ]);

        // $property->menuItems()->create([
        //     'menu_id' => $menu->id,
        //     'type' => 'item',
        //     'parent_id' => $myProperties->id,
        //     'order' => MenuItem::count() + 1,
        //     'title' => 'Land',
        //     'url' => "javascript:void(0)", # FIXME '/account/property/land',
        //     'icon_class' => 'fa fa-home'
        // ]);

        // $property->menuItems()->create([
        //     'menu_id' => $menu->id,
        //     'type' => 'item',
        //     'parent_id' => $myProperties->id,
        //     'order' => MenuItem::count() + 1,
        //     'title' => 'Materials',
        //     'url' => "javascript:void(0)", # FIXME '/account/property/material',
        //     'icon_class' => 'fa fa-home'
        // ]);

        // Service & Offer
        $serviceOffer =  Module::where('slug', 'service-offers')->first();
        $serviceOffer->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'divider',
            'parent_id' => null,
            'order' => MenuItem::count() + 1
        ]);

        $services = $serviceOffer->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => null,
            'order' => MenuItem::count() + 1,
            'title' => 'Our Plans',
            'url' => "#our-plans",
            'icon_class' => 'si si-check'
        ]);

        $ourPlansList = Service::where('slug', 'rent')->get();
        foreach ($ourPlansList as $value) {
            $serviceOffer->menuItems()->create([
                'menu_id' => $menu->id,
                'type' => 'item',
                'parent_id' => $services->id,
                'order' => MenuItem::count() + 1,
                'title' => $value->title,
                'url' => '/' . str_replace('.', '/', str_replace('service', 'account', $value->url)),
                'url_name' => "account" . str_replace('service', '', $value->url) . ".index",
                'icon_class' => 'fa fa-home'
            ]);
        }

        // $serviceOffer->menuItems()->create([
        //   'menu_id' => $menu->id,
        //   'type' => 'item',
        //   'parent_id' => null,
        //   'order' => MenuItem::count() + 1,
        //   'title' => 'Offers',
        //   'url' => "javascript:void(0)", # FIXME /account/offer',
        //   'icon_class' => 'si si-shuffle'
        // ]);

        // Financial Controll

        $financial =  Module::where('slug', 'financial-control')->first();
        $financial->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'divider',
            'parent_id' => null,
            'order' => MenuItem::count() + 1
        ]);

        $myAccount =  $financial->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => null,
            'order' => MenuItem::count() + 1,
            'title' => 'Financial',
            'url' => "#financial",
            'icon_class' => 'si si-credit-card'
        ]);

            $financial->menuItems()->create([
                'menu_id' => $menu->id,
                'type' => 'item',
                'parent_id' => $myAccount->id,
                'order' => MenuItem::count() + 1,
                'title' => 'Bank & MNOs',
                'url' => "/account/financials/my-accounts",
                'url_name' => "account.financials.my-accounts",
                'icon_class' => 'bi bi-phone-vibrate'
            ]);

            $financial->menuItems()->create([
                'menu_id' => $menu->id,
                'type' => 'item',
                'parent_id' => $myAccount->id,
                'order' => MenuItem::count() + 1,
                'title' => 'Payments',
                'url' => "/account/financials/payments",
                'url_name' => "account.financials.payments",
                'icon_class' => 'bi bi-wallet2'
            ]);




            // $withFund =  $financial->menuItems()->create([
                //     'menu_id' => $menu->id,
                //     'type' => 'item',
                //     'parent_id' => null,
                //     'order' => MenuItem::count() + 1,
                //     'title' => 'Withdraw & Fund',
                //     'url' => "#with-fund",
                //     'icon_class' => 'si si-diamond'
                // ]);
                // $financial->menuItems()->create([
                //     'menu_id' => $menu->id,
                //     'type' => 'item',
                //     'parent_id' => $withFund->id,
                //     'order' => MenuItem::count() + 1,
                //     'title' => 'Withdraw',
                //     'url' => "javascript:void(0)", # FIXME '/account/financial/withdraw',
                //     'icon_class' => 'si si-printer'
                // ]);

                // $financial->menuItems()->create([
                //     'menu_id' => $menu->id,
                //     'type' => 'item',
                //     'parent_id' => $withFund->id,
                //     'order' => MenuItem::count() + 1,
                //     'title' => 'Funds',
                //     'url' => "javascript:void(0)", # FIXME '/account/financial/funds',
                //     'icon_class' => 'si si-drawer'
            // ]);


        // Page Controll

        // Tools $ Settings Control
    }
}
