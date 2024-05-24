<?php

namespace App\Policies\CMS;

use App\Models\Admin;
use App\Models\Tag;
use Illuminate\Auth\Access\Response;

class TagPolicy
{

    public function viewAny(Admin $user): Response
    {
        if (!$user->can('tag-read')) {
            return Response::deny('Anda tidak memiliki akses untuk melihat tag');
        }

        return Response::allow();
    }

    public function view(Admin $user, Tag $tag): bool
    {
        //
    }

    public function create(Admin $user): Response
    {
        if (!$user->can('tag-create')) {
            return Response::deny('Anda tidak memiliki akses untuk membuat tag');
        }

        return Response::allow();
    }


    public function update(Admin $user, Tag $tag): Response
    {
        if (!$user->can('tag-update')) {
            return Response::deny('Anda tidak memiliki akses untuk mengubah tag');
        }

        return Response::allow();
    }

    public function delete(Admin $user, Tag $tag): Response
    {
        if (!$user->can('tag-delete')) {
            return Response::deny('Anda tidak memiliki akses untuk menghapus tag');
        }

        if ($tag->posts()->exists()) {
            return Response::deny('Tag ini masih digunakan oleh post');
        }

        return Response::allow();
    }

    public function statusUpdate(Admin $user, Tag $tag): Response
    {
        if (!$user->can('tag-update')) {
            return Response::deny('Anda tidak memiliki akses untuk mengubah status tag');
        }

        return Response::allow();
    }
}
