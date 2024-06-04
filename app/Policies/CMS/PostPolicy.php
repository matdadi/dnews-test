<?php

namespace App\Policies\CMS;

use App\Models\Admin;
use App\Models\Post;
use Illuminate\Auth\Access\Response;

class PostPolicy
{

    public function viewAny(Admin $user): Response
    {
        if (!$user->can('post-read')) {
            return Response::deny('Anda tidak memiliki akses untuk melihat data post');
        }

        return Response::allow();
    }


    public function view(Admin $user, Post $post): Response
    {
        if (!$user->can('post-read')) {
            return Response::deny('Anda tidak memiliki akses untuk melihat data post');
        }

        return Response::allow();
    }


    public function create(Admin $user): Response
    {
        if (!$user->can('post-create')) {
            return Response::deny('Anda tidak memiliki akses untuk membuat post');
        }

        return Response::allow();
    }


    public function update(Admin $user, Post $post): Response
    {
        if (!$user->can('post-update')) {
            return Response::deny('Anda tidak memiliki akses untuk mengubah data kategori');
        }

        return Response::allow();
    }


    public function delete(Admin $user, Post $post): Response
    {
        if (!$user->can('post-delete')) {
            return Response::deny('Anda tidak memiliki akses untuk menghapus data kategori');
        }

        return Response::allow();
    }
    
}
