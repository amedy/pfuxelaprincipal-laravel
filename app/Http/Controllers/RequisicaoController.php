<?php

namespace App\Http\Controllers;

use App\Http\Requests\Requisicao\sendRequest;
use App\Http\Services\RequisicaoService;
use Illuminate\Http\Request;

class RequisicaoController extends HomeController
{
    public function show($client, $requisicao)
    {
        return view('requisicao.show', [
            'requisicao' => RequisicaoService::show($client, $requisicao),
        ]);
    }

    public function answer($id)
    {
        return view('requisicao.answer', [
            'requisicao' => RequisicaoService::get($id),
        ]);
    }

    public function send(sendRequest $request, $id)
    {
        try {
            RequisicaoService::send($request, $id);

            session()->flash('title', 'Resposta da requisição');
            return to_route('requisicao.send')->with('success-message', 'Enviada com sucesso!');
        } catch (\Throwable $th) {

            session()->flash('title', 'Resposta da requisição');
            return back()->with('error-message', 'Erro!');
        }
    }

    public function delete($id)
    {
        RequisicaoService::delete($id);

        session()->flash('title', 'Requisição');
        return back()->with('success-message', 'Eliminada com sucesso!');
    }

    public function index()
    {
        return view('requisicao.index', [
            'requisicoes' => RequisicaoService::index()
        ]);
    }
}
