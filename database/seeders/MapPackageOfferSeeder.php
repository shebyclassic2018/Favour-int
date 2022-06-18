<?php

namespace Database\Seeders;

use App\Models\Roots\Role;
use App\Models\Roots\Package;
use Illuminate\Database\Seeder;
use App\Models\Roots\PackageRole;
use App\Models\Services\PackageOffer;

class MapPackageOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ALL OFFERS
        $offers = [
            "Unlimited number of units to register.",
            "Accessible by unlimited number of responsible tenets every day.",
            "Monthly total Rent payment Report",
            "Monthly Property Financial Report",
            "Unlimited access to hundreds of Hardware next to your building",
            "Unlimited access to affordable Fundis",
            "Daily property visitor’s counter",
            "Professional property management",
            "Access to renovation loan",
        ];

        # INSERT OFFERS PROVIDED BY NHA TO PACKAGES SELECTED BY USERS
        foreach ($offers as $offer) { PackageOffer::updateOrCreate(['content' => $offer]);}

        # GET ALL PACKAGES
        $allOffersForOwners = PackageOffer::get();


        # Role::IS_OWNER
        $OwnerPackageRoles = PackageRole::where('role_id', Role::IS_OWNER)->get();
  
        # MAP TO PACKAGE
        # Package::IS_PROPERTY_OWNER
        $exceptForOwnerPackage = [4, 7, 8, 9];
        foreach ($OwnerPackageRoles->where('package_id', Package::IS_PROPERTY_OWNER) as $packageRole) {
            foreach ($allOffersForOwners as $offersForOwner) {
                if (in_array($offersForOwner->id,  $exceptForOwnerPackage)) {
                    $this->insertDataIntMap($packageRole, $offersForOwner, false);
                }else {
                    $this->insertDataIntMap($packageRole, $offersForOwner, true);
                }
            }
        }

        # Package::IS_PREMIUM
        foreach ($OwnerPackageRoles->where('package_id', Package::IS_PREMIUM) as $premium) {
            foreach ($allOffersForOwners as $offersForPremium) {
                $this->insertDataIntMap($premium, $offersForPremium, true);
            }
        }


        # GET ALL PACKAGES
        $allOffersForDalali = PackageOffer::where('id', '>', 9)->pluck('id');


        # Role::IS_OWNER
        $DalaliPackageRoles = PackageRole::where('role_id', Role::IS_DALALI)->get();



    }

    protected function insertDataIntMap($targetRole, $offer, $state) {
        $targetRole->mapPackageOffers()->create([
            'package_offer_id' => $offer->id,
            'is_offered' => $state
        ]);
    }
}
