<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookList;
use App\Models\User;
use Carbon\Carbon;
use DB;
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
        $page_title              = "Dashboard";
        $number_of_unique_titles = BookList::whereMonth('created_at', Carbon::now()->month)->select('title', DB::raw('count(*) as total'))->groupBy('title')->get();
        return view('admin.dashboard', compact('page_title', 'number_of_unique_titles'));
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
