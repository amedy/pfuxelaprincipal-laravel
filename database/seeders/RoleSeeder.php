<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'nome' => 'Administradores',
            'descricao' => 'Grupo de permissões com todos os menus',
            'created_by' => 1,
            'created_at' => now(),
        ]);

        Role::create([
            'nome' => 'Piquete',
            'descricao' => 'Grupo de permissões com menus da Piquete',
            'created_by' => 1,
            'created_at' => now(),
        ]);

        Role::create([
            'nome' => 'HST',
            'descricao' => 'Grupo de permissões com menus do HST',
            'created_by' => 1,
            'created_at' => now(),
        ]);

        Role::create([
            'nome' => 'Armazém',
            'descricao' => 'Grupo de permissões com menus do Armazém',
            'created_by' => 1,
            'created_at' => now(),
        ]);

        Role::create([
            'nome' => 'Administração',
            'descricao' => 'Grupo de permissões com menus da Administração',
            'created_by' => 1,
            'created_at' => now(),
        ]);

        Role::create([
            'nome' => 'Clientes',
            'descricao' => 'Grupo de permissões com menus do Cliente',
            'created_by' => 1,
            'created_at' => now(),
        ]);
    }
}
