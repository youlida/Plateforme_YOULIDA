<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // créer les rôles
        $this->call([
            RoleSeeder::class,
        ]);

        // récupérer le rôle superadmin
        $role = Role::where('slug', 'superadmin')->first();

        // créer l'utilisateur admin
        User::factory()->create([
            'name' => 'Josue',
            'prenom' => 'Pawendtaore',
            'email' => 'josueservicedigital@gmail.com',
            'password' => bcrypt('password123'),
            'role_id' => $role->id,
        ]);
    }
}