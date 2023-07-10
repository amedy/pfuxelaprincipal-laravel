<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HSTRequisicaoController extends Controller
{
    public function alocar($id)
    {
        return view('hst-requisicao.answer', [
            'requisicao' => RequisicaoService::get($id),
        ]);
    }

    public function delete($id)
    {
        RequisicaoService::delete($id);

        session()->flash('title', 'Requisição ao HST');
        return back()->with('success-message', 'Eliminada com sucesso!');
    }

    public function index()
    {
        return view('hst-requisicao.index', [
            'requisicoes' => RequisicaoService::index()
        ]);
    }
}
