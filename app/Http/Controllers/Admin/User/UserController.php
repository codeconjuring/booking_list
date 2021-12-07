<?php

namespace App\Http\Controllers\Admin\User;

use App\DataTables\User\UserTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Add User'])->only(['create', 'store']);
        $this->middleware(['permission:Download Report'])->only(['downloadPdf']);
        $this->middleware(['permission:Edit User'])->only(['edit']);
        $this->middleware(['permission:Show User'])->only(['index']);
        $this->middleware(['permission:Delete User'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserTable $datatable)
    {
        $page_title = "User List";
        return $datatable->render('admin.user.index', ['page_title' => $page_title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles      = Role::all();
        $page_title = "Create New User";
        return view('admin.user.create', compact('roles', 'page_title'));
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
            'first_name' => 'required',
            'last_name'  => 'nullable',
            'email'      => 'required|unique:users,email',
            'password'   => 'required|min:8',
            'role'       => 'required',
        ]);
        $user = User::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'profile_image' => $request->profile_image,
            'user_type'     => 'Admin',
        ]);
        $user->syncRoles($request->role);
        sendFlash("User Create Successfully.");
        return redirect()->route('admin.user.index');
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
        $user       = User::with(['roles'])->findOrFail($id);
        $page_title = "Edit User";
        $roles      = Role::all();
        return view('admin.user.edit', compact('user', 'page_title', 'roles'));

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
            'first_name' => 'required',
            'last_name'  => 'nullable',
            'email'      => 'required|unique:users,email,' . $id,
            'role'       => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'password'      => isset($request->password) ? Hash::make($request->password) : $user->password,
            'profile_image' => $request->profile_image,
        ]);

        User::whereId($id)->first()->syncRoles($request->role);
        sendFlash('User Update Successfully.');
        return redirect()->route('admin.user.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::whereId($id)->first();
        $user->delete();
        sendFlash("User Delete Successfully");
        return redirect()->route('admin.user.index');
    }
}
