<?php

namespace App\Http\Controllers\Admin\Form;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookList;
use App\Models\BookListTitle;
use App\Models\Category;
use App\Models\FormBuilder;
use App\Models\Language;
use App\Models\Status;
use DB;
use Illuminate\Http\Request;
use PDF;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $page_title      = "Book lists";
        $form_builder    = FormBuilder::all();
        $series_group_by = BookList::select('category_id')->groupBy('category_id')->orderBy('id', 'DESC')->get();
        $series_count    = BookList::select('category_id', DB::raw('count(*) as total'))->groupBy('category_id')->orderBy('id', 'DESC')->get();

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

        $getSeriyes = BookList::select('category_id')->groupBy('category_id')->get();
        $series_ids = [];
        foreach ($getSeriyes as $key => $series) {
            array_push($series_ids, $series->category_id);
        }

        $series = Category::whereIn('id', $series_ids)->get();

        return view('admin.form.index', compact('page_title', 'form_builder', 'series', 'getSeriyes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $series       = Category::orderBy('name')->get();
        $page_title   = "Create New Book List";
        $languages    = Language::all();
        $form_builder = FormBuilder::all();
        $statues      = Status::all();
        return view('admin.form.create', compact('page_title', 'series', 'languages', 'form_builder', 'statues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'series_id' => 'required',
            'language'  => 'required',
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
        ]);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $book = BookList::findOrFail($id);
        $book->delete();
        sendFlash("Book Delete Successfully");
        return back();
    }

    public function addMore(Request $request)
    {

        $request->validate([
            'series_id' => 'required',
        ]);

        $page_title    = "Create Another Book List";
        $series        = Category::orderBy('name')->get();
        $languages     = Language::all();
        $form_builder  = FormBuilder::all();
        $statues       = Status::all();
        $select_series = Category::findOrFail($request->series_id);
        $book          = BookList::whereCategoryId($request->series_id)->whereParent(1)->first();
        return view('admin.form.create_another', compact('page_title', 'series', 'languages', 'form_builder', 'statues', 'select_series', 'book'));
    }

    public function storeAnother(Request $request, $book)
    {

        $request->validate([
            'series_id' => 'required',
            'language'  => 'required',
        ]);

        $bookList = BookList::create([
            'category_id' => $request->series_id,
            'title'       => $request->title,
            'language'    => $request->language,
            'content'     => $request->content,
        ]);

        BookListTitle::create([
            'book_list_id' => $bookList->id,
            'parent'       => 0,
            'parent_id'    => $book,
        ]);

        sendFlash("Book list Create Successfully");
        return back();
    }

    public function addAnotherTitle($book_list_id)
    {
        $book_list               = BookList::findOrFail($book_list_id);
        $get_language_book_lists = BookList::whereBookId($book_list_id)->get(['language'])->toArray();
        $remove_language         = [];
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
        return view('admin.form.create_another', compact('series', 'page_title', 'new_languages', 'form_builder', 'statues', 'book'));
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
            'category_id' => $request->series_id,
            'book_id'     => $request->book_id,
            'title'       => $request->title,
            'language'    => $request->language,
            'content'     => $request->content,
        ]);
        sendFlash("Another Book titile Add Successfully");
        return redirect()->route('admin.form.index');

    }

    public function selectLanguageSeries(Request $request)
    {
        return $request->all();
    }

    public function downloadPdf()
    {

        $page_title      = "Book lists";
        $form_builder    = FormBuilder::all();
        $series_group_by = BookList::select('category_id')->groupBy('category_id')->orderBy('id', 'DESC')->get();
        $series_count    = BookList::select('category_id', DB::raw('count(*) as total'))->groupBy('category_id')->orderBy('id', 'DESC')->get();

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

        $getSeriyes = BookList::select('category_id')->groupBy('category_id')->get();
        $series_ids = [];
        foreach ($getSeriyes as $key => $series) {
            array_push($series_ids, $series->category_id);
        }

        $series = Category::whereIn('id', $series_ids)->get();
        // return view('admin.form.report', ['page_title' => $page_title, 'form_builder' => $form_builder, 'series' => $series, 'getSeriyes' => $getSeriyes]);
        $pdf = PDF::loadView('admin.form.report', ['page_title' => $page_title, 'form_builder' => $form_builder, 'series' => $series, 'getSeriyes' => $getSeriyes])->setPaper('a4', 'landscape');
        // $pdf->save(storage_path() . '_report.pdf');
        return $pdf->download('book_' . date("Y/m/d") . 'report.pdf');
    }
}
