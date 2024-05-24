<?php

namespace App\Policies\CMS;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    public function viewAny(Admin $user)
    {
        if (!$user->can('category-read')) {
            return Response::deny('Anda tidak memiliki akses untuk melihat data kategori');
        }

        return Response::allow();
    }

    public function view(Admin $user, Category $category)
    {
        if (!$user->can('category-read')) {
            return Response::deny('Anda tidak memiliki akses untuk melihat data kategori');
        }

        return Response::allow();
    }

    public function create(Admin $user)
    {
        if (!$user->can('category-create')) {
            return Response::deny('Anda tidak memiliki akses untuk membuat kategori');
        }

        return Response::allow();
    }

    public function update(Admin $user, Category $category)
    {
        if (!$user->can('category-update')) {
            return Response::deny('Anda tidak memiliki akses untuk mengubah data kategori');
        }

        return Response::allow();
    }

    public function delete(Admin $user, Category $category)
    {
        if (!$user->can('category-delete')) {
            return Response::deny('Anda tidak memiliki akses untuk menghapus data kategori');
        }

        if ($category->subcategory()->exists()) {
            return Response::deny('Kategori ini dipakai pada subkategori');
        }
        

        return Response::allow();
    }
}
