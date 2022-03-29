<?php

namespace App\Http\Controllers\Admin\Narrator;

use App\DataTables\Narrator\NarratorDatatable;
use App\Http\Controllers\Controller;
use App\Models\Narrator;
use App\Models\Country;
use App\Models\Language;
use App\Models\BookInfo;
use Illuminate\Http\Request;

class NarratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NarratorDatatable $dataTable)
    {
        //
        $page_title = "Narrator list";
        return $dataTable->render('admin.narrator.index', ['page_title' => $page_title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Create Narrator';
        $countries  =  Country::all();
        $languages  =  Language::all();

        return view('admin.narrator.create', compact('page_title', 'countries', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:narrators,name',
        ]);

        Narrator::create([
            'name'         => $request->name,
            'countries_id' => $request->nationality,
            'languages_id' => $request->language
        ]);
        sendFlash('Narrator Created Successfully');
        return redirect()->route('admin.narrator.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Narrator  $narrator
     * @return \Illuminate\Http\Response
     */
    public function show(Narrator $narrator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Narrator  $narrator
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $page_title   = "Edit Narrator";
        $narrator     = Narrator::findOrFail($id);
        $countries    = Country::all();
        $languages    = Language::all();
        return view('admin.narrator.edit', compact('page_title', 'narrator', 'countries', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Narrator  $narrator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|unique:narrators,name,' . $id,
        ]);
        Narrator::whereId($id)->update([
            'name'         => $request->name,
            'countries_id' => $request->nationality,
            'languages_id' => $request->language
        ]);

        sendFlash('Narrator Updated Successfully');
        return redirect()->route('admin.narrator.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Narrator  $narrator
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $narrator    = Narrator::findOrFail($id);
        $book_lists  = BookInfo::where('narrator_id', $id)->update(
            [
                'narrator_id' => null
            ]);

        if ($narrator->delete()) {
            sendFlash('Narrator Delete Successfully');
            return redirect()->route('admin.narrator.index');
        } else {
            sendFlash('Something went wrong', 'error');
            return redirect()->route('admin.narrator.index');
        }
    }
}
