<?php

namespace App\Policies\CMS;

use App\Models\Admin;
use App\Models\Subcategory;
use Illuminate\Auth\Access\Response;

class SubcategoryPolicy
{
    public function viewAny(Admin $user)
    {
        if (!$user->can('subcategory-read')) {
            return Response::deny('Anda tidak memiliki akses untuk melihat data subkategori');
        }

        return Response::allow();
    }

    public function view(Admin $user, Subcategory $subcategory)
    {
        if (!$user->can('subcategory-read')) {
            return Response::deny('Anda tidak memiliki akses untuk melihat data subkategori');
        }

        return Response::allow();
    }

    public function create(Admin $user)
    {
        if (!$user->can('subcategory-create')) {
            return Response::deny('Anda tidak memiliki akses untuk membuat subkategori');
        }

        return Response::allow();
    }

    public function update(Admin $user, Subcategory $subcategory)
    {
        if (!$user->can('subcategory-update')) {
            return Response::deny('Anda tidak memiliki akses untuk mengubah data subkategori');
        }

        return Response::allow();
    }

    public function delete(Admin $user, Subcategory $subcategory)
    {
        if (!$user->can('subcategory-delete')) {
            return Response::deny('Anda tidak memiliki akses untuk menghapus data subkategori');
        }

        if ($subcategory->posts()->exists()) {
            return Response::deny('Subkategori ini dipakai pada postingan berita');
        }


        return Response::allow();
    }
}
