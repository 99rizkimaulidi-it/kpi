<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Karyawan', 'slug' => 'karyawan', 'description' => 'Employee role'],
            ['name' => 'Co-Administrator', 'slug' => 'co-admin', 'description' => 'Task manager'],
            ['name' => 'Super Administrator', 'slug' => 'super-admin', 'description' => 'IT Support'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['slug' => $role['slug']], $role);
        }
    }
}
