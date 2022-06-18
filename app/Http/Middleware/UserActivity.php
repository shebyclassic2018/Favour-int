<?php

namespace App\Http\Middleware;

use App\Models\Peoples\Logs;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserActivity
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

    # FIXME: user activity to activate is active or logged out.

    // if (!Auth::check()) {
    //     // This isnt necessary, it should be part of your 'auth' middleware
    //     return redirect()->route('welcome');
    // }

    // if (returnUser()) {
    //   $expiresAt = now()->addMinutes(1); /* already given time here we already set 2 min. */
    //   Cache::put('user-is-online-' . returnUser()->id, true, $expiresAt);

    //   /* user last seen */
    //   User::where('id', returnUser()->id)->update(['is_active' => false]);
    //   returnUser()->logs()->update(['loggedOut' => now()]);

    //   // $logs = Logs::where('user_id', returnUser()->id)
    //   //   ->orderBy('id', 'DESC')
    //   //   ->first();

    //   //   dd($logs);
    //     // ->update(['loggedOut' => now()]);
    // }

    return $next($request);
  }
}
