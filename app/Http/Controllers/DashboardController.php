<?php

namespace App\Http\Controllers;

use App\Http\Services\AbastecimentoService;
use App\Http\Services\ProjectoService;
use App\Http\Services\RequisicaoService;
use App\Http\Services\UtilizadorService;
use App\Http\Services\ViaturaService;
use Illuminate\Http\Request;

class DashboardController extends HomeController
{
    public function create()
    {
        return view('dashboard.index', [
            'nr_users' => UtilizadorService::countUsers(),
            'nr_viaturas' => ViaturaService::countViaturas(),
             'nr_projectos' => ProjectoService::countProjectos(),
            'nr_requisicoes' => RequisicaoService::count(),
            'ordens' => AbastecimentoService::indexTodaysOrders(),
        ]);
    }
}
