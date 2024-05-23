<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('admin-read')) {
            return abort(403);
        }

        $users = Admin::get();
        return view('cms.admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('admin-create')) {
            return abort(403);
        }
        $roles = Role::get();
        return view('cms.admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        if (!auth()->user()->can('admin-create')) {
            return redirect()->back()->with('exception', 'Anda tidak memiliki akses untuk membuat user admin');
        }

        DB::beginTransaction();
        try {
            $user = Admin::create([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_active' => $request->is_active ? true : false,
            ]);

            $user->assignRole($request->role);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('exception', $e->getMessage());
        }

        DB::commit();

        return redirect()->route('cms.admin.index')->with('success', 'User admin berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        if (!auth()->user()->can('admin-update')) {
            return abort(403);
        }
        $roles = Role::get();

        return view('cms.admin.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        if (!auth()->user()->can('admin-update')) {
            return abort(403);
        }
        if ($request->password) {
            $admin->update([
                'fullname' => $request->fullname,
                'password' => Hash::make($request->password),
                'is_active' => $request->is_active ? true : false,
            ]);
        }

        $admin->update([
            'fullname' => $request->fullname,
            'is_active' => $request->is_active ? true : false,
        ]);

        $admin->syncRoles($request->role);

        return redirect()->route('cms.admin.index')->with('success', 'User admin berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        if (!auth()->user()->can('admin-delete')) {
            return abort(403);
        }

        $admin->delete();

        return redirect()->route('cms.admin.index')->with('success', 'User admin berhasil dihapus');
    }

    public function status_update(Admin $admin): \Illuminate\Http\RedirectResponse
    {
        if (!auth()->user()->can('admin-update')) {
            return abort(403);
        }

        $admin->update([
            'is_active' => !$admin->is_active
        ]);

        return redirect()->route('cms.admin.index')->with('success', 'User admin berhasil diaktifkan');
    }
}
