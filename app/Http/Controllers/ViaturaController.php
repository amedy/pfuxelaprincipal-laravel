<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\MarcaService;
use App\Http\Services\ViaturaService;
use App\Http\Requests\Viatura\putRequest;
use App\Http\Services\CombustivelService;
use App\Http\Requests\Viatura\storeRequest;
use App\Http\Requests\Viatura\putDocsRequest;
use App\Http\Requests\Viatura\storeAlocarRequest;
use App\Http\Services\MotoristaService;
use App\Http\Services\RotasService;


class ViaturaController extends HomeController
{
    public function create()
    {
        return view('viatura.create', [
            'marcas' => MarcaService::index(),
            'combustiveis' => CombustivelService::index(),
            'viatura_tipos' => ViaturaService::indexTipos(),
        ]);
    }

    public function createAlocar()
    {
        return view('viatura.create-alocar', [
            'viaturas' => ViaturaService::indexNaoAlocadas(),
            'motoristas' => MotoristaService::indexNaoAlocados(),
            'rotas' => RotasService::indexNaoAlocadas(),
        ]);
    }

    public function update($id)
    {
        return view('viatura.update', [
            'viatura' => ViaturaService::get($id),
            'marcas' => MarcaService::index(),
            'combustiveis' => CombustivelService::index(),
            'viatura_tipos' => ViaturaService::indexTipos(),
        ]);
    }

    public function updateAlocar($id)
    {
        return view('viatura.update-alocar', [
            'alocacao' => ViaturaService::getAlocacao($id),
            'viaturas' => ViaturaService::indexNaoAlocadasExcept($id),
            'motoristas' => MotoristaService::indexNaoAlocadosExcept($id),
            'rotas' => RotasService::indexNaoAlocadasExcept($id),
            'rotas_motorista' => ViaturaService::getAlocacaoRotas($id),
        ]);
    }

    public function switchObjective(Request $request)
    {
        return view('abastecimento.components.viaturas', [
            'viaturas' => ($request->objective == 'Rota') ? ViaturaService::indexAlocadasOnly() : ViaturaService::index(),
        ]);

    }

    public function updateDocs($id)
    {
        return view('viatura.update-docs', [
            'viatura' => ViaturaService::get($id),
        ]);
    }

    public function getViaturaInfo(Request $request)
    {
        return ViaturaService::getViaturaInfo($request);
    }

    public function store(storeRequest $request)
    {
        ViaturaService::store($request);

        session()->flash('title', 'Viatura');
        return to_route('viatura.list')->with('success-message', 'Criada com sucesso!');
    }

    public function storeAlocar(storeAlocarRequest $request)
    {
        ViaturaService::storeAlocar($request);

        session()->flash('title', 'Alocação da Viatura');
        return to_route('viatura.alocar.list')->with('success-message', 'Criada com sucesso!');
    }

    public function put(putRequest $request, $id)
    {
        ViaturaService::put($request, $id);

        session()->flash('title', 'Viatura');
        return to_route('viatura.list')->with('success-message', 'Actualizada com sucesso!');
    }

    public function putAlocar(storeAlocarRequest $request, $id)
    {
        ViaturaService::putAlocar($request, $id);

        session()->flash('title', 'Alocação da Viatura');
        return to_route('viatura.alocar.list')->with('success-message', 'Actualizada com sucesso!');
    }

    public function putDocs(putDocsRequest $request, $id)
    {
        ViaturaService::putDocs($request, $id);

        session()->flash('title', 'Documentos da Viatura');
        return to_route('viatura.list')->with('success-message', 'Actualizados com sucesso!');
    }

    public function delete($id)
    {
        ViaturaService::delete($id);

        session()->flash('title', 'Viatura');
        return back()->with('success-message', 'Eliminada com sucesso!');
    }

    public function deleteAlocar($id)
    {
        ViaturaService::deleteAlocar($id);

        session()->flash('title', 'Alocação da Viatura');
        return back()->with('success-message', 'Eliminada com sucesso!');
    }

    public function index()
    {
        return view('viatura.index', [
            'viaturas' => ViaturaService::index(),
            'anexos' => ViaturaService::files(),
        ]);
    }

    public function indexAlocar()
    {
        return view('viatura.index-alocar', [
            'alocacoes' => ViaturaService::indexAlocacao(),
            'rotas_motorista' => ViaturaService::indexRotasAlocacao(),
            'rotas' => RotasService::index(),
            'viaturas' => ViaturaService::index(),
            'motoristas' => MotoristaService::index(),
        ]);
    }

    public function indexHistorico()
    {
        return view('viatura.index-alocar', [
            'alocacoes' => ViaturaService::indexHistorico(),
            'rotas_motorista' => ViaturaService::indexRotasAlocacao(),
            'rotas' => RotasService::index(),
            'viaturas' => ViaturaService::index(),
            'motoristas' => MotoristaService::index(),
        ]);
    }
}
