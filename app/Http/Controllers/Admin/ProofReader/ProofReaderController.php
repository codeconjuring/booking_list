<?php

namespace App\Http\Controllers\Admin\ProofReader;

use App\DataTables\ProofReader\ProofReaderDatatable;
use App\Http\Controllers\Controller;
use App\Models\ProofReader;
use App\Models\BookInfo;
use Illuminate\Http\Request;

class ProofReaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProofReaderDataTable $dataTable)
    {
        $page_title = "Proofreader list";
        return $dataTable->render('admin.proof-reader.index', ['page_title' => $page_title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page_title = 'Create Proofreader';
        return view('admin.proof-reader.create', compact('page_title'));
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
            'name' => 'required|unique:proof_readers,name',
        ]);

        ProofReader::create([
            'name' => $request->name,
        ]);
        sendFlash('Proofreader Create Successfully');
        return redirect()->route('admin.proof-reader.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProofReader  $proofReader
     * @return \Illuminate\Http\Response
     */
    public function show(ProofReader $proofReader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProofReader  $proofReader
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $page_title = "Edit Proofreader";
        $proofReader     = ProofReader::findOrFail($id);
        return view('admin.proof-reader.edit', compact('page_title', 'proofReader'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProofReader  $proofReader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|unique:proof_readers,name,' . $id,
        ]);
        ProofReader::whereId($id)->update([
            'name' => $request->name,
        ]);

        sendFlash('Proofreader Update Successfully');
        return redirect()->route('admin.proof-reader.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProofReader  $proofReader
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $proofReader = ProofReader::findOrFail($id);
        $book_lists  = BookInfo::where('proofreader_id', $id)->update(
            [
                'proofreader_id' => null
            ]);

        if ($proofReader->delete()) {
            sendFlash('Proofreader Delete Successfully');
            return redirect()->route('admin.proof-reader.index');
        } else {
            sendFlash('Something went wrong', 'error');
            return redirect()->route('admin.proof-reader.index');
        }
    }
}
