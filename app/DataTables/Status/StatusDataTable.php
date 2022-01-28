<?php

namespace App\DataTables\Status;

use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Services\DataTable;

class StatusDataTable extends DataTable
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
            ->editColumn('color', function ($status) {
                return '<div class="cc-circle-color" style="border: 1px solid ' . $status->color . '"><span style="background-color:' . $status->color . '"> </span></div>';
            })
            ->addColumn('action', function ($status) {
                $authUser = Auth::user();
                $buttons  = '';
                if ($authUser->can('Edit Book Attributes Status')) {
                    $buttons .= '<li><a class="dropdown-item" href="' . route('admin.status.edit',
                        $status->id) . '" title="Edit Category">
                        <i class="fas fa-edit"></i>&nbsp;Edit
                    </a></li>';
                }

                if ($authUser->can('Delete Book Attributes Status')) {
                    $buttons .= '<form action="' . route('admin.status.destroy', $status->id) . '"  id="deleteForm' . $status->id . '" method="post" style="display: none">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="_method" value="DELETE">
                </form>
                <li><a href="javascript:void(0)" class="dropdown-item text-danger" onclick="makeDeleteRequest(event, ' . $status->id . ')" title="Delete status"><i class="fas fa-trash-alt text-danger"></i>&nbsp;Delete</a></li>';
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
            })->rawColumns([
            'action',
            'color',
        ])->addIndexColumn();

    }

    /**
     * Get query source of dataTable.
     *
     * @param Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Status $model)
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
        if (!(Auth::user()->can('Edit Book Attributes Status') || Auth::user()->can('Delete Book Attributes Status'))) {
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
                'title' => 'Status',
                'name'  => 'status',
                'data'  => 'status',
            ],
            [
                'title' => 'Color',
                'name'  => 'color',
                'data'  => 'color',
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
        return 'roles-' . date('YmdHis');
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
