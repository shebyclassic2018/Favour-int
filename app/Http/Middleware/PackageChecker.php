<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Roots\Role;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class PackageChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // This isnt necessary, it should be part of your 'auth' middleware
            return redirect()->route('welcome');
        }


        if (in_array(myRoleID(authUser()), Role::STUFFS)) {
            return $next($request);
        }

        if (in_array(myRoleID(authUser()), Role::CLIENTS)) {

            if (myRoleID(authUser()) == Role::IS_TENANT) {
                return $next($request);
            }

            // dd(returnAccount());

            if (returnAccount()->is_acc_active) {
                return $next($request);
            }

            return redirect()->route('account.rent.index');

        }
    }
}
