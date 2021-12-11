<?php

namespace App\Http\Controllers\Admin\Status;

use App\DataTables\Status\StatusDataTable;
use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Add Book Attributes Status'])->only(['create']);
        $this->middleware(['permission:Edit Book Attributes Status'])->only(['edit', 'update']);
        $this->middleware(['permission:Show Book Attributes Status'])->only(['index']);
        $this->middleware(['permission:Delete Book Attributes Status'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StatusDataTable $dataTable)
    {
        $page_title = "Status List";
        return $dataTable->render('admin.status.index', ['page_title' => $page_title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Crate Status";
        return view('admin.status.create', compact('page_title'));
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
            'status' => 'required|unique:statuses,status',
            'color'  => 'required',
        ]);

        Status::create([
            'status' => $request->status,
            'color'  => $request->color,
        ]);

        sendFlash("Status Create Successfully");
        return redirect()->route('admin.status.index');
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
        $page_title = "Edit Status";
        $status     = Status::findOrFail($id);
        return view('admin.status.edit', compact('page_title', 'status'));
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
            'status' => 'required|unique:statuses,status,' . $id,
            'color'  => 'required',
        ]);

        $status = Status::findOrFail($id);
        $status->update([
            'status' => $request->status,
            'color'  => $request->color,
        ]);
        sendFlash("Status Update Successfully");
        return redirect()->route('admin.status.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        $status->delete();
        sendFlash("Status Delete Successfully");
        return back();
    }
}
