<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $total_titles      = BookList::distinct('book_id')->count();
        $total_series      = Category::count();
        $total_books       = BookList::count();
        $language_count    = BookList::distinct('language')->count();
        $db_language_count = Language::count();
        $get_languages     = Language::all();

        $total_title_published = 0;
        $get_en_book_lists     = BookList::whereLanguage('EN')->get();

        foreach ($get_en_book_lists as $get_en_book_list) {

            foreach ($get_en_book_list->content as $key => $book_content) {

                if ($book_content['type'] == 1) {
                    $get_status = Status::findOrFail($book_content['text']);

                    if ($get_status && $get_status->status == "Done") {
                        $total_title_published += 1;
                        break;
                    }
                }
            }
        }

        $get_gfp_format_id_query = FormBuilder::where('label','GFP')->first();
        if($get_gfp_format_id_query){
            $get_gfp_format_id = $get_gfp_format_id_query->id;
        }
        $total_books_published = 0;
        $get_all_book_lists    = BookList::all();

        foreach ($get_all_book_lists as $get_all_book_list) {

            foreach ($get_all_book_list->content as $key => $book_content) {

                if ($book_content['type'] == 1 and $book_content['text'] != $get_gfp_format_id) {
                    $get_status = Status::findOrFail($book_content['text']);

                    if ($get_status && $get_status->status == "Done") {
                        $total_books_published += 1;
                        break;
                    }
                }
            }
        }

        if ($request->ajax()) {
            if ($request->service_id) {
                $series_wise_book_count = BookList::whereCategoryId($request->service_id)->distinct('book_id')->count();
                return response()->json(['series_count' => $series_wise_book_count]);
            }

            if ($request->language) {

                $book_language = BookList::whereLanguage($request->language)->count();
                return response()->json(['language_count' => $book_language]);
            }

            if ($request->language_table) {
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
                $book_list_contents = BookList::whereLanguage($request->language_table)->get('content');
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
                $table = "<table cellpadding='2' class='cc-datatable table nowrap w-100'><thead><tr class='text-center'><th class='text-center'>#</th>";foreach ($colum_status_map as $m => $colum_status_ma) {$table .= "<th class='text-center'>" . $colum_status_ma . "</th>";}
                $table .= "</tr></thead>
                    <tbody>
                    ";
                foreach ($col_final_array as $f => $final) {$table .= "
                        <tr class='text-center'>
                            <th>$f</th>
                            ";
                    foreach ($colum_status_map as $key => $value) {
                        if (array_key_exists($value, $final)) {
                            $table .= "<td class='text-center'>$final[$value]</td>";
                        } else {
                            $table .= "<td class='text-center'>-</td>";
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

                // $status_done_id = '';
                // foreach ($status_map as $status_id => $status_name) {

                //     if ($status_name == "Done" || $status_name == "done") {
                //         $status_done_id = $status_id;
                //         break;
                //     }

                // }

                // $ebook_id = '';
                // foreach ($column_map as $col_id => $col_name) {

                //     if (strtolower($col_name) == "ebook") {
                //         $ebook_id = $col_id;
                //         break;
                //     }
                // }

                // $temp_array = [];
                // foreach ($lanwise_count as $lan => $column_id) {

                //     $temp_array[$lan] = $column_id[$ebook_id][$status_done_id];

                //     // dd($column_id[$ebook_id][$status_done_id]);
                // }

                // arsort($temp_array);
                // foreach ($temp_array as $lan => $count) {

                //     $temp_array[$lan] = $lanwise_count[$lan];
                // }
                // $lanwise_count = $temp_array;

                $table = "<table id='dataTable' cellpadding='2' class='cc-datatable dataTable table nowrap w-100'><thead><tr><th class='text-center'>#</th>";
                foreach ($column as $col) {
                    $table .= "<th class='text-center'>" . $col->label . "</th>";
                }
                $table .= "</tr></thead><tbody>";
                foreach ($lanwise_count as $lan => $col) {
                    $table .= "<tr class='text-center'><td class='text-center'>" . $lan . "</td>";
                    foreach ($col as $sts) {
                        $table .= "<td class='text-center'>";
                        foreach ($sts as $k => $val) {
                            if ($status_map[$k] == 'Done') {
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

        $languages = BookList::distinct('language')->get(['language']);
        $series    = Category::all();

        $form_builder_name_with_counts = $this->StatusCount();

        // $totale_title_language_counts = BookList::select('language', DB::raw('count(*) as total'))->groupBy('language')->orderBy('total', 'DESC')->get();
        $language_array = [];

        $totale_title_language_counts = BookList::groupBy('language')->get('language');

        foreach ($totale_title_language_counts as $key => $totale_title_language_count) {
            $language_array[$totale_title_language_count->language] = 0;
        }

        foreach ($totale_title_language_counts as $key => $totale_title_language_count) {
            $count                              = 0;
            $getSingleLanguageBookFromBookLists = BookList::whereLanguage($totale_title_language_count->language)->get();
            if (count($getSingleLanguageBookFromBookLists) > 0) {
                foreach ($getSingleLanguageBookFromBookLists as $key => $getSingleLanguageBookFromBookList) {

                    foreach ($getSingleLanguageBookFromBookList->content as $c => $content) {
                        if ($content['type'] == 1) {
                            $getStatus = Status::findOrFail($content['text']);
                            if ($getStatus && $getStatus->status == "Done") {
                                $count += 1;
                                break;
                            }
                        }
                    }
                }
            }
            $language_array[$totale_title_language_count->language] = $count;
        }

        arsort($language_array);

        $totale_title_language_counts = array_slice($language_array, 0, 10);

        //percentage of titles with done status per series - starts
        $title_percentage_per_series  = [];
        $series_that_have_titles_list = BookList::select('category_id')->distinct('category_id')->get();
        $total_series_arr             = $series->pluck('name', 'id');

        $done_status_id               = Status::whereStatus('Done')->first(['id'])->id;

        foreach ($series_that_have_titles_list as $series) {
            $titles_under_series       = BookList::whereCategoryId($series->category_id)->get();
            $total_titles_under_series = sizeof($titles_under_series);
            $total_done_titles         = 0;
            foreach ($titles_under_series as $title) {
                $done_flag = 0;
                foreach ($title->content as $cont) {
                    if ($cont['type'] == 1 and $cont['text'] == $done_status_id) {
                        $done_flag = 1;
                        break;
                    }
                }
                if ($done_flag == 1) {
                    $total_done_titles += 1;
                }
            }
            $title_percentage_per_series[$total_series_arr[$series->category_id]] = ($total_done_titles / $total_titles_under_series) * 100;
        }

        $published_by_ztf = BookList::where([['available', 1],['language', 'en']])->get();
        $total_published_by_ztf = 0;

        foreach($published_by_ztf as $title)
        {
            foreach($title->content as $format)
            {
                if($format['text'] == $done_status_id)
                {
                    $total_published_by_ztf += 1;
                    break;
                }
            }
        }
        
        //percentage of titles with done status per series - ends
        return view('admin.dashboard', compact('page_title', 'number_of_unique_titles', 'total_series', 'total_books', 'languages', 'series', 'total_titles', 'total_books', 'coughnut_charts', 'language_count', 'db_language_count', 'get_languages', 'form_builder_name_with_counts', 'totale_title_language_counts', 'total_title_published', 'total_books_published', 'title_percentage_per_series', 'total_published_by_ztf'));

    }

    public function StatusCount()
    {
        try {
            // Status count
            $form_builder      = FormBuilder::get(['label'])->toArray();
            $form_builder_name = [];
            $done_status_id    = Status::whereStatus('Done')->first(['id']);

            foreach (FormBuilder::whereType(1)->get() as $key => $val) {
                $form_builder_name[$val->label] = 0;
            }

            // $book_list
            if ($done_status_id) {
                $book_lists = BookList::all();
                foreach ($book_lists as $b => $book) {
                    // dd($book->content);
                    foreach ($book->content as $c => $content) {

                        $form_builder_get = FormBuilder::whereId($c)->first(['label']);

                        if ($form_builder_get) {
                            if (($content['type'] == 1) && ($content['text'] == $done_status_id->id)) {
                                $form_builder_name[$form_builder_get->label] += 1;
                            }
                        }
                    }
                }
            }

            return $form_builder_name;

        } catch (\Exception $e) {
            sendFlash($e->getMessage(), 'error');
        }
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
