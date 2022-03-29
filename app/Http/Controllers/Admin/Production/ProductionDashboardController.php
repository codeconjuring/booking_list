<?php

namespace App\Http\Controllers\Admin\Production;

use App\Http\Controllers\Controller;
use App\Models\ProductionDepartment;
use App\Models\ProductionHouse;
use App\Models\ProductionTitle;
use Illuminate\Http\Request;

class ProductionDashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Show Analytics'])->only(['index']);

    }
    //
    public function index()
    {
        $page_title = "Analytics";

        $books  = ProductionDepartment::where('stat_type', 1)->get();
        $tracts = ProductionDepartment::where('stat_type', 2)->get();

        //Yearly calculations of book titles/copies starts
        $book_copies_per_id = [];
        foreach ($books as $book) {
            $book_copies_per_id[$book->id] = $book->total_production_titles;
        }
        $yearly_book_titles_arr = [];
        $yearly_book_copies_arr = [];

        $prod_year = [];

        foreach ($books as $book) {
            array_push($prod_year, $book->production_year);
        }
        foreach ($tracts as $tract) {
            array_push($prod_year, $tract->production_year);
        }

        $prod_year = array_unique($prod_year);
        rsort($prod_year);

        foreach ($prod_year as $y) {
            $yearly_book_titles_arr[$y] = 0;
            $yearly_book_copies_arr[$y] = 0;

            $book_ids_for_year = ProductionDepartment::withCount(['production_title'])->where([['production_year', $y], ['stat_type', 1]])->get();

            if ($book_ids_for_year->isNotEmpty()) {
                foreach ($book_ids_for_year as $book) {
                    $yearly_book_titles_arr[$y] = $yearly_book_titles_arr[$y] + $book->production_title_count;
                }
            }

            if ($book_ids_for_year->isNotEmpty()) {
                foreach ($book_ids_for_year as $book) {
                    $yearly_book_copies_arr[$y] = $yearly_book_copies_arr[$y] + $book->total_production_titles;
                }
            }
        }
        //Yearly calculations of book titles/copies ends

        $total_book_titles = array_sum($yearly_book_titles_arr);
        $total_book_copies = array_sum($yearly_book_copies_arr);

        //Yearly calculations of tract titles/copies starts
        $tract_copies_per_id = [];
        foreach ($tracts as $tract) {
            $tract_copies_per_id[$tract->id] = $tract->total_production_titles;
        }

        $yearly_tract_titles_arr = [];
        $yearly_tract_copies_arr = [];

        foreach ($prod_year as $y) {
            $yearly_tract_titles_arr[$y] = 0;
            $yearly_tract_copies_arr[$y] = 0;

            $tract_ids_for_year = ProductionDepartment::withCount(['production_title'])->where([['production_year', $y], ['stat_type', 2]])->get();

            if ($tract_ids_for_year->isNotEmpty()) {
                foreach ($tract_ids_for_year as $tract) {
                    $yearly_tract_titles_arr[$y] = $yearly_tract_titles_arr[$y] + $tract->production_title_count;
                }
            }

            if ($tract_ids_for_year->isNotEmpty()) {
                foreach ($tract_ids_for_year as $tract) {
                    $yearly_tract_copies_arr[$y] = $yearly_tract_copies_arr[$y] + $tract->total_production_titles;
                }
            }
        }

        //Yearly calculations of tract titles/copies ends
        $total_tract_titles = array_sum($yearly_tract_titles_arr);
        $total_tract_copies = array_sum($yearly_tract_copies_arr);

        //Production house count
        $total_production_houses = ProductionHouse::count();

        //Distinct language counts
        $book_id_arr = [];
        foreach ($books as $book) {
            array_push($book_id_arr, $book->id);
        }

        $languages_produced_books = ProductionTitle::whereIn('production_department_id', $book_id_arr)->distinct('lan')->count();

        $tract_id_arr = [];
        foreach ($tracts as $tract) {
            array_push($tract_id_arr, $tract->id);
        }

        $languages_produced_tracts = ProductionTitle::whereIn('production_department_id', $tract_id_arr)->distinct('lan')->count();

        //Per yearly productions count
        // $months = ['Jan'=>[0,0], 'Feb'=>[0,0], 'Mar'=>[0,0], 'Apr'=>[0,0], 'May'=>[0,0], 'Jun'=>[0,0], 'Jul'=>[0,0], 'Aug'=>[0,0], 'Sep'=>[0,0], 'Oct'=>[0,0], 'Nov'=>[0,0], 'Dec'=>[0,0]];
        // $year = date('Y');

        // foreach($months as $month => $production)
        // {
        //     $books_in_a_year = ProductionDepartment::where([['production_year',$year],['production_month',$month],['stat_type',1]])->get();
        //     if($books_in_a_year->isNotEmpty())
        //     {
        //         foreach($books_in_a_year as $book)
        //         {
        //             $months[$month][0] = $months[$month][0] + $book->total_production_titles;
        //         }
        //     }

        //     $tracts_in_a_year = ProductionDepartment::where([['production_year',$year],['production_month',$month],['stat_type',2]])->get();

        //     if($tracts_in_a_year->isNotEmpty())
        //     {
        //         foreach($tracts_in_a_year as $tract)
        //         {
        //             $months[$month][1] = $months[$month][1] + $tract->total_production_titles;
        //         }
        //     }
        // }

        $production_houses = ProductionHouse::all();

        $top10_production_by_title = ProductionTitle::select('title_id', \DB::raw('sum(quantity) as sum_quantity'))->groupBy('title_id')->orderBy('sum_quantity', 'DESC')->take(10)->get();
        $top10_production_by_lan   = ProductionTitle::select('lan', \DB::raw('sum(quantity) as lan_quantity'))->groupBy('lan')->orderBy('lan_quantity', 'DESC')->take(10)->get();

        $top10_production_by_series = \DB::table("production_titles")
            ->join("book_lists", "production_titles.title_id", "book_lists.id")->join("categories", 'book_lists.category_id', "categories.id")->select('categories.name', \DB::raw("sum(quantity) as series_quantity"))->groupBy('categories.id')->orderBy('series_quantity', 'DESC')->take(10)->get();

        return view('admin.production-dashboard.index', compact('page_title', 'total_book_titles', 'total_tract_titles', 'prod_year', 'yearly_book_titles_arr', 'yearly_book_copies_arr', 'yearly_tract_titles_arr', 'yearly_tract_copies_arr', 'total_book_copies', 'total_tract_copies', 'total_production_houses', 'languages_produced_books', 'languages_produced_tracts', 'production_houses', 'top10_production_by_title', 'top10_production_by_lan', 'top10_production_by_series'));
    }

    public function getDataOnAYear(Request $request)
    {
        $months = ['Jan' => [0, 0], 'Feb' => [0, 0], 'Mar' => [0, 0], 'Apr' => [0, 0], 'May' => [0, 0], 'Jun' => [0, 0], 'Jul' => [0, 0], 'Aug' => [0, 0], 'Sep' => [0, 0], 'Oct' => [0, 0], 'Nov' => [0, 0], 'Dec' => [0, 0]];

        $year = $request->production_year;

        foreach ($months as $month => $production) {
            $books_in_a_year = ProductionDepartment::where([['production_year', $year], ['production_month', $month], ['stat_type', 1]])->get();
            if ($books_in_a_year->isNotEmpty()) {
                foreach ($books_in_a_year as $book) {
                    $months[$month][0] = $months[$month][0] + $book->total_production_titles;
                }
            }

            $tracts_in_a_year = ProductionDepartment::where([['production_year', $year], ['production_month', $month], ['stat_type', 2]])->get();

            if ($tracts_in_a_year->isNotEmpty()) {
                foreach ($tracts_in_a_year as $tract) {
                    $months[$month][1] = $months[$month][1] + $tract->total_production_titles;
                }
            }
        }
        return response()->json(['months' => $months, 'year' => $year]);
    }

    public function productionByProductionHouse(Request $request)
    {
        $production_houses = ProductionHouse::pluck('house', 'id')->toArray();

        $prod_house_total_prod_arr       = [];
        $tracker_arr                     = [];
        $prod_house_total_prod_arr_final = [];

        foreach ($production_houses as $id => $house) {
            $prod_house_total_prod_arr[$id] = [0, 0, 0, 0, '']; //books(produced), books(titles), tracts(produced), tracts(titles)

            $books_query = ProductionDepartment::where([['production_house_id', $id], ['stat_type', 1]])->get();

            foreach ($books_query as $books) {
                $prod_house_total_prod_arr[$id][0] = $prod_house_total_prod_arr[$id][0] + $books->total_production_titles;
            }
            $prod_house_total_prod_arr[$id][1] = sizeof($books_query);

            $tracts_query = ProductionDepartment::where([['production_house_id', $id], ['stat_type', 2]])->get();

            foreach ($tracts_query as $tract) {
                $prod_house_total_prod_arr[$id][2] = $prod_house_total_prod_arr[$id][2] + $tract->total_production_titles;
            }
            $prod_house_total_prod_arr[$id][3] = sizeof($tracts_query);

            $prod_house_total_prod_arr[$id][4] = $house;

            $tracker[$id] = $prod_house_total_prod_arr[$id][0];
        }
        arsort($tracker);
        foreach ($tracker as $id => $prod) {
            $prod_house_total_prod_arr_final[$id] = $prod_house_total_prod_arr[$id];
        }
        $table = "<table id='production_table_id' cellpadding='2' class='cc-datatable dataTable table nowrap w-100'><thead><tr><th  class='text-center'>Production House</th><th class='text-center'>Books(Produced)</th><th class='text-center'>Books(Titles)</th><th class='text-center'>Tracts(Produced)</th><th class='text-center'>Tracts(Titles)</th></tr></thead><tbody>";

        foreach ($prod_house_total_prod_arr_final as $id => $data) {
            $table .= "<tr><td class='text-center'>" . $data[4] . "</td><td class='text-center'>" . $data[0] . "<td class='text-center'>" . $data[1] . "</td><td class='text-center'>" . $data[2] . "</td><td  class='text-center'>" . $data[3] . "</td></tr>";
        }
        $table .= "</tbody></table>";
        return response()->json(['table' => $table]);
    }
}
