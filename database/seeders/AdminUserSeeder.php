<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'Administrador')->first();

        User::firstOrCreate(
            ['email' => 'admin@local.test'],
            [
                'first_name' => 'Administrador',
                'last_name' => 'Sistema',
                'password' => Hash::make('Admin12345!'),
                'role_id' => $adminRole->id,
                'status' => true,
            ]
        );
    }
}