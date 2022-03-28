<?php

namespace App\Http\Controllers\Admin\Category;

use App\DataTables\Cat\CatDateTable;
use App\Http\Controllers\Controller;
use App\Models\Cat;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CatDateTable $dataTable)
    {
        $page_title = "Book Tags list";
        return $dataTable->render('admin.category.index', ['page_title' => $page_title]);
        // return view('admin.category.index', compact('page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Create Tag";
        return view('admin.category.create', compact('page_title'));
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
            'name' => 'required|unique:cats,name',
        ]);

        Cat::create([
            'name' => $request->name,
        ]);
        sendFlash("Tags Create Successfully");
        return redirect()->route('admin.category.index');
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
        $page_title = "Edit Tags";
        $category   = Cat::findOrFail($id);
        return view('admin.category.edit', compact('page_title', 'category'));
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
            'name' => 'required|unique:cats,name,' . $id,
        ]);

        Cat::whereId($id)->update([
            'name' => $request->name,
        ]);
        sendFlash("Tags Update Successfully");
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Cat::whereId($id)->firstOrFail();
        $book_list_cat = BookListCategory::where('cat_id',$id)->firstOrFail();
        if ($category->delete() and $book_list_cat->delete()) {
            sendFlash("Tags Delete Successfully");
            return redirect()->route('admin.category.index');
        } else {
            sendFlash("Somethig is problem", "error");
            return redirect()->route('admin.category.index');
        }
    }
}