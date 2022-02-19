<?php

namespace App\Http\Controllers\Admin\FormBuilder;

use App\Http\Controllers\Controller;
use App\Models\BookList;
use App\Models\FormBuilder;
use App\Models\Status;
use Illuminate\Http\Request;

class FormBuilderController extends Controller
{

    public function __construct()
    {

        $this->middleware(['permission:Add Book Attributes Format'])->only(['create']);
        $this->middleware(['permission:Edit Book Attributes Format'])->only(['edit', 'update']);
        $this->middleware(['permission:Show Book Attributes Format'])->only(['index']);
        $this->middleware(['permission:Delete Book Attributes Format'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $page_title    = "Book Format Builder";
        $form_builders = FormBuilder::orderBy('order_table', 'asc')->get();
        return view('admin.form-builder.index', compact('page_title', 'form_builders'));
        // return $dataTable->render('admin.form-builder.index', ['page_title' => $page_title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $page_title = "Book Format Creator";
        $status     = Status::orderBy('status')->get();
        return view('admin.form-builder.create', compact('page_title', 'status'));
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
            'label'          => 'required|unique:form_builders,label|regex:(^([a-zA-z _-]+)(\d+)?$)',
            'default_status' => 'required',
            'type'           => 'required',
        ]);

        $status = Status::whereStatus($request->default_status)->whereStatus(strtolower($request->default_status))->first();
        if (!$status) {

            $status = Status::create([
                'status' => $request->default_status,
                'color'  => '#c2ffef',
            ]);
        }

        FormBuilder::create([
            'label'             => $request->label,
            'type'              => $request->type,
            'default_status_id' => $status->id,
        ]);

        sendFlash("Form Builder Create Successfully");
        return redirect()->route('admin.form-builder.index');
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
        $formBuilder = FormBuilder::findOrFail($id);
        $page_title  = "Book Format Edit";
        return view('admin.form-builder.edit', compact('page_title', 'formBuilder'));
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
            'label' => 'required|regex:(^([a-zA-z _-]+)(\d+)?$)|unique:form_builders,label,' . $id,
            'type'  => 'required',
        ]);

        FormBuilder::where(['id' => $id])->update([
            'label' => $request->label,
            'type'  => $request->type,
        ]);

        sendFlash("Form Builder Update Successfully");
        return redirect()->route('admin.form-builder.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $book_lists = BookList::all();
            foreach ($book_lists as $key => $book_list) {
                $contents = $book_list->content;
                foreach ($contents as $c => $content) {
                    if ($c == (int) $id) {
                        unset($contents[$c]);
                    }
                }
                $book_list->update([
                    'content' => $contents,
                ]);
            }
            FormBuilder::findOrFail($id)->delete();

            sendFlash("Delete Successfully");
            return back();
        } catch (\Exception $e) {
            sendFlash($e->getMessage(), 'error');
            return back();
        }

    }

    public function tableSort(Request $request)
    {

        $posts = FormBuilder::all();
        foreach ($posts as $post) {
            foreach ($request->order as $order) {
                if ($order['id'] == $post->id) {
                    $post->update(['order_table' => $order['position']]);
                }
            }
        }

        return response('Update Successfully.', 200);
    }
}
