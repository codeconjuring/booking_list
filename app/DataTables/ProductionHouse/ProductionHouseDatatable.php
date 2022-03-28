<?php

namespace App\DataTables\ProductionHouse;

use App\Models\ProductionHouse;
use Illuminate\Support\Facades\Auth;
use PDF;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductionHouseDatatable extends DataTable
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
            ->addColumn('action', function ($productionHouse) {
                $authUser = Auth::user();
                $buttons  = '';
                if ($authUser->can('Edit CPH')) {
                    $buttons .= '<li><a class="dropdown-item" href="' . route('admin.production-house.edit',
                        $productionHouse->id) . '" title="Edit Category">
                        <i class="fas fa-edit"></i>&nbsp;Edit
                    </a></li>';
                }
                if ($authUser->can('Delete CPH')) {
                    $buttons .= '<form action="' . route('admin.production-house.destroy', $productionHouse->id) . '"  id="deleteForm' . $productionHouse->id . '" method="post" style="display: none">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="_method" value="DELETE">
                </form>
                <li><a href="javascript:void(0)" class="dropdown-item text-danger" onclick="makeDeleteRequest(event, ' . $productionHouse->id . ')" title="Delete Role"><i class="fas fa-trash-alt text-danger"></i>&nbsp;Delete</a></li>';
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
     * @param \App\Models\ProductionHouse/ProductionHouseDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProductionHouse $model)
    {
        return $model->newQuery()->orderBy('id', 'desc');
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
        if (!(Auth::user()->can('Delete CPH') || Auth::user()->can('Edit CPH'))) {
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
                'exportable'     => true,
                'printable'      => true,
                'footer'         => '',
                'width'          => '100px',
            ],
            [
                'title'     => 'House',
                'name'      => 'house',
                'data'      => 'house',
                'className' => 'text-left',
            ],
            [
                'title'     => 'Nation',
                'name'      => 'nation',
                'data'      => 'nation',
                'className' => 'text-left',
            ],
            [
                'title'     => 'State',
                'name'      => 'state',
                'data'      => 'state',
                'className' => 'text-left',
            ],
            [
                'title'     => 'City',
                'name'      => 'city',
                'data'      => 'city',
                'className' => 'text-left',
            ],
            [
                'title'     => 'Director',
                'name'      => 'director',
                'data'      => 'director',
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
        return 'ProductionHouse_' . date('YmdHis');
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
