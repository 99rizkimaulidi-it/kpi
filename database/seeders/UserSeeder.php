<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Super Admin', 'password' => Hash::make('password'), 'status' => 'active']
        );
        $admin->roles()->sync([3]);

        $coAdmin = User::updateOrCreate(
            ['email' => 'coadmin@example.com'],
            ['name' => 'Co Admin', 'password' => Hash::make('password'), 'status' => 'active']
        );
        $coAdmin->roles()->sync([2]);

        $employee = User::updateOrCreate(
            ['email' => 'karyawan@example.com'],
            ['name' => 'Employee', 'password' => Hash::make('password'), 'status' => 'active']
        );
        $employee->roles()->sync([1]);
    }
}
