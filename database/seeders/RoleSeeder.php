<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'superadmin',
        ];

        foreach ($roles as $role) {
            $role = Role::create([
                'name' => $role,
                'guard_name' => 'admin',
            ]);

            $permissions = Permission::pluck('id', 'id')->all();

            $role->syncPermissions($permissions);
        }


    }
}
