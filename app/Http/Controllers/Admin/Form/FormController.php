<?php

namespace App\Http\Controllers\Admin\Form;

use App\Http\Controllers\Controller;
use App\Mail\StatusChangeNotification;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookList;
use App\Models\BookListCategory;
use App\Models\Cat;
use App\Models\Category;
use App\Models\FormBuilder;
use App\Models\Language;
use App\Models\Status;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Robiussani152\Settings\Facades\Settings;
use \Mpdf\Mpdf as PDF;

class FormController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Add Book Management'])->only(['create', 'store']);
        $this->middleware(['permission:Download Report Book Management'])->only(['downloadPdf']);
        $this->middleware(['permission:Edit Book Management'])->only(['edit', 'update']);
        $this->middleware(['permission:Show Book Management'])->only(['index']);
        $this->middleware(['permission:Delete Book Management'])->only(['destroy']);
        $this->middleware(['permission:Add Another Translation Book Management'])->only(['storeAnother', 'addMore']);
    }

    // public function searchText(Request $request)
    // {
    //     $my_array = ['mashud', "mashud name", 'mashud pramaning', 'The Christian Way'];
    //     return response()->json($my_array);
    // }

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        return view('admin.form.index', compact('page_title', 'form_builder', 'series', 'getSeriyes', 'status', 'status_array', 'row_show', 'languages', 'entry_id', 'paginate_range', 'top_scroll', 'tags', 'select_language', 'filter_data', 'select_series', 'select_status', 'get_all_series'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $page_title   = "Create New Book List";
        $categories   = Cat::orderBy('name')->get();
        $series       = Category::orderBy('name')->get();
        $languages    = BookList::distinct('language')->get('language');
        $authors      = Author::orderBy('name')->get();
        $form_builder = FormBuilder::all();
        $statues      = Status::all();
        return view('admin.form.create', compact('page_title', 'series', 'languages', 'form_builder', 'statues', 'categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'series_id' => 'required',
            'language'  => 'required',
            'available' => 'required',
            'author'    => 'required',
        ]);

        $book = Book::create([
            'category_id' => $request->series_id,
        ]);

        $bookList = BookList::create([
            'category_id' => $request->series_id,
            'book_id'     => $book->id,
            'title'       => $request->title,
            'language'    => $request->language,
            'content'     => $request->content,
            'author'      => $request->author,
            'available'   => $request->available,
        ]);

        foreach ($request->categorys as $key => $category) {
            BookListCategory::create([
                'book_list_id' => $bookList->id,
                'cat_id'       => $category,
            ]);
        }

        sendFlash("Book list Create Successfully");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $book_list          = BookList::findOrFail($id);
        $authors            = Author::orderBy('name')->get();
        $categories         = Cat::orderBy('name')->get();
        $series             = Category::orderBy('name')->get();
        $page_title         = "Edit Book";
        $languages          = Language::all();
        $form_builder       = FormBuilder::all();
        $statues            = Status::all();
        $selected_categorys = [];

        foreach ($book_list->categories as $key => $cat) {
            array_push($selected_categorys, $cat->cat_id);
        }
        return view('admin.form.edit', compact('book_list', 'series', 'page_title', 'languages', 'form_builder', 'statues', 'categories', 'selected_categorys', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'series_id' => 'required',
            'language'  => 'required',
            'available' => 'required',
            'author'    => 'required',
        ]);

        DB::beginTransaction();

        try {
            $find_book_list = BookList::findOrFail($id);
            $db_content     = [];
            $request_cotent = [];
            $email_flag     = 0;
            $db_old_info    = '';
            foreach ($find_book_list->content as $key => $content) {
                $db_content[(string) $key] = $content['text'];
            }
            foreach ($request->content as $key => $req_content) {
                $request_cotent[(string) $key] = $req_content['text'];
            }

            foreach ($db_content as $key => $db_cont) {
                if (array_key_exists($key, $request_cotent)) {
                    if ($request_cotent[$key] != $db_cont) {
                        $email_flag  = 1;
                        $db_old_info = $find_book_list;
                    }
                }
            }
            $change_value = [];
            foreach ($db_content as $key => $d_contetn) {
                if ($request_cotent[$key] != $d_contetn) {
                    $change_value[$key] = $d_contetn;
                }
            }

            $bookList = BookList::whereId($id)->update([
                'category_id' => $request->series_id,
                'book_id'     => $find_book_list->book_id,
                'title'       => $request->title,
                'language'    => $request->language,
                'content'     => $request->content,
                'author'      => $request->author,
                'available'   => $request->available,
            ]);

            BookListCategory::whereBookListId($id)->delete();

            foreach ($request->categorys as $key => $category) {
                BookListCategory::create([
                    'book_list_id' => $id,
                    'cat_id'       => $category,
                ]);
            }

            DB::commit();
            if ($email_flag == 1) {
                Mail::to(Settings::get('email_notification'))->send(new StatusChangeNotification($id, $change_value));
            }

            sendFlash("Book list Update Successfully");

        } catch (\Exception $e) {
            DB::rollback();
            sendFlash($e->getMessage(), 'error');
        }

        return redirect()->route('admin.form.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $book_list = BookList::findOrFail($id);

        $book_list_count = BookList::whereBookId($book_list->book_id)->count();
        if ($book_list_count == 1) {
            Book::findOrFail($book_list->book_id)->delete();
        }

        // change the status
        if ($book_list->add_another_book_translation == 0) {
            $get_book_list = BookList::whereBookId($book_list->book_id)->where('id', '!=', $id)->orderBy('id', 'desc')->first();
            if ($get_book_list) {
                $get_book_list->update([
                    'add_another_book_translation' => 0,
                ]);
            }

        }

        $book_list->delete();
        sendFlash("Book Delete Successfully");
        return back();
    }

    public function addAnotherTitle($id)
    {

        $book_list = BookList::findOrFail($id);

        $get_language_book_lists = BookList::whereBookId($book_list->book_id)->get(['language'])->toArray();

        $remove_language = [];
        foreach ($get_language_book_lists as $key => $get_language_book_list) {
            array_push($remove_language, $get_language_book_list['language']);
        }

        $book          = Book::findOrFail($book_list->book_id);
        $series        = Category::findOrFail($book_list->category_id);
        $page_title    = "Add Another Translation";
        $new_languages = [];

        $languages = Language::all();

        foreach ($languages as $key => $language) {

            if (!in_array(strtoupper($language->short_hand), $remove_language)) {

                array_push($new_languages, strtoupper($language->short_hand));

            }

        }
        $form_builder = FormBuilder::all();
        $statues      = Status::all();
        $authors      = BookList::where('author', '!=', null)->distinct('author')->get('author');
        $categories   = Cat::orderBy('name')->get();

        $selected_categorys = [];

        foreach ($book_list->categories as $key => $cat) {
            array_push($selected_categorys, $cat->cat_id);
        }

        return view('admin.form.create_another', compact('series', 'page_title', 'new_languages', 'form_builder', 'statues', 'book', 'authors', 'categories', 'book_list', 'selected_categorys'));
    }

    public function storeAnotherTitle(Request $request)
    {

        $request->validate([
            'book_id'   => 'required',
            'series_id' => 'required',
            'title'     => 'required',
            'language'  => 'required',
        ]);

        $book_list = BookList::create([
            'category_id'                  => $request->series_id,
            'book_id'                      => $request->book_id,
            'title'                        => $request->title,
            'language'                     => $request->language,
            'content'                      => $request->content,
            'author'                       => $request->author,
            'add_another_book_translation' => 1,
            // 'available'                    => $request->available,
        ]);

        // foreach ($request->categorys as $key => $category) {
        //     BookListCategory::create([
        //         'book_list_id' => $book_list->id,
        //         'cat_id'       => $category,
        //     ]);
        // }

        sendFlash("Another Book titile Add Successfully");
        return redirect()->route('admin.form.index');

    }

    public function selectLanguageSeries(Request $request)
    {

        $titles = BookList::whereLanguage($request->language)->whereCategoryId($request->series)->select('title')->groupBy('title')->get();
        return response()->json(['titles' => $titles]);
    }

    public function downloadPdf(Request $request)
    {

        $page_title = "Book lists";
        $today_date = Carbon::parse(date('Y-m-d'))->format('d F Y');

        $select_series    = isset($request->series) ? $request->series : [];
        $select_tags      = isset($request->tag_ids) ? $request->tag_ids : [];
        $select_status    = isset($request->status_ids) ? $request->status_ids : [];
        $select_languages = isset($request->languages) ? $request->languages : [];

        $form_builder    = FormBuilder::orderBy('order_table', 'asc')->get();
        $series_group_by = BookList::select('category_id')->groupBy('category_id')->orderBy('id', 'DESC')->get();
        $series_count    = BookList::select('category_id', DB::raw('count(*) as total'))->groupBy('category_id')->orderBy('id', 'DESC')->get();
        $show_book_list  = $request->show_book_list ?? 0;
        $pdf_font_size   = Settings::get('report_font_size') != null ? Settings::get('report_font_size') : 16;

        $get_form_builder_ids = [];
        foreach ($form_builder as $key => $formbuilder) {
            array_push($get_form_builder_ids, (string) $formbuilder->id);
        }
        $selected_row = isset($request->select_row) ? $request->select_row : $get_form_builder_ids;

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

        if (count($select_series) > 0) {
            $getSeriyes = BookList::whereIn('category_id', $select_series)->select('category_id')->groupBy('category_id')->get();
        } else {
            $getSeriyes = BookList::select('category_id')->groupBy('category_id')->get();
        }

        $series_ids = [];
        foreach ($getSeriyes as $key => $series) {
            array_push($series_ids, $series->category_id);
        }
        if (count($series_ids) > 0) {
            $series = Category::whereIn('id', $series_ids)->get();
        } else {
            $series = Category::get();
        }

        $status_array = [];

        $status = Status::all();
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

        $filter_select_tag_name = 'Tags:';
        $count_slect_tag        = count($select_tags);
        if ($count_slect_tag > 0) {
            foreach ($select_tags as $key => $filter_select_tag) {
                $find_cat = Cat::findOrFail($filter_select_tag);

                if ($count_slect_tag == ($key + 1)) {
                    $filter_select_tag_name .= ' ' . $find_cat->name;
                } else {
                    $filter_select_tag_name .= ' ' . $find_cat->name . ', ';
                }

            }
        }
        ini_set("pcre.backtrack_limit", "10000000");
        $documentFileName = date("Ymd") . '_' . time() . ".pdf";
        // Create the mPDF document
        $document = new PDF(config('pdf'));

        // Set some header informations for output
        $header = [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"',
        ];
        $document->autoScriptToLang = true;
        $document->autoLangToFont   = true;
        $document->WriteHTML(view('admin.form.report', ['page_title' => $page_title, 'form_builder' => $form_builder, 'series' => $series, 'getSeriyes' => $getSeriyes, 'status' => $status, 'status_array' => $status_array, 'selected_row' => $selected_row, 'show_book_list' => $show_book_list, 'pdf_font_size' => $pdf_font_size, 'select_series' => $select_series, 'select_languages' => $select_languages, 'select_tags' => $select_tags, 'select_status' => $select_status, 'today_date' => $today_date, 'filter_select_tag_name' => $filter_select_tag_name]));
        // Save PDF on your public storage
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));
        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($documentFileName, 'Request', $header);

        // return view('admin.form.report', ['page_title' => $page_title, 'form_builder' => $form_builder, 'series' => $series, 'getSeriyes' => $getSeriyes, 'status' => $status, 'status_array' => $status_array, 'selected_row' => $selected_row, 'show_book_list' => $show_book_list, 'pdf_font_size' => $pdf_font_size, 'select_series' => $select_series, 'select_languages' => $select_languages, 'select_tags' => $select_tags, 'select_status' => $select_status]);
        // $pdf = PDF::loadView('admin.form.report', ['page_title' => $page_title, 'form_builder' => $form_builder, 'series' => $series, 'getSeriyes' => $getSeriyes, 'status' => $status, 'status_array' => $status_array, 'selected_row' => $selected_row, 'show_book_list' => $show_book_list, 'pdf_font_size' => $pdf_font_size, 'select_series' => $select_series, 'select_languages' => $select_languages, 'today_date' => $today_date, 'select_tags' => $select_tags, 'select_status' => $select_status]);

        // return $pdf->download(date("Ymd") . '_' . time() . '.pdf');
    }

    public function getAnotherLanguage(Request $request)
    {
        $remove_languages = BookList::whereCategoryId($request->series_id)->get(['language'])->toArray();
        $remove_lan       = [];
        foreach ($remove_languages as $key => $r_language) {
            array_push($remove_lan, $r_language['language']);
        }
        $languages       = Language::all();
        $update_language = [];
        foreach ($languages as $key => $u_language) {

            if (!in_array(strtoupper($u_language->short_hand), $remove_lan)) {

                array_push($update_language, strtoupper($u_language->short_hand));

            }
        }

        return response()->json(['languages' => $update_language]);
    }
}
