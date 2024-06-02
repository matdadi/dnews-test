<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'permission-read', 'permission-create', 'permission-update', 'permission-delete',
            'category-read', 'category-create', 'category-update', 'category-delete',
            'subcategory-read', 'subcategory-create', 'subcategory-update', 'subcategory-delete',
            'tag-read', 'tag-create', 'tag-update', 'tag-delete',
            'post-read', 'post-create', 'post-update', 'post-delete',
            'post-view-read',
            'role-read', 'role-create', 'role-update', 'role-delete',
            'admin-read', 'admin-create', 'admin-update', 'admin-delete',
            'user-read', 'user-create', 'user-update', 'user-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'admin',
            ]);
        }
    }
}
