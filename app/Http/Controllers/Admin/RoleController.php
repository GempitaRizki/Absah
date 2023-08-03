<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Role;
use App\Models\Permission;

use Illuminate\Http\Request;

use Session;

class RoleController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['currentAdminMenu'] = 'role-user';
        $this->data['currentAdminSubMenu'] = 'role';
    }
    public function index()
    {
        $this->data['roles'] = Role::all();
        $this->data['permissions'] = Permission::all();

        return view('admin.roles.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:roles']);

        if (Role::create($request->only('name'))) {
            Session::flash('successs', 'New role added.');
        }

        return redirect('admin/roles');
    }


    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        Session::flash('success', $role->name . ' permissions has been updated.');

        if ($role->name == 'Admin') {
            $role->syncPermissions(Permission::all());

            return redirect('admin/roles');
        }

        $permissions = $request->get('permissions', []);

        $role->syncPermissions($permissions);

        return redirect('admin/roles');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
