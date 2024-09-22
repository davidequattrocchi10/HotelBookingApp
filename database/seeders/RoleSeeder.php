<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea il ruolo di admin
        Role::create(['name' => 'admin']);

        // Puoi aggiungere altri ruoli se necessario
        Role::create(['name' => 'user']);
    }
}
