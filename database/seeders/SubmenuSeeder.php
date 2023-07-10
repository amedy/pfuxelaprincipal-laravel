<?php

namespace Database\Seeders;

use App\Models\Submenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Submenu::create([
            'menu_id' => 1,
            'nome' => 'Criar',
            'route' => 'motorista.create',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 1,
            'nome' => 'Lista',
            'route' => 'motorista.list',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 1,
            'nome' => 'Editar',
            'route' => 'motorista.update',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 1,
            'nome' => 'Actualizar carta de condução',
            'route' => 'motorista.docs.update',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 1,
            'nome' => 'Eliminar',
            'route' => 'motorista.delete',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 2,
            'nome' => 'Lista',
            'route' => 'rotas.list',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 3,
            'nome' => 'Lista',
            'route' => 'projectos.list',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 4,
            'nome' => 'Criar',
            'route' => 'viatura.create',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 4,
            'nome' => 'Lista',
            'route' => 'viatura.list',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 4,
            'nome' => 'Editar',
            'route' => 'viatura.update',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 4,
            'nome' => 'Documentos da viatura',
            'route' => 'viatura.docs.update',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 4,
            'nome' => 'Eliminar',
            'route' => 'viatura.delete',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 4,
            'nome' => 'Criar Alocação',
            'route' => 'viatura.alocar.create',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 4,
            'nome' => 'Alocação',
            'route' => 'viatura.alocar.list',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 4,
            'nome' => 'Histórico de Alocação',
            'route' => 'viatura.alocar.history',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 4,
            'nome' => 'Editar Alocação',
            'route' => 'viatura.alocar.update',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 4,
            'nome' => 'Eliminar',
            'route' => 'viatura.alocar.delete',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 5,
            'nome' => 'Criar',
            'route' => 'abastecimento.create',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 5,
            'nome' => 'Extraordinário',
            'route' => 'abastecimento.extra.create',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 5,
            'nome' => 'Lista',
            'route' => 'abastecimento.list',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 5,
            'nome' => 'Mais Detalhes',
            'route' => 'abastecimento.show',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 5,
            'nome' => 'Terminar Ordem',
            'route' => 'abastecimento.retrieve',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 5,
            'nome' => 'Cancelar Ordem',
            'route' => 'abastecimento.cancel',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 5,
            'nome' => 'Aprovar Ordem',
            'route' => 'abastecimento.approve',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 5,
            'nome' => 'Editar',
            'route' => 'abastecimento.update',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 5,
            'nome' => 'Eliminar',
            'route' => 'abastecimento.delete',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 6,
            'nome' => 'Criar',
            'route' => 'ocorrencia.create',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 6,
            'nome' => 'Lista',
            'route' => 'ocorrencia.list',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 6,
            'nome' => 'Abrir job card',
            'route' => 'ocorrencia.job-card',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 6,
            'nome' => 'Editar',
            'route' => 'ocorrencia.update',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 6,
            'nome' => 'Eliminar',
            'route' => 'ocorrencia.delete',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 7,
            'nome' => 'Criar',
            'route' => 'bombas.create',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 7,
            'nome' => 'Lista',
            'route' => 'bombas.list',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 7,
            'nome' => 'Reabastecer bombas',
            'route' => 'bombas.refill',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 7,
            'nome' => 'Editar',
            'route' => 'bombas.update',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 7,
            'nome' => 'Mudar estado das bombas',
            'route' => 'bombas.state',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 7,
            'nome' => 'Eliminar',
            'route' => 'bombas.delete',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 9,
            'nome' => 'Entrada',
            'route' => 'inventario.create',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 9,
            'nome' => 'Lista',
            'route' => 'inventario.list',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 9,
            'nome' => 'Editar',
            'route' => 'inventario.update',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 9,
            'nome' => 'Eliminar',
            'route' => 'inventario.delete',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 10,
            'nome' => 'Criar',
            'route' => 'pecas.create',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 10,
            'nome' => 'Lista',
            'route' => 'pecas.list',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 10,
            'nome' => 'Editar',
            'route' => 'pecas.update',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 10,
            'nome' => 'Eliminar',
            'route' => 'pecas.delete',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 11,
            'nome' => 'Lista',
            'route' => 'requisicao.list',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 11,
            'nome' => 'Responder',
            'route' => 'requisicao.answer',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 11,
            'nome' => 'Mais Detalhes',
            'route' => 'requisicao.show',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 11,
            'nome' => 'Eliminar',
            'route' => 'requisicao.delete',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 12,
            'nome' => 'Criar',
            'route' => 'utilizador.create',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 12,
            'nome' => 'Lista',
            'route' => 'utilizador.list',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 12,
            'nome' => 'Editar',
            'route' => 'utilizador.update',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 12,
            'nome' => 'Mudar estado do utilizador',
            'route' => 'utilizador.state',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 12,
            'nome' => 'Eliminar',
            'route' => 'utilizador.delete',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 13,
            'nome' => 'Criar',
            'route' => 'permissoes.create',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 13,
            'nome' => 'Lista',
            'route' => 'permissoes.list',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 13,
            'nome' => 'Editar',
            'route' => 'permissoes.update',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 13,
            'nome' => 'Gestão de menus',
            'route' => 'permissoes.manage',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 13,
            'nome' => 'Eliminar',
            'route' => 'permissoes.delete',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 14,
            'nome' => 'Lista',
            'route' => 'hst-requisicao.list',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 14,
            'nome' => 'Alocar',
            'route' => 'hst-requisicao.alocar',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 14,
            'nome' => 'Mais detalhes',
            'route' => 'hst-requisicao.show',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 14,
            'nome' => 'Eliminar',
            'route' => 'hst-requisicao.delete',
            'sidebar' => 0,
        ]);
         Submenu::create([
            'menu_id' => 15,
            'nome' => 'Criar',
            'route' => 'rpiquete.create',
            'sidebar' => 1,
        ]);
         Submenu::create([
            'menu_id' => 15,
            'nome' => 'Lista',
            'route' => 'rpiquete.list',
            'sidebar' => 1,
        ]);
        Submenu::create([
            'menu_id' => 15,
            'nome' => 'editar',
            'route' => 'rpiquete.update',
            'sidebar' => 0,
]);
        Submenu::create([
            'menu_id' => 15,
            'nome' => 'Criar',
            'route' => 'job-card.create',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 15,
            'nome' => 'Lista',
            'route' => 'job-card.list',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 15,
            'nome' => 'Mais detalhes',
            'route' => 'job-card.show',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 15,
            'nome' => 'Editar',
            'route' => 'job-card.update',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 15,
            'nome' => 'Adicionar trabalhos efectuados',
            'route' => 'job-card.jobs',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 15,
            'nome' => 'Eliminar',
            'route' => 'job-card.delete',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 16,
            'nome' => 'Criar',
            'route' => 'tecnico.create',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 16,
            'nome' => 'Lista',
            'route' => 'tecnico.list',
            'sidebar' => 1,
        ]);

        Submenu::create([
            'menu_id' => 16,
            'nome' => 'Mais detalhes',
            'route' => 'tecnico.update',
            'sidebar' => 0,
        ]);

        Submenu::create([
            'menu_id' => 16,
            'nome' => 'Eliminar',
            'route' => 'tecnico.delete',
            'sidebar' => 0,
        ]);
    }
}
