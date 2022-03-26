<?php

namespace App\Http\Controllers\Admin\Production;

use App\DataTables\ProductionHouse\ProductionHouseDatatable;
use App\Http\Controllers\Controller;
use App\Models\ProductionHouse;
use App\Models\BookInfo;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductionHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductionHouseDatatable $dataTable)
    {
        //
        $page_title = "Production House List";
        return $dataTable->render('admin.production-house.index', ['page_title' => $page_title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page_title = 'Create Production House';
        return view('admin.production-house.create', compact('page_title'));
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
            'house'    =>  ['required', Rule::unique('production_houses', 'house')->where(function($query) use ($request){
                    return $query->where([
                        ['nation','=', $request->country],
                        ['state','=', $request->state],
                        ['city','=', $request->city]
                    ]);
                })],
            'director' => 'required',
            'country'  => 'required',
            'state'    => 'required',
            'city'     => 'required'
        ]);

        ProductionHouse::create([
            'house'     => $request->house,
            'director'  => $request->director,
            'nation'    => $request->country,
            'state'     => $request->state,
            'city'      => $request->city,
        ]);
        sendFlash('Production House Created Successfully');
        return redirect()->route('admin.production-house.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductionHouse  $productionHouse
     * @return \Illuminate\Http\Response
     */
    public function show(ProductionHouse $productionHouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductionHouse  $productionHouse
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $page_title = "Edit Production House";
        $productionHouse = ProductionHouse::findOrFail($id);
        return view('admin.production-house.edit', compact('page_title', 'productionHouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductionHouse  $productionHouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try{
        $request->validate([
            'house'    =>  ['required', Rule::unique('production_houses', 'house')->where(function($query) use ($request){
                    return $query->where([
                        ['nation','=', $request->country],
                        ['state','=', $request->state],
                        ['city','=', $request->city]
                    ]);
                })->ignore($id, 'id')],
            'director' => 'required',
            'country'  => 'required',
            'state'    => 'required',
            'city'     => 'required'
        ]);
          DB::beginTransaction();
            ProductionHouse::whereId($id)->update([
            'house'     => $request->house,
            'director'  => $request->director,
            'nation'    => $request->country,
            'state'     => $request->state,
            'city'      => $request->city,
          ]);
          DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollback();
            sendFlash('Something Went Wrong', 'error');
            return redirect()->route('admin.production-house.index');
        }
        sendFlash('Production House Updated Successfully');
        return redirect()->route('admin.production-house.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductionHouse  $productionHouse
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $productionHouse    = ProductionHouse::findOrFail($id);

        if ($productionHouse->delete()) {
            sendFlash('Production house deleted Successfully');
            return redirect()->route('admin.production-house.index');
        } else {
            sendFlash('Something went wrong', 'error');
            return redirect()->route('admin.production-house.index');
        }
    }
}
