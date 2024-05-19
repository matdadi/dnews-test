<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'role-read', 'role-create', 'role-update', 'role-delete',
            'admin-read', 'admin-create', 'admin-update', 'admin-delete', 'admin-status-update',
            'user-read', 'user-create', 'user-update', 'user-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
