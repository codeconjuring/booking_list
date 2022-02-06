<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookList;
use App\Models\Category;
use App\Models\FormBuilder;
use App\Models\Language;
use App\Models\Status;
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
        $total_titles = BookList::distinct('book_id')->count();
        $total_series = Category::count();
        $total_books  = BookList::count();

        if ($request->ajax()) {
            if ($request->service_id) {
                $series_wise_book_count = BookList::whereCategoryId($request->service_id)->distinct('book_id')->count();
                return response()->json(['series_count' => $series_wise_book_count]);
            }

            if ($request->language_id) {
                // $get_language = Language::findOrFail($request->language_id);
                // return $get_language->short_hand;
                $book_language = BookList::whereLanguage(strtoupper($request->language_id))->count();
                return response()->json(['language_count' => $book_language]);
            }

            if ($request->language) {
                $form_builders             = FormBuilder::get();
                $col_array                 = [];
                $col_status_array          = [];
                $colum_status_map          = [];
                $col_map                   = [];
                $col_final_array           = [];
                $col_status_map_name_array = [];
                $get_status                = Status::all();
                foreach ($get_status as $s => $get_statu) {
                    $col_status_array[$get_statu->id] = 0;
                    $colum_status_map[$get_statu->id] = $get_statu->status;
                }
                foreach ($form_builders as $key => $form_builder) {
                    $col_array[$form_builder->id] = $col_status_array;
                    $col_map[$form_builder->id]   = $form_builder->label;
                }
                $book_list_contents = BookList::whereLanguage($request->language)->get('content');
                foreach ($book_list_contents as $key => $book_list_content) {

                    foreach ($book_list_content->content as $s => $single_content) {

                        if ($single_content['type'] == "1") {
                            $col_array[$s][$single_content['text']] += 1;
                        }
                    }
                    foreach ($col_array as $c => $col) {
                        foreach ($col as $k => $co) {
                            $col_status_map_name_array[$colum_status_map[$k]] = $col[$k];
                        }
                        $col_final_array[$col_map[$c]] = $col_status_map_name_array;
                    }
                }
                $table = "<table class='table table-striped table-bordered mt-2'><thead><tr><th>#</th>";foreach ($colum_status_map as $m => $colum_status_ma) {$table .= "<th>" . $colum_status_ma . "</th>";}
                $table .= "</tr></thead>
                    <tbody>
                    ";
                foreach ($col_final_array as $f => $final) {$table .= "
                        <tr>
                            <th>$f</th>
                            ";
                    foreach ($colum_status_map as $key => $value) {
                        if (array_key_exists($value, $final)) {
                            $table .= "<td>$final[$value]</td>";
                        } else {
                            $table .= "<td>-</td>";
                        }
                    }
                    $table .= "</tr>
                    ";}
                $table .= "</tbody>
                </table>";
                return response()->json(['table' => $table]);
            }

            if ($request->table_load) {

                $unique_lan    = BookList::distinct('language')->get('language');
                $content_rows  = BookList::select('language', 'content')->get();
                $status_list   = Status::all();
                $column        = FormBuilder::whereType(1)->get();
                $status_count  = [];
                $status_map    = [];
                $column_count  = [];
                $column_map    = [];
                $lanwise_count = [];
                foreach ($status_list as $val) {
                    $status_count[$val->id] = 0;
                    $status_map[$val->id]   = $val->status;
                }
                foreach ($unique_lan as $lan) {
                    foreach ($column as $val) {
                        $column_count[$val->id] = $status_count;
                        $column_map[$val->id]   = $val->label;
                    }
                    $lanwise_count[$lan->language] = $column_count;
                }
                foreach ($content_rows as $cr) {
                    foreach ($cr->content as $key => $value) {
                        if ($value['type'] == 1) {
                            $lanwise_count[$cr->language][$key][$value['text']] += 1;
                        }
                    }
                }
                // return $lanwise_count;
                $table = "<table class='table table-striped table-bordered mt-2'><thead><tr><th>#</th>";
                foreach ($column as $col) {
                    $table .= "<th>" . $col->label . "</th>";
                }
                $table .= "</tr></thead><tbody>";
                foreach ($lanwise_count as $lan => $col) {
                    $table .= "<tr><td>" . $lan . "</td>";
                    foreach ($col as $sts) {
                        $table .= "<td>";
                        foreach ($sts as $k => $val) {
                            if($status_map[$k] == 'Done')
                            {
                                $table .= $val . "<br/>";    
                            }
                        }
                        $table .= "</td>";
                    }
                    $table .= "</tr>";
                }
                $table .= "</tbody></table>";
                return response()->json(['table' => $table]);
            }

        }

        $coughnut_charts         = $this->getDoughnut();
        $series_wise_title_count = BookList::whereCategoryId(1)->distinct('title')->count();

        $languages = Language::all();
        $series    = Category::all();

        return view('admin.dashboard', compact('page_title', 'total_titles', 'unique_title', 'total_series', 'total_books', 'languages', 'total_series', 'coughnut_charts'));

    }

    public function getDoughnut()
    {
        $unique_lan    = BookList::distinct('language')->get('language');
        $content_rows  = BookList::select('language', 'content')->get();
        $status_list   = Status::all();
        $column        = FormBuilder::whereType(1)->get();
        $status_count  = [];
        $status_map    = [];
        $column_count  = [];
        $column_map    = [];
        $lanwise_count = [];
        $final_column  = [];
        $final_status  = [];

        foreach ($status_list as $val) {

            $status_count[$val->id] = 0;
            $status_map[$val->id]   = $val->status;
        }
        foreach ($unique_lan as $lan) {
            foreach ($column as $val) {
                $column_count[$val->id] = $status_count;
                $column_map[$val->id]   = $val->label;
            }
            $lanwise_count[$lan->language] = $column_count;
        }

        foreach ($content_rows as $cr) {
            foreach ($cr->content as $key => $value) {
                if ($value['type'] == 1) {
                    $column_count[$key][$value['text']] += 1;
                }
            }
            $lanwise_count[$cr->language] = $column_count;
        }

        foreach ($column_count as $col => $count_column) {
            foreach ($count_column as $co => $count_col) {
                $final_status[$status_map[$co]] = $count_col;
            }
            $final_column[$column_map[$col]] = $final_status;

        }

        $table = "<table class='table table-striped table-bordered mt-2'><thead><tr><th>#</th>";
        foreach ($column as $col) {
            $table .= "<th>" . $col->label . "</th>";
        }
        $table .= "</tr></thead><tbody>";
        foreach ($lanwise_count as $lan => $col) {
            $table .= "<tr><td>" . $lan . "</td>";
            foreach ($col as $sts) {
                $table .= "<td>";
                foreach ($sts as $k => $val) {
                    $table .= $status_map[$k] . " " . $val . "<br/>";
                }
                $table .= "</td>";
            }
            $table .= "</tr>";
        }
        $table .= "</tbody></table>";

        return $final_column;
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
