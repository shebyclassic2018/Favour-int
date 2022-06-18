<?php

namespace Database\Seeders;


use App\Models\Roots\Menu;
use App\Models\Roots\Module;
use App\Models\Roots\Service;
use App\Models\Roots\MenuItem;
use Illuminate\Database\Seeder;

class AgentMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $menu =  Menu::where('name', 'agent')->first();

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
            'url' => "/app/dashboard",
            'url_name' => "app.dashboard",
            'icon_class' => 'si si-speedometer'
        ]);


        // Access Controll
        $access =  Module::where('slug', 'access-control')->first();
        $access->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'divider',
            'parent_id' => null,
            'order' => MenuItem::count() + 1
        ]);

        $access->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => null,
            'order' => MenuItem::count() + 1,
            'title' => 'Users',
            'url' => "/app/users",
            'url_name' => "app.staff.index",
            'icon_class' => 'fa fa-users'
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

        $house = $property->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => null,
            'order' => MenuItem::count() + 1,
            'title' => 'Houses',
            'url' => "#houses",
            'icon_class' => 'si si-home'
        ]);

        $property->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => $house->id,
            'order' => MenuItem::count() + 1,
            'title' => 'Checkout',
            'url' => "/app/houses/verify/unverified",
            'url_name' => "app.houses.verify.unverified",
            'icon_class' => 'si si-check'
        ]);

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
                'url' => "javascript:void(0)", # FIXME 'url' => '/' . str_replace('.', '/', str_replace('service', 'account', $value->url)),
                'url_name' => "app." . $value->url . ".index",
                'icon_class' => 'fa fa-home'
            ]);
        }

        $serviceOffer->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => $services->id,
            'order' => MenuItem::count() + 1,
            'title' => 'All Services',
            'url' => "javascript:void(0)", # FIXME /'url' => "/account/plans",
            'url_name' => "account.plans.index",
            'icon_class' => 'si si-paper-clip'
        ]);

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

        // $bank =  $financial->menuItems()->create([
        //     'menu_id' => $menu->id,
        //     'type' => 'item',
        //     'parent_id' => null,
        //     'order' => MenuItem::count() + 1,
        //     'title' => 'Bank & Cards',
        //     'url' => "#financial",
        //     'icon_class' => 'si si-credit-card'
        // ]);
        //     $financial->menuItems()->create([
        //         'menu_id' => $menu->id,
        //         'type' => 'item',
        //         'parent_id' => $bank->id,
        //         'order' => MenuItem::count() + 1,
        //         'title' => 'Bank',
        //         'url' => "/account/financials/banks",
        //         'icon_class' => 'si si-tag'
        //     ]);

        //     $financial->menuItems()->create([
        //         'menu_id' => $menu->id,
        //         'type' => 'item',
        //         'parent_id' => $bank->id,
        //         'order' => MenuItem::count() + 1,
        //         'title' => 'MNO',
        //         'url' => "/account/financials/mnos",
        //         'icon_class' => 'si si-screen-smartphone'
        //     ]);



        $withFund =  $financial->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => null,
            'order' => MenuItem::count() + 1,
            'title' => 'Withdraw & Fund',
            'url' => "#with-fund",
            'icon_class' => 'si si-diamond'
        ]);
        $financial->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => $withFund->id,
            'order' => MenuItem::count() + 1,
            'title' => 'Withdraw',
            'url' => "javascript:void(0)", # FIXME '/account/financial/withdraw',
            'icon_class' => 'si si-printer'
        ]);

        $financial->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => $withFund->id,
            'order' => MenuItem::count() + 1,
            'title' => 'Funds',
            'url' => "javascript:void(0)", # FIXME '/account/financial/funds',
            'icon_class' => 'si si-drawer'
        ]);


        // Page Controll
        $page =  Module::where('slug', 'page-control')->first();
        $page->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'divider',
            'parent_id' => null,
            'order' => MenuItem::count() + 1
        ]);

        $page->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => null,
            'order' => MenuItem::count() + 1,
            'title' => 'Pages',
            'url' => "/app/pages",
            'icon_class' => 'si si-paper-clip'
        ]);

        // Tools $ Settings Control
        $toolsSettings =  Module::where('slug', 'tools-settings')->first();

        $toolsSettings->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'divider',
            'parent_id' => null,
            'order' => MenuItem::count() + 1
        ]);

        $toolsSettings->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => null,
            'order' => MenuItem::count() + 1,
            'title' => 'Analytics',
            'url' => "javascript:void(0)", # FIXME '/account/financial/analytics',
            'icon_class' => 'si si-bar-chart'
        ]);

        $toolsSettings->menuItems()->create([
            'menu_id' => $menu->id,
            'type' => 'item',
            'parent_id' => null,
            'order' => MenuItem::count() + 1,
            'title' => 'Settings',
            'url' => "/app/settings/general",
            'icon_class' => 'si si-settings'
        ]);

    }
}
