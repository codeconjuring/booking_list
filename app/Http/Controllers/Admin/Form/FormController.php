<?php

namespace App\Http\Controllers\Admin\Form;

use App\Http\Controllers\Controller;
use App\Models\BookList;
use App\Models\BookListTitle;
use App\Models\Category;
use App\Models\FormBuilder;
use App\Models\Language;
use App\Models\Status;
use DB;
use Illuminate\Http\Request;

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

        $books      = BookList::with('childs')->get();
        $getSeriyes = BookList::select('category_id')->groupBy('category_id')->get();
        $series_ids = [];
        foreach ($getSeriyes as $key => $series) {
            array_push($series_ids, $series->category_id);
        }

        $series = Category::whereIn('id', $series_ids)->get();

        return view('admin.form.index', compact('page_title', 'form_builder', 'books', 'series'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $page_title   = "Create New Book List";
        $series       = Category::orderBy('name')->get();
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

        $bookList = BookList::create([
            'category_id' => $request->series_id,
            'title'       => $request->title,
            'language'    => $request->language,
            'content'     => $request->content,
            'parent'      => 1,
        ]);

        BookListTitle::create([
            'book_list_id' => $bookList->id,
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
}
