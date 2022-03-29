<?php

namespace App\Http\Controllers\Admin\Production;

use App\DataTables\ProductionDepartment\ProductionDepartmentDatatable;
use App\Http\Controllers\Controller;
use App\Models\BookList;
use App\Models\Language;
use App\Models\ProductionDepartment;
use App\Models\ProductionHouse;
use App\Models\ProductionTitle;
use DB;
use Illuminate\Http\Request;

class ProductionDepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Edit Add Report'])->only(['edit']);
        $this->middleware(['permission:Add Add Report'])->only(['create']);
        $this->middleware(['permission:Delete Add Report'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductionDepartmentDatatable $dataTable)
    {
        //
        $page_title = "Production Department List";
        // dd(ProductionDepartment::with(['production_house'])->get());
        // dd(ProductionDepartment::whereId(3)->first()->total_production_titles);
        // dd(ProductionDepartment::STAT_TYPE);
        return $dataTable->render('admin.production-department.index', ['page_title' => $page_title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page_title = 'Add Production Report';
        $series     = BookList::with(['serise'])->groupBy('category_id')->get();

        $production_houses = ProductionHouse::all();

        return view('admin.production-department.create', compact('page_title', 'series', 'production_houses'));
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
            'house'     => 'required',
            'year'      => 'required',
            'stat_type' => 'required',
        ]);

        try {
            $prod_dept = ProductionDepartment::create([
                'production_house_id' => $request->house,
                'production_year'     => $request->year,
                'production_month'    => $request->month,
                'stat_type'           => $request->stat_type,
                'total_cost'          => $request->production_cost,
            ]);

            try {
                for ($n = 0; $n < sizeof($request->titles); $n++) {
                    $total_copies = 0;

                    if ($request->totals[$n] != null) {
                        $total_copies = $request->totals[$n];
                    }
                    ProductionTitle::create([
                        'production_department_id' => $prod_dept->id,
                        'title_id'                 => $request->titles[$n],
                        'lan'                      => $request->lans[$n],
                        'quantity'                 => $total_copies,
                    ]);
                }
            } catch (\Exception $e) {
                ProductionDepartment::destroy($prod_dept->id);
                dd($e->getMessage());
                sendFlash('Something went wrong', 'error');
                return redirect()->route('admin.production-department.index');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            sendFlash('Something went wrong', 'error');
            return redirect()->route('admin.production-department.index');
        }
        sendFlash('Production Department Created Successfully');
        return redirect()->route('admin.production-department.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductionDepartment  $productionDepartment
     * @return \Illuminate\Http\Response
     */
    public function show(ProductionDepartment $productionDepartment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductionDepartment  $productionDepartment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $page_title = "Edit Production Department";
        $department = ProductionDepartment::whereId($id)->withCount(['production_title'])->first();

        $series            = BookList::with(['serise'])->groupBy('category_id')->get();
        $production_houses = ProductionHouse::all();

        return view('admin.production-department.edit', compact('page_title', 'department', 'series', 'production_houses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductionDepartment  $productionDepartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'house'     => 'required',
            'year'      => 'required',
            'stat_type' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $prod_dept = ProductionDepartment::whereId($id)->update([
                'production_house_id' => $request->house,
                'production_year'     => $request->year,
                'production_month'    => $request->month,
                'stat_type'           => $request->stat_type,
                'total_cost'          => $request->production_cost,
            ]);

            try {
                $total_titles = 0;
                if (!empty($request->total_titles)) {
                    $total_titles = $request->total_titles;
                }
                ProductionTitle::where('production_department_id', $id)->delete();
                for ($n = 0; $n < $total_titles; $n++) {
                    $total_copies = 0;

                    if ($request->totals[$n] != null) {
                        $total_copies = $request->totals[$n];
                    }
                    ProductionTitle::create([
                        'production_department_id' => $id,
                        'title_id'                 => $request->titles[$n],
                        'lan'                      => $request->lans[$n],
                        'quantity'                 => $total_copies,
                    ]);
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                dd($e->getMessage());
                sendFlash('Something went wrong', 'error');
                return redirect()->route('admin.production-department.index');
            }
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            sendFlash('Something went wrong', 'error');
            return redirect()->route('admin.production-department.index');
        }
        sendFlash('Production Department Updated Successfully');
        return redirect()->route('admin.production-department.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductionDepartment  $productionDepartment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try
        {
            DB::beginTransaction();

            ProductionDepartment::whereId($id)->delete();
            ProductionTitle::where('production_department_id', $id)->delete();

            DB::commit();
            sendFlash('Production Department Deleted Successfully');
            return redirect()->route('admin.production-department.index');
        } catch (\Exception $e) {
            DB::rollback();
            sendFlash('Something went wrong', 'error');
            return redirect()->route('admin.production-department.index');
        }
    }

    /**
     * Get serieswise language and languagewise title list
     *
     */
    public function getSeriesWiseLanTitle(Request $request)
    {
        try{
        if ($request->lan_flag > 0) {
            $languages = BookList::select('language')->where('category_id', $request->series_id)->distinct()->get();

            if (sizeof($languages) > 0) {
                $titles = BookList::where([['category_id', $request->series_id], ['language', $languages[0]->language]])->get();
            }

            return response()->json(['languages' => $languages, 'titles' => $titles, 'input_field' => $request->input_field, 'lan_flag' => $request->lan_flag]);
            }

         else if ($request->title_flag > 0) {
            $titles = BookList::where([['category_id', $request->series_id], ['language', $request->lan]])->get();
            return response()->json(['titles' => $titles, 'input_field' => $request->input_field, 'lan_flag' => $request->lan_flag]);
          }
        }
        catch(\Exception $e)
        {
          return response()->json(['error' => $e->getLine()]);
        }
    }
}
