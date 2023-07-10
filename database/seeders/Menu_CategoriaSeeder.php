<?php

namespace Database\Seeders;

use App\Models\Menu_Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Menu_CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Menu_Categoria::create([
            'nome' => 'Piquete',
            'descricao' => 'Plano de viagem, motoristas, rotas',
        ]);

        Menu_Categoria::create([
            'nome' => 'HST',
            'descricao' => 'Viaturas, abastecimento, ocorrências',
        ]);

        Menu_Categoria::create([
            'nome' => 'Guarita',
            'descricao' => 'Movimentos de viaturas',
        ]);

        Menu_Categoria::create([
            'nome' => 'Armazém',
            'descricao' => 'Peças, Inventário',
        ]);

        Menu_Categoria::create([
            'nome' => 'Clientes',
            'descricao' => 'Requisições',
        ]);

        Menu_Categoria::create([
            'nome' => 'Oficina',
            'descricao' => 'Job cards, Técnicos',
        ]);

        Menu_Categoria::create([
            'nome' => 'Administração',
            'descricao' => 'Utilizadores, permissões',
        ]);
    }
}
