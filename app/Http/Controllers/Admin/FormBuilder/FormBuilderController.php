<?php

namespace App\Http\Controllers\Admin\FormBuilder;

use App\Http\Controllers\Controller;
use App\Models\FormBuilder;
use Illuminate\Http\Request;

class FormBuilderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title  = "Form Builder";
        $form_builer = FormBuilder::whereType('form-builder')->firstOrFail();
        return view('admin.form-builder.index', compact('page_title', 'form_builer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // try {
        // $chage_array = [];
        // return $request->all();
        // foreach ($request->compare as $key => $compare) {
        //     if ($compare != null && $request->contents[$key] != $compare) {
        //         $chage_array[$compare] = $request->contents[$key];
        //     }
        // }
        // return $chage_array;
        $form_builer = FormBuilder::whereType('form-builder')->firstOrFail();

        $form_builer->update([
            'content' => $request->contents,
        ]);
        // $books = BookList::all();
        // foreach ($books as $book) {
        //     foreach ($book->content as $key => $content) {
        //         // return $book->content;
        //         $new_data = $book->content;
        //         if (array_key_exists($key, $chage_array)) {
        //             $value = $content;
        //             unset($new_data[$key]);
        //             $new_data[$chage_array[$key]] = $value;
        //         }
        //         $book->content = $new_data;
        //         $book->save();
        //         // return;
        //     }
        // }
        sendFlash("Form Builder Update Successfully");
        return back();
        // } catch (\Exception $e) {
        //     sendFlash($e->getMessage(), 'error');
        //     return back();
        // }

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
