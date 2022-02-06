<?php

namespace App\DataTables\Role;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
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
            ->addColumn('action', function ($role) {
                $authUser = Auth::user();
                $buttons  = '';
                if ($authUser->can('Edit Administration')) {
                    $buttons .= '<li><a class="dropdown-item" href="' . route('admin.role.edit',
                        $role->id) . '" title="Edit Category">
                        <i class="fas fa-edit"></i>&nbsp;Edit
                    </a></li>';
                }
                if ($authUser->can('Delete Administration')) {
                    $buttons .= '<form action="' . route('admin.role.destroy', $role->id) . '"  id="deleteForm' . $role->id . '" method="post" style="display: none">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="_method" value="DELETE">
                </form>
                <li><a href="javascript:void(0)" class="dropdown-item text-danger" onclick="makeDeleteRequest(event, ' . $role->id . ')" title="Delete Role"><i class="fas fa-trash-alt text-danger"></i>&nbsp;Delete</a></li>';
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
     * @param Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
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
        if (!(Auth::user()->can('Edit Administration') || Auth::user()->can('Delete Administration'))) {
            $data = $this->builder()
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->parameters([
                    'dom'     => 'Bfrtip',
                    'order'   => [[0, 'desc']],
                    'buttons' => [
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
                'title' => 'Role',
                'name'  => 'name',
                'data'  => 'name',
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
