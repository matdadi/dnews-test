<?php

namespace App\Http\Controllers\CMS;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request): View
    {
        if (!Auth::user()->can('role-read')) {
            return abort(403);
        }

        $roles = Role::orderBy('id', 'DESC')->get();
        return view('cms.role.index', compact('roles'));
    }


    public function create()
    {
        if (!auth()->user()->can('role-create')) {
            return abort(403);
        }

        $permissions = Permission::get();
        return view('cms.role.create', compact('permissions'));
    }


    public function store(Request $request)
    {
        if (!auth()->user()->can('role-create')) {
            return abort(403);
        }

        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));

        return redirect()->route('cms.role.index')
            ->with('success', 'Data berhasil ditambah');
    }


    public function show(Role $role)
    {
        if (!auth()->user()->can('role-list')) {
            return abort(403);
        }

        $rolePermissions = $role->permissions;

        return view('cms.role.show', compact('role', 'rolePermissions'));
    }

    public function edit(Role $role)
    {
        if (!auth()->user()->can('role-update')) {
            return abort(403);
        }

        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::get();

        return view('cms.role.edit', compact('role', 'rolePermissions', 'permissions'));
    }

    public function update(Role $role, Request $request)
    {
        if (!auth()->user()->can('role-update')) {
            return abort(403);
        }

        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role->update($request->only('name'));

        $role->syncPermissions($request->get('permission'));

        return redirect()->route('cms.role.index')
            ->with('success', 'Data berhasil diubah');
    }

    public function destroy(Role $role)
    {
        if (!auth()->user()->can('role-delete')) {
            return abort(403);
        }

        $role->delete();

        return redirect()->route('cms.role.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
