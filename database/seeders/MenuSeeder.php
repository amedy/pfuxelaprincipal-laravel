<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create([
            'categoria_id' => 1,
            'nome' => 'Motorista',
            'icon' => 'user-alt-1',
            'prefix' => 'motorista',
        ]);

        Menu::create([
            'categoria_id' => 1,
            'nome' => 'Rotas',
            'icon' => 'map-pins',
            'prefix' => 'rotas',
        ]);

        Menu::create([
            'categoria_id' => 1,
            'nome' => 'Projectos',
            'icon' => 'users-social',
            'prefix' => 'projectos',
        ]);

        Menu::create([
            'categoria_id' => 2,
            'nome' => 'Viatura',
            'icon' => 'car-alt-1',
            'prefix' => 'viatura',
        ]);

        Menu::create([
            'categoria_id' => 2,
            'nome' => 'Abastecimento',
            'icon' => 'speed-meter',
            'prefix' => 'abastecimento',
        ]);

        Menu::create([
            'categoria_id' => 2,
            'nome' => 'Ocorrência',
            'icon' => 'exclamation-tringle',
            'prefix' => 'ocorrencia',
        ]);

        Menu::create([
            'categoria_id' => 2,
            'nome' => 'Bombas',
            'icon' => 'retweet',
            'prefix' => 'bombas',
        ]);

        Menu::create([
            'categoria_id' => 3,
            'nome' => 'Movimentos',
            'icon' => 'rounded-expand',
            'prefix' => 'movimentos',
        ]);

        Menu::create([
            'categoria_id' => 4,
            'nome' => 'Inventário',
            'icon' => 'box',
            'prefix' => 'inventario',
        ]);

        Menu::create([
            'categoria_id' => 4,
            'nome' => 'Peças',
            'icon' => 'gears',
            'prefix' => 'pecas',
        ]);

        Menu::create([
            'categoria_id' => 5,
            'nome' => 'Requisição',
            'icon' => 'envelope',
            'prefix' => 'requisicao',
        ]);

        Menu::create([
            'categoria_id' => 7,
            'nome' => 'Utilizador',
            'icon' => 'users-alt-6',
            'prefix' => 'utilizador',
        ]);

        Menu::create([
            'categoria_id' => 7,
            'nome' => 'Permissões',
            'icon' => 'ui-settings',
            'prefix' => 'permissoes',
        ]);
        Menu::create([
            'categoria_id' => 2,
            'nome' => 'Requisição ao HST',
            'icon' => 'envelope',
            'prefix' => 'hst-requisicao',
        ]);
         Menu::create([
            'categoria_id' => 1,
            'nome' => 'Plano',
            'icon' => 'envelope',
            'prefix' => 'rpiquete',
   ]);
        Menu::create([
            'categoria_id' => 6,
            'nome' => 'Job card',
            'icon' => 'notebook',
            'prefix' => 'job-card',
        ]);

        Menu::create([
            'categoria_id' => 6,
            'nome' => 'Técnico',
            'icon' => 'worker',
            'prefix' => 'tecnico',
        ]);
    }
}
