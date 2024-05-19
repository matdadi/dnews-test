<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{


    public function index(Request $request): View
    {
        if(!Auth::user()->can('role-read')) {
            return abort(403);
        }

        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('role.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        if(!auth()->user()->can('role-create')) {
            return abort(403);
        }

        $permissions = Permission::get();
        return view('role.create', compact('permissions'));
    }


    public function store(Request $request)
    {
        if(!auth()->user()->can('role-create')) {
            return abort(403);
        }

        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));

        return redirect()->route('role.index')
                        ->with('success','Data berhasil ditambah');
    }


    public function show(Role $role)
    {
        if(!auth()->user()->can('role-list')) {
            return abort(403);
        }

        $rolePermissions = $role->permissions;

        return view('role.show', compact('role', 'rolePermissions'));
    }

    public function edit(Role $role)
    {
        if(!auth()->user()->can('role-update')) {
            return abort(403);
        }

        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::get();

        return view('role.edit', compact('role', 'rolePermissions', 'permissions'));
    }

    public function update(Role $role, Request $request)
    {
        if(!auth()->user()->can('role-update')) {
            return abort(403);
        }

        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role->update($request->only('name'));

        $role->syncPermissions($request->get('permission'));

        return redirect()->route('role.index')
                        ->with('success','Data berhasil diubah');
    }

    public function destroy(Role $role)
    {
        if(!auth()->user()->can('role-delete')) {
            return abort(403);
        }

        $role->delete();

        return redirect()->route('role.index')
                        ->with('success','Data berhasil dihapus');
    }
}
