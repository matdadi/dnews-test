<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::create([
            'fullname' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);

        $admin->assignRole('superadmin');
    }
}
