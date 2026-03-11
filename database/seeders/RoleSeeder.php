<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::updateOrCreate(
            ['slug' => 'superadmin'],
            ['name' => 'SUPERADMIN', 'description' => 'Super administrateur']
        );

        Role::updateOrCreate(
            ['slug' => 'admin'],
            ['name' => 'ADMIN', 'description' => 'Administrateur']
        );

        Role::updateOrCreate(
            ['slug' => 'user'],
            ['name' => 'USER', 'description' => 'Utilisateur standard']
        );
    }
}