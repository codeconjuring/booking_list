<?php

namespace App\DataTables\ProductionDepartment;

use App\Models\ProductionDepartment;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use PDF;
use Yajra\DataTables\Services\DataTable;

class ProductionDepartmentDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($productionDept) {
                $authUser = Auth::user();
                $buttons  = '';
                if ($authUser->can('Edit Book Attributes Series')) {
                    $buttons .= '<li><a class="dropdown-item" href="' . route('admin.production-department.edit',
                        $productionDept->id) . '" title="Edit Category">
                        <i class="fas fa-edit"></i>&nbsp;Edit
                    </a></li>';
                }
                if ($authUser->can('Delete Book Attributes Series')) {
                    $buttons .= '<form action="' . route('admin.production-department.destroy', $productionDept->id) . '"  id="deleteForm' . $productionDept->id . '" method="post" style="display: none">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="_method" value="DELETE">
                </form>
                <li><a href="javascript:void(0)" class="dropdown-item text-danger" onclick="makeDeleteRequest(event, ' . $productionDept->id . ')" title="Delete Role"><i class="fas fa-trash-alt text-danger"></i>&nbsp;Delete</a></li>';
                }
                return '<div class="dropdown">
                <a class="btn cc-table-action p-0 dropdown-toggle" href="#"
                    id="dropdownMenuButton" data-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        ' . $buttons . '
                        </ul>
                        </div>';
            })->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ProductionDepartment/ProductionDepartmentDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProductionDepartment $model)
    {
        return $model->newQuery()->with(['production_house'])->withCount(['production_title'])->orderBy('production_year', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $data = $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '100px', 'printable' => false, 'title' => 'Action'])
            ->parameters($this->getBuilderParameters());
        if (!(Auth::user()->can('Edit Book Attributes Series') || Auth::user()->can('Delete Book Attributes Series'))) {
            $data = $this->builder()
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->parameters([
                    'dom'     => 'Bfrtip',
                    'order'   => [[0, 'desc']],
                    'buttons' => [
                        'create',
                        'export',
                        'print',
                        'reset',
                        'reload',
                    ],
                ]);
        }
        return $data;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'defaultContent' => '',
                'data'           => 'DT_RowIndex',
                'name'           => 'DT_RowIndex',
                'title'          => 'SL#',
                'render'         => null,
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => true,
                'footer'         => '',
                'width'          => '100px',
            ],
            [
                'title'     => 'House',
                'name'      => 'house',
                'data'      => 'production_house.house',
                'className' => 'text-left',
            ],
            [
                'title'     => 'Year',
                'name'      => 'production_year',
                'data'      => 'production_year',
                'className' => 'text-left',
            ],
            [
                'title'     => 'Month',
                'name'      => 'production_month',
                'data'      => 'production_month',
                'className' => 'text-left',
            ],
            [
                'title'     => 'Type',
                'name'      => 'stat_type',
                'data'      => 'stat_type',
                'className' => 'text-left',
            ],
            [
                'title'     => 'Cost',
                'name'      => 'total_cost',
                'data'      => 'total_cost',
                'className' => 'text-left',
            ],
            [
                'title'     => 'No. Titles',
                'name'      => 'total_titles',
                'data'      => 'production_title_count',
                'className' => 'text-left',
            ],
            [
                'title'     => 'No. Copies',
                'name'      => 'total_titles',
                'data'      => 'total_production_titles',
                'className' => 'text-left',
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ProductionDepartment_' . date('YmdHis');
    }

    /**
     * @return mixed
     */
    public function pdf()
    {
        $excel = app('excel');
        $data  = $this->getDataForExport();

        $pdf = PDF::loadView('vendor.datatables.print', [
            'data' => $data,
        ]);
        return $pdf->download($this->getFilename() . '.pdf');
    }
}
