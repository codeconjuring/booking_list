<?php

namespace App\DataTables\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PDF;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Services\DataTable;

class UserTable extends DataTable
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
            ->editColumn('full_name', function ($user) {
                return $user->first_name . ' ' . $user->last_name;
            })
            ->editColumn('role', function ($user) {
                return '<span class="badge badge-pill badge-primary">' . $user->roles ? $user->roles[0]->name : '-' . '</span>';
            })
            ->editColumn('profile_image', function ($user) {
                return '<img src="' . Storage::url($user->profile_image) . '" alt="">';
            })
            ->addColumn('action', function ($user) {
                $authUser = Auth::user();
                $buttons  = '';
                if ($authUser->can('Edit User')) {
                    $buttons .= '<a class="dropdown-item text-success" href="' . route('admin.user.edit',
                        $user->id) . '" title="Edit Category">
                        <i class="fas fa-edit"></i>&nbsp;Edit
                    </a>';
                }

                if ($authUser->can('Delete User')) {
                    $buttons .= '<form action="' . route('admin.user.destroy', $user->id) . '"  id="deleteForm' . $user->id . '" method="post" style="display: none">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="_method" value="DELETE">
                </form>
                <a href="javascript:void(0)" class="dropdown-item text-danger" onclick="makeDeleteRequest(event, ' . $user->id . ')" title="Delete status"><i class="fas fa-trash"></i>&nbsp;Delete</a>';
                }
                return '<div class="dropdown">
                    <button class="btn btn-info btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        ' . $buttons . '
                    </div>
                    </div>';
            })->rawColumns([
            'action',
            'role',
            'full_name',
            'profile_image',
        ])->addIndexColumn();

    }

    /**
     * Get query source of dataTable.
     *
     * @param Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->where('id', '!=', auth::user()->id)->orderBy('id', 'desc');
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
        if (!(Auth::user()->can('Edit User') || Auth::user()->can('Delete User'))) {
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
                'title' => 'Full Name',
                'name'  => 'full_name',
                'data'  => 'full_name',
            ],
            [
                'title' => 'Email',
                'name'  => 'email',
                'data'  => 'email',
            ],
            [
                'title' => 'Profile',
                'name'  => 'profile_image',
                'data'  => 'profile_image',
            ],
            [
                'title' => 'Role',
                'name'  => 'role',
                'data'  => 'role',
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
