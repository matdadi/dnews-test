<?php

namespace App\Policies\CMS;

use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class AdminPolicy
{

    public function viewAny(Admin $user): Response
    {
        if (!$user->can('admin-read')) {
            return Response::deny('Anda tidak memiliki akses untuk melihat data admin');
        }

        return Response::allow();
    }

    public function view(Admin $user, Admin $admin): bool
    {

    }

    public function create(Admin $user): Response
    {
        if (!$user->can('admin-create')) {
            return Response::deny('Anda tidak memiliki akses untuk membuat user admin');
        }

        return Response::allow();
    }

    public function update(Admin $user, Admin $admin): Response
    {
        if (!$user->can('admin-update')) {
            return Response::deny('Anda tidak memiliki akses untuk mengubah data admin');
        }

        return Response::allow();
    }

    public function delete(Admin $user, Admin $admin): Response
    {
        if (!$user->can('admin-delete')) {
            return Response::deny('Anda tidak memiliki akses untuk menghapus data admin');
        }

        if ($user->id === $admin->id) {
            return Response::deny('Anda tidak dapat menghapus akun anda sendiri');
        }

        return Response::allow();
    }

    public function updateActive(Admin $user, Admin $admin): Response
    {
        if (!$user->can('admin-update')) {
            return Response::deny('Anda tidak memiliki akses untuk mengubah data admin');
        }

        if ($user->id === $admin->id) {
            return Response::deny('Anda tidak dapat mengubah status akun anda sendiri');
        }

        return Response::allow();
    }

}
