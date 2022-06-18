<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Roots\MenuItem;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\Relation;


class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {

    // BLADE VIEW
    ## FACILITY
    // Blade::directive('facilityname', function ($facityName) {
    //   return (Str::contains($facityName , 'Bed')) ? explode(' ', $facityName)[0] : $facityName;
    // });



    Blade::if('role', function ($role) {
      return Auth::user()->role->slug == $role;
    });

    Blade::if('allowed', function (MenuItem $item) {
      if(str_contains($item->type, 'divider')) {
        return ((!isClient()) ?? false) && (str_contains($item->module->name, 'Settings')) ?? false;
      }else {

        if (str_contains($item->title, 'Company')) {
          return (isAccountTypeCompany(authUser())) ?? false;
        }
        if(isTenant() && str_contains($item->url, '#my-home')) {
          // return (!myAccountHasRentInstance()) ?? false;
          return true;
        } else {
          if (isDalali() && str_contains($item->title, 'Manage')) {
            return (isPackagePremium() || isPackageMchongo()) ?? false;
          }else {
            return true;
          }
        }
      }
    });


    Blade::if('stuff', function (User $user) {
      return isStuff($user);
    });

    Blade::if('isagent', function (User $user) {
      return isAgent($user);
    });

    Blade::if('super', function (User $user) {
      return isSuper($user);
    });

    Blade::if('isadmin', function (User $user) {
      return isAdmin($user);
    });

    Blade::if('isclient', function (User $user) {
      return isClient($user);
    });

    Blade::if('isblocker', function (User $user) {
      return isDalali($user);
    });

    Blade::if('istenant', function (User $user) {
      return isTenant($user);
    });



    Blade::if('hascompany', function (User $user) {
      if (isAccountTypeCompany() ?? false) {
        return isAccountTypeCompanyHasCompany($user) ?? false;
      }else {
        return false;
      }
    });

    # Comapny Directive
    Blade::if('iscompany', function (User $user) {
      return isAccountTypeCompany($user);
    });

    # Individual Directive
    Blade::if('isindividual', function (User $user) {
      return isAccountTypeIndividual($user);
    });

    Blade::if('haspackage', function () {
      return haspackage();
    });

    Blade::if('upgrade', function (User $user, Int $package_id) {
      // $user->account->packageRole->package->id

      // if(isRoleExisting(authUser(), Role::CLIENTS, 'list')) {
      //   if(myRoleID($user) == Role::IS_TENANT) {
      //     return true;
      //   }else {
      //     return (haspackage($user) && $package_id == getAccountPackage($user)->package_id) ?? false;
      //   }
      // }else {
      //   return true;
      // }


      return $package_id == getAccountPackage($user)->package_id ?? false;
    });

    Blade::if('downgrade', function (User $user, Int $package_id) {
      return ($package_id == getAccountPackage($user)->package_id);
    });

    # TODO upgrade or downgrade Package
    Blade::if('addOrRemove', function (Int $package_id) {
      return addOrRemoveButton($package_id);
    });




    # PACKAGE BLADES
    ## For Blocker
    Blade::if('doesBlockerIsAssociated', function () {
      return doesBlockerIsAssociated();
    });

    ## For Owners



    // Paginator::useBootstrap();
    Paginator::defaultView('pagination::default');

    // Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
    //   $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

    //   return new LengthAwarePaginator(
    //     $this->forPage(),
    //     $total ?: $this->count(),
    //     $perPage,
    //     $page,
    //     [
    //       'path' => LengthAwarePaginator::resolveCurrentPath(),
    //       'pageName' => $pageName,
    //     ]
    //   );
    // });

    Relation::morphMap([
      'User'    => \App\Models\User::class,
      'Rent'    => \App\Models\Services\Rent::class,
      'Guest'   => \App\Models\Peoples\Guest::class,
      'Unit'    => \App\Models\Properties\Unit::class,
      'House'   => \App\Models\properties\House::class,

      'Account'   => \App\Models\Peoples\Account::class,
      'Address'   => \App\Models\Peoples\Address::class,
      'Company'   => \App\Models\Companies\Company::class,
      'Financial' => \App\Models\Financials\Financial::class,

      'Appointment'    => \App\Models\Peoples\Appointment::class,
      'Contactable'    => \App\Models\Mophs\Contactable::class,
      'AssociatedWith' => \App\Models\Mophs\AssociatedWith::class,
    ]);

    Blade::directive('currency', function ($value) {
      $val =  "<?php if ($value == 0 && $value < 1000) {
        echo $value;
      } else if ($value >= 1000 && $value < 1000000) {
        $value /= 1000;
        echo $value .= 'k';
      } else if ($value >= 1000000 && $value < 1000000000) {
        $value /= 1000000;
        echo $value .= 'M';
      } else if ($value >= 1000000000){
        $value /= 1000000000;
        echo $value .= 'B';
      } ?>";

      return $val;
    });

    Blade::directive('number_format', function ($value) {
      return "<?php echo number_format($value, 2); ?>";
    });
  }
}
