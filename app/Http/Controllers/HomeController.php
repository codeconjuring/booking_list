<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\Form\FormController;
use App\Http\Requests\Login\LoginRequest;
use App\Models\BookList;
use App\Models\Cat;
use App\Models\Category;
use App\Models\FormBuilder;
use App\Models\Status;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function downloadPdf(Request $request)
    {
        return resolve(FormController::class)->downloadPdf($request);
    }

    public function showMoreTitle(Request $request)
    {
        $frontend_request = 0;
        if (isset($request->frontend_request)) {
            $frontend_request = 1;
        }

        $e_id   = $request->e_id;
        $book_i = $request->book_i;
        if ($e_id != null && $book_i != null) {
            $getBookLists = BookList::whereBookId($e_id)->whereAddAnotherBookTranslation('1')->get();
            $form_builder = FormBuilder::all();
            $status_array = [];
            $status       = Status::all();
            foreach ($status as $st) {
                $status_array[$st->id]     = $st->status;
                $status_array[$st->status] = $st->color;
            }
            $view = view('admin.form.more_title', ['getBookLists' => $getBookLists, 'form_builder' => $form_builder, 'status_array' => $status_array, 'frontend_request' => $frontend_request])->render();
            return response()->json(['view' => $view]);
        }
    }

    public function index(Request $request)
    {
        // Tempory Variable
        // $series_name = "";

        $select_status  = isset($request->status_ids) ? $request->status_ids : [];
        $entry_id       = 0;
        $paginate_range = 0;
        $top_scroll     = 0;
        if ($request->e_id && $request->book_i && $request->scroll) {
            $entry_id       = $request->e_id;
            $paginate_range = $request->book_i;
            $top_scroll     = $request->scroll;
        }

        $row_show = 0;
        if ($request->book_list_show) {
            $row_show = $request->book_list_show;
        }

        $page_title      = "Book lists";
        $form_builder    = FormBuilder::orderBy('order_table', 'asc')->get();
        $series_group_by = BookList::select('category_id')->groupBy('category_id')->get();
        $series_count    = BookList::select('category_id', DB::raw('count(*) as total'))->groupBy('category_id')->get();

        $data = [];
        foreach ($series_group_by as $single_group) {
            $collections = BookList::whereCategoryId($single_group->category_id)->get();
            if (count($collections) > 1) {
                foreach ($collections as $key => $collection) {
                    array_push($data, $collection);
                }
            } elseif (count($collections) == 1) {
                array_push($data, $collections[0]);
            }

        }

        $select_language = [];
        if ($request->language) {
            $select_language = $request->language;
        }
        $filter_data = 0;
        if (($request->language) || ($request->series_ids) || ($request->status_ids)) {
            $filter_data = 1;
        }
        $select_series = [];
        if ($request->series_ids) {
            $getSeriyes    = BookList::whereIn('category_id', $request->series_ids)->select('category_id')->groupBy('category_id')->get();
            $select_series = $request->series_ids;
        } else {
            $getSeriyes = BookList::select('category_id')->groupBy('category_id')->get();
        }

        $series_ids = [];
        foreach ($getSeriyes as $key => $series) {
            array_push($series_ids, $series->category_id);
        }

        $series         = Category::whereIn('id', $series_ids)->get();
        $languages      = BookList::select('language')->distinct('language')->get();
        $status_array   = [];
        $get_all_series = Category::all();
        $status         = Status::all();
        if (count($select_status) > 0) {
            foreach ($status as $st) {

                if (in_array((string) $st->id, $select_status)) {
                    $status_array[$st->id]     = $st->status;
                    $status_array[$st->status] = $st->color;
                }

            }
        } else {
            foreach ($status as $st) {

                $status_array[$st->id]     = $st->status;
                $status_array[$st->status] = $st->color;

            }
        }

        $tags = Cat::orderBy('name')->get();

        return view('update_welcome', compact('page_title', 'form_builder', 'series', 'getSeriyes', 'status', 'status_array', 'row_show', 'languages', 'entry_id', 'paginate_range', 'top_scroll', 'tags', 'select_language', 'filter_data', 'select_series', 'select_status', 'get_all_series'));

    }

    public function login()
    {
        if (auth()->check()) {
            return redirect(route('admin.dashboard'));
        } else {
            return view('login');
        }
    }

    public function attempt(LoginRequest $request)
    {
        $admin = $request->only(['email', 'password']);
        if (auth()->attempt($admin, true)) {
            sendFlash("You are successfully login.");
            return redirect(route('admin.dashboard'));
        } else {
            sendFlash("We can't found you", 'error');
            return view('login');
        }

    }

    public function logout()
    {
        auth()->logout();
        sendFlash("Successfully Logout");
        return redirect(route('login'));
    }
}
