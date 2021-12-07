<?php

namespace App\Http\Controllers\Admin\Role;

use App\DataTables\Role\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Show Administration'])->only(['index']);
        $this->middleware(['permission:Add Administration'])->only(['create', 'store']);
        $this->middleware(['permission:Edit Administration'])->only(['edit', 'update']);
        $this->middleware(['permission:Edit Administration'])->only(['edit', 'update']);
        $this->middleware(['permission:Delete Administration'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleDataTable $dataTable)
    {
        $page_title = "Role List";
        return $dataTable->render('admin.role.index', ['page_title' => $page_title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title  = "Create New Role";
        $permissions = Permission::where('parent_id', '')->with('children')->get();
        return view('admin.role.create', compact('page_title', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_name'   => 'bail:required|min:3|max:190|unique:roles,name',
            'permissions' => 'required',
        ]);

        $role       = new Role();
        $role->name = $request->role_name;
        $role->save();

        $role->syncPermissions($request->permissions);
        sendFlash('Role Create Successfully');
        return redirect()->route('admin.role.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title      = "Edit Role";
        $permissions     = Permission::where([['parent_id', ' ']])->get();
        $role            = Role::where('id', $id)->with('permissions')->first();
        $parents_id      = [];
        $role_permission = [];
        foreach ($role->permissions as $key => $value) {
            array_push($role_permission, $value->id);
            array_push($parents_id, $value->parent_id);
        }
        return view('admin.role.edit', compact('parents_id', 'role', 'permissions', 'role_permission', 'page_title'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'role_name'   => 'bail:required|min:3|max:190|unique:roles,name,' . $id,
            'permissions' => 'required',
        ]);

        $role       = Role::find($id);
        $role->name = $request->role_name;
        $role->save();

        $role->syncPermissions($request->permissions);
        sendFlash('Role Update Successfully');
        return redirect()->route('admin.role.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        sendFlash('Role Delete Successfully');
        return back();

    }
}
