<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ocorrencia\storeFromMovimentoRequest;
use App\Http\Requests\Ocorrencia\storeRequest;
use App\Http\Services\MotoristaService;
use App\Http\Services\OcorrenciaService;
use App\Http\Services\ViaturaService;
use Illuminate\Http\Request;

class OcorrenciaController extends HomeController
{
    public function create()
    {
        return view('ocorrencia.create', [
            'viaturas' => ViaturaService::index(),
            'motoristas' => MotoristaService::index(),
        ]);
    }

    public function createFromMovimento($viatura, $motorista, $movimento)
    {
        return view('ocorrencia.create-movimento', [
            'viatura' => ViaturaService::get($viatura),
            'motorista' => MotoristaService::get($motorista),
            'saida' => $movimento,
        ]);
    }

    public function update($id)
    {
        return view('ocorrencia.update', [
            'ocorrencia' => OcorrenciaService::get($id),
            'viaturas' => ViaturaService::index(),
            'motoristas' => MotoristaService::index(),
        ]);
    }


    public function jobCard($ocorrencia)
    {
        return to_route('job-card.create', $ocorrencia);
    }

    public function store(storeRequest $request)
    {
        OcorrenciaService::store($request);

        session()->flash('title', 'Ocorrência');
        return to_route('ocorrencia.list')->with('success-message', 'Registada com sucesso!');
    }

    public function storeFromMovimento(storeFromMovimentoRequest $request, $movimento)
    {
        OcorrenciaService::storeFromMovimento($request, $movimento);

        session()->flash('title', 'Ocorrência');
        return to_route('ocorrencia.list')->with('success-message', 'Registada com sucesso!');
    }

    public function put(storeRequest $request, $id)
    {
        OcorrenciaService::put($request, $id);

        session()->flash('title', 'Ocorrência');
        return to_route('ocorrencia.list')->with('success-message', 'Actualizada com sucesso!');
    }

    public function delete($id)
    {
        OcorrenciaService::delete($id);

        session()->flash('title', 'Ocorrência');
        return back()->with('success-message', 'Eliminada com sucesso!');
    }

    public function index()
    {
        return view('ocorrencia.index', [
            'ocorrencias' => OcorrenciaService::index()
        ]);
    }
}
