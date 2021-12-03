<?php

namespace App\Http\Controllers\Admin\Form;

use App\Http\Controllers\Controller;
use App\Models\BookList;
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

        $books = BookList::orderBy('id', 'DESC')->get();
        return view('admin.form.index', compact('page_title', 'form_builder', 'books'));

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

        BookList::create([
            'category_id' => $request->series_id,
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
