<?php

namespace App\DataTables\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
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
            ->addColumn('action', function ($category) {
                $authUser = Auth::user();
                $buttons  = '';
                if ($authUser->can('Edit Series')) {
                    $buttons .= '<a class="dropdown-item text-success" href="' . route('admin.series.edit',
                        $category->id) . '" title="Edit Category">
                        <i class="fas fa-edit"></i>&nbsp;Edit
                    </a>';
                }
                if ($authUser->can('Delete Series')) {
                    $buttons .= '<form action="' . route('admin.series.destroy', $category->id) . '"  id="deleteForm' . $category->id . '" method="post" style="display: none">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="_method" value="DELETE">
                </form>
                <a href="javascript:void(0)" class="dropdown-item text-danger" onclick="makeDeleteRequest(event, ' . $category->id . ')" title="Delete Role"><i class="fas fa-trash"></i>&nbsp;Delete</a>';
                }
                return '<div class="dropdown">
                    <button class="btn btn-info btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        ' . $buttons . '
                    </div>
                    </div>';
            })->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
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
        if (!(Auth::user()->can('Edit Series') || Auth::user()->can('Delete Series'))) {
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
                'title' => 'Name',
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
