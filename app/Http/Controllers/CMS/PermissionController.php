<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(): View
    {
        if (!auth()->user()->can('permission-read')) {
            abort(403);
        }

        $permissions = Permission::all();

        return view('cms.permission.index', compact('permissions'));
    }


    public function create(): View
    {
        if (!auth()->user()->can('permission-create')) {
            abort(403);
        }

        return view('cms.permission.create');
    }


    public function store(Request $request): RedirectResponse
    {
        if (!auth()->user()->can('permission-create')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);

        Permission::create($request->only('name'));

        return redirect()->route('cms.permission.index')
            ->withSuccess('Data permission berhasil dibuat');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Permission $permission
     * @return View
     */
    public function edit(Permission $permission): View
    {
        if (!auth()->user()->can('permission-update')) {
            abort(403);
        }

        return view('cms.permission.edit', [
            'permission' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function update(Request $request, Permission $permission): RedirectResponse
    {
        if (!auth()->user()->can('permission-update')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id
        ]);

        $permission->update($request->only('name'));

        return redirect()->route('permission.index')
            ->withSuccess(__('Data permission berhasil diubah'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        if (!auth()->user()->can('permission-delete')) {
            abort(403);
        }

        $permission->delete();

        return redirect()->route('cms.permission.index')
            ->withSuccess(__('Data permission berhasil dihapus'));
    }
}
