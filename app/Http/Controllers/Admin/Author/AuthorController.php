<?php

namespace App\Http\Controllers\Admin\Author;

use App\DataTables\Author\AuthorDataTable;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\BookList;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AuthorDataTable $dataTable)
    {
        $page_title = "Book Author list";
        return $dataTable->render('admin.author.index', ['page_title' => $page_title]);
        // return view('admin.category.index', compact('page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Create Author';
        return view('admin.author.create', compact('page_title'));
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
            'name' => 'required|unique:authors,name',
        ]);

        Author::create([
            'name' => $request->name,
        ]);
        sendFlash('Author Create Successfully');
        return redirect()->route('admin.author.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = "Edit Author";
        $author     = Author::findOrFail($id);
        return view('admin.author.edit', compact('page_title', 'author'));
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
            'name' => 'required|unique:authors,name,' . $id,
        ]);
        $author     = Author::whereId($id)->first();
        $book_lists = BookList::whereAuthor($author->name)->get();
        if ($book_lists) {
            foreach ($book_lists as $key => $book_list) {
                $book_list->author = $request->name;
                $book_list->save();
            }
        }
        Author::whereId($id)->update([
            'name' => $request->name,
        ]);

        sendFlash('Author Update Successfully');
        return redirect()->route('admin.author.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author     = Author::findOrFail($id);
        $book_lists = BookList::whereAuthor($author->name)->get();

        foreach ($book_lists as $key => $book_list) {
            $book_list->author = null;
            $book_list->save();
        }

        if ($author->delete()) {
            sendFlash('Author Delete Successfully');
            return redirect()->route('admin.author.index');
        } else {
            sendFlash('Something is problem', 'error');
            return redirect()->route('admin.author.index');
        }
    }
}
