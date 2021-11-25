<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginRequest;

class HomeController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function attempt(LoginRequest $request)
    {
        $admin = $request->only(['email', 'password']);
        if (auth()->attempt($admin, true)) {
            // sendFlash("You are successfully login.");
            return redirect(route('admin.dashboard'));
        } else {
            // sendFlash("We can't found you", 'error');
            return view('login');
        }

    }
}
