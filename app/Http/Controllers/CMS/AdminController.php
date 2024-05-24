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

    public function index()
    {
        $this->authorize('viewAny', Admin::class);

        $users = Admin::get();
        return view('cms.admin.index', compact('users'));
    }


    public function create()
    {
        $this->authorize('create', Admin::class);

        $roles = Role::get();
        return view('cms.admin.create', compact('roles'));
    }


    public function store(StoreAdminRequest $request)
    {
        $this->authorize('create', Admin::class);

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


    public function show(Admin $admin)
    {

    }


    public function edit(Admin $admin)
    {
        $this->authorize('update', $admin);

        $roles = Role::get();

        return view('cms.admin.edit', compact('admin', 'roles'));
    }


    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $this->authorize('update', $admin);

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


    public function destroy(Admin $admin)
    {
        $this->authorize('delete', $admin);

        $admin->delete();

        return redirect()->route('cms.admin.index')->with('success', 'User admin berhasil dihapus');
    }

    public function status_update(Admin $admin): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('updateActive', $admin);

        $admin->update([
            'is_active' => !$admin->is_active
        ]);

        return redirect()->route('cms.admin.index')->with('success', 'User admin berhasil diaktifkan');
    }
}
