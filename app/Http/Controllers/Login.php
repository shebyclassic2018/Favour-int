<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class Login extends Controller
{
    //
    use RedirectsUsers, ThrottlesLogins;
    
    function login(Request $req) {
        $email = $req->email;
        $password = $req->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect('admin/staffs');
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson() ? new JsonResponse([], 204) : redirect('/');
    }

    protected function guard()
    {
        return Auth::guard();
    }

    protected function loggedOut(Request $request)
    {
  
    }
}


