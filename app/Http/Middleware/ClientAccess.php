<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClientAccess
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
        $role_ids = [];

        foreach (handleRoleList('clientList') as $value) {
           array_push($role_ids, $value->id);
        }

        if (!in_array(auth()->user()->role_id, $role_ids)) {
            abort('403');
        }

        return $next($request);
    }
}
