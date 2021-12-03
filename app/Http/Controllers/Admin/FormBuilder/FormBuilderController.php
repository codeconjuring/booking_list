<?php

namespace App\Http\Controllers\Admin\FormBuilder;

use App\DataTables\FormBuilter\FormBuilderDataTable;
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
    public function index(FormBuilderDataTable $dataTable)
    {
        $page_title = "Form Builder";
        return $dataTable->render('admin.form-builder.index', ['page_title' => $page_title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Form Builder Create";
        return view('admin.form-builder.create', compact('page_title'));
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
            'label' => 'required|unique:form_builders,label',
            'type'  => 'required',
        ]);

        FormBuilder::create([
            'label' => $request->label,
            'type'  => $request->type,
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
        $page_title  = "Form Builder Edit";
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
            'label' => 'required|unique:form_builders,label,' . $id,
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
        FormBuilder::findOrFail($id)->delete();
        sendFlash("Delete Successfully");
        return back();
    }
}
