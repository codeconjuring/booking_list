<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookList;
use App\Models\Category;
use App\Models\Language;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
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

    public function dashboard(Request $request)
    {
        $page_title              = "Dashboard";
        $number_of_unique_titles = BookList::whereMonth('created_at', Carbon::now()->month)->select('title', DB::raw('count(*) as total'))->groupBy('title')->get();
        // unique title
        $unique_title = BookList::distinct('title')->count();
        $total_series = Category::count();
        $book         = Book::count();

        if ($request->ajax()) {
            if ($request->service_id) {
                $series_wise_book_count = Book::whereCategoryId($request->service_id)->count();
                return response()->json(['series_count' => $series_wise_book_count]);
            }

            if ($request->language_id) {
                $get_language = Language::findOrFail($request->language_id);

                $book_language = BookList::whereLanguage(strtoupper($get_language->short_hand))->distinct('title')->count();
                return response()->json(['language_count' => $book_language]);
            }

        }

        $series_wise_title_count = BookList::whereCategoryId(1)->distinct('title')->count();

        $languages = Language::all();
        $series    = Category::all();

        return view('admin.dashboard', compact('page_title', 'number_of_unique_titles', 'unique_title', 'total_series', 'book', 'languages', 'series'));

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
