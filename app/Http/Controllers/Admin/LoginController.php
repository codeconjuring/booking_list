<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        if ((auth()->check()) && (auth()->user()->user_type == 'admin')) {
            return redirect(route('admin.dashboard'));
        } else {
            return view('admin.login');
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        auth()->logout();
        sendFlash("Successfully Logout");
        return redirect(route('admin.login'));
    }

    public function forgotPassword()
    {
        return 'abcd';
    }
}
