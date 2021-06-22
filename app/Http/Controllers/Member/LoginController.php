<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login()
    {
        if(auth()->guard('member')->check()) return redirect(route('member-dashboard'));
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $auth = $request->only('email','password');
        $auth['status'] = 1;

        if (auth()->guard('member')->attempt($auth)) {
            return redirect()->intended(route('member-dashboard'));
        }
        return redirect()->back()->with(['error' => 'Email / Password salah']);
    }

    public function logout()
    {
        auth()->guard('member')->logout();
        return redirect('/');
    }

}
