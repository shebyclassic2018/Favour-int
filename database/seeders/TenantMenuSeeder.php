<?php

namespace Database\Seeders;

use App\Models\Roots\Menu;
use App\Models\Roots\Module;
use App\Models\Roots\MenuItem;
use Illuminate\Database\Seeder;

class TenantMenuSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$menu =  Menu::where('name', 'tenant')->first();

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
			'icon_class' => 'bi bi-person-lines-fill'
		]);

		$access->menuItems()->create([
			'menu_id' => $menu->id,
			'type' => 'item',
			'parent_id' => $accountItem->id,
			'order' => MenuItem::count() + 1,
			'title' => 'Personal Details',
			'url' => "/account/access/profile",
      'url_name' => "account.access.profile.index",
			'icon_class' => 'far fa-user-circle'
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

		$MyHome = $property->menuItems()->create([
			'menu_id' => $menu->id,
			'type' => 'item',
			'parent_id' => null,
			'order' => MenuItem::count() + 1,
			'title' => 'My Home',
			'url' => "#my-home",
			'icon_class' => 'fa fa-house-user'
		]);

			$property->menuItems()->create([
				'menu_id' => $menu->id,
				'type' => 'item',
				'parent_id' => $MyHome->id,
				'order' => MenuItem::count() + 1,
				'title' => 'Confirm Key',
				'url' => "/account/property/confirm-key",
				'url_name' => "account.property.confirm-key.index",
				'icon_class' => 'bi bi-key'
			]);

			$property->menuItems()->create([
				'menu_id' => $menu->id,
				'type' => 'item',
				'parent_id' => $MyHome->id,
				'order' => MenuItem::count() + 1,
				'title' => 'Rent Details',
				'url' => "/account/property/rental",
				'url_name' => "account.property.rental.index",
				'icon_class' => 'si si-home'
			]);



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




		## in future 
				# TODO Activate them,
					// $property->menuItems()->create([
					//     'type' => 'item',
					//     'parent_id' => $MyHome->id,
					//     'order' => MenuItem::count() + 1,
					//     'title' => 'House (IoT)',
					//     'url' => "/account/iot",
					//     'icon_class' => 'fa fa-users'
					// ]);

					// $property->menuItems()->create([
					//     'type' => 'item',
					//     'parent_id' => $MyHome->id,
					//     'order' => MenuItem::count() + 1,
					//     'title' => 'My Location',
					//     'url' => "/account/location",
					//     'icon_class' => 'fa fa-users'
					// ]);

					// ## and more

			// Service & Offer
			// $serviceOffer =  Module::where('slug', 'service-offers')->first();
			// $serviceOffer->menuItems()->create([
			// 	'menu_id' => $menu->id,
			// 	'type' => 'divider',
			// 	'parent_id' => null,
			// 	'order' => MenuItem::count() + 1
			// ]);

			// $services = $serviceOffer->menuItems()->create([
			// 	'menu_id' => $menu->id,
			// 	'type' => 'item',
			// 	'parent_id' => null,
			// 	'order' => MenuItem::count() + 1,
			// 	'title' => 'Our Plans',
			// 	'url' => "#our-plans",
			// 	'icon_class' => 'si si-check'
			// ]);

			// $serviceOffer->menuItems()->create([
			// 	'menu_id' => $menu->id,
			// 	'type' => 'item',
			// 	'parent_id' => $services->id,
			// 	'order' => MenuItem::count() + 1,
			// 	'title' => 'All Services',
			// 	'url' => "javascript:void(0)", # FIXME /'url' => "/account/plans",
			// 	'url_name' => "account.plans.index",
			// 	'icon_class' => 'si si-paper-clip'
			// ]);

			// $serviceOffer->menuItems()->create([
			//   'menu_id' => $menu->id,
			//   'type' => 'item',
			//   'parent_id' => null,
			//   'order' => MenuItem::count() + 1,
			//   'title' => 'Offers',
			//   'url' => "javascript:void(0)", # FIXME /account/offer',
			//   'icon_class' => 'si si-shuffle'
			// ]);
			

			// $financial->menuItems()->create([
			// 	'menu_id' => $menu->id,
			// 	'type' => 'item',
			// 	'parent_id' => $bank->id,
			// 	'order' => MenuItem::count() + 1,
			// 	'title' => 'MNO',
			// 	'url' => "/account/financials/mnos",
			// 	'url_name' => "account.financials.mnos.index",
			// 	'icon_class' => 'si si-screen-smartphone'
			// ]);

			// $withFund =  $financial->menuItems()->create([
			// 	'menu_id' => $menu->id,
			// 	'type' => 'item',
			// 	'parent_id' => null,
			// 	'order' => MenuItem::count() + 1,
			// 	'title' => 'Withdraw & Fund',
			// 	'url' => "#with-fund",
			// 	'icon_class' => 'si si-diamond'
			// ]);

			// $financial->menuItems()->create([
			// 	'menu_id' => $menu->id,
			// 	'type' => 'item',
			// 	'parent_id' => $withFund->id,
			// 	'order' => MenuItem::count() + 1,
			// 	'title' => 'Withdraw',
			// 	'url' => "javascript:void(0)", # FIXME '/account/financial/withdraw',
			// 	'icon_class' => 'si si-printer'
			// ]);

			// $financial->menuItems()->create([
			// 	'menu_id' => $menu->id,
			// 	'type' => 'item',
			// 	'parent_id' => $withFund->id,
			// 	'order' => MenuItem::count() + 1,
			// 	'title' => 'Funds',
			// 	'url' => "javascript:void(0)", # FIXME '/account/financial/funds',
			// 	'icon_class' => 'si si-drawer'
			// ]);


		// Page Controll

		// Tools $ Settings Control

	}
}
