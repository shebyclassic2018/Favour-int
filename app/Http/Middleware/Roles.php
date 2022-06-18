<?php

namespace App\Http\Middleware;

use Closure;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class Roles
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
            return redirect()->route('welcome');
        }
    
        $roles = array_slice(func_get_args(), 2); // [default, admin, manager]
        
        foreach ($roles as $role) {
            try {
                if (Auth::user()->role->slug == $role) {
                    return $next($request);
                }
            } catch (ModelNotFoundException $exception) {
                return redirect()->route('login');
            }
        }

        Toastr::info('Access Denied', Auth::user()->role->slug .' does not have any of the necessary access right'); // custom flash class
        return redirect()->route('welcome');
    }
}
