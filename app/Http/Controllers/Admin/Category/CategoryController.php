<?php

namespace App\Http\Controllers\Admin\Category;

use App\DataTables\Category\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Add Series'])->only(['create']);
        $this->middleware(['permission:Edit Series'])->only(['edit', 'update']);
        $this->middleware(['permission:Show Series'])->only(['index']);
        $this->middleware(['permission:Delete Series'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $dataTable)
    {
        $page_title = "Series List";
        return $dataTable->render('admin.series.index', ['page_title' => $page_title]);
        // return view('admin.category.index', compact('page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Create Series";
        return view('admin.series.create', compact('page_title'));
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
            'name' => 'required|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
        ]);
        sendFlash("Serices Create Successfully");
        return redirect()->route('admin.series.index');
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
        $page_title = "Edit Series";
        $series     = Category::whereId($id)->firstOrFail();
        return view('admin.series.edit', compact('page_title', 'series'));
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
            'name' => 'required|unique:categories,name,' . $id,
        ]);
        $series = Category::whereId($id)->firstOrFail();

        $series->update([
            'name' => $request->name,
        ]);
        sendFlash("Serices Update Successfully");
        return redirect()->route('admin.series.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serise = Category::whereId($id)->first();
        $serise->delete();
        sendFlash("Serice Delete Successfully");
        return back();
    }
}
