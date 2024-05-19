<?php

namespace App\Http\Controllers;

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
        $users = Admin::get();
        return view('admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.create', compact('roles'));
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
                'is_active' => true
            ]);


            $user->assignRole($request->role);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('exception', $e->getMessage());
        }

        DB::commit();

        return redirect()->route('admin.index')->with('success', 'User admin berhasil dibuat');
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
        $roles = Role::get();

        return view('admin.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        if (!auth()->user()->can('admin-update')) {
            return redirect()->back()->with('exception', 'Anda tidak memiliki akses untuk mengupdate user admin');
        }
        if ($request->password) {
            $admin->update([
                'fullname' => $request->fullname,
                'password' => Hash::make($request->password),
            ]);
        }

        $admin->update([
            'fullname' => $request->fullname,
        ]);

        $admin->syncRoles($request->role);

        return redirect()->route('admin.index')->with('success', 'User admin berhasil diupdate');
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

        return redirect()->route('admin.index')->with('success', 'User admin berhasil dihapus');
    }

    public function status_update(Admin $admin)
    {
        if (!auth()->user()->can('admin-status-update')) {
            return abort(403);
        }

        $admin->update([
            'is_active' => !$admin->is_active
        ]);

        return redirect()->route('admin.index')->with('success', 'User admin berhasil diaktifkan');
    }
}
