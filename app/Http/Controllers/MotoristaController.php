<?php

namespace App\Http\Controllers;

use App\Http\Requests\Motorista\putDocsRequest;
use App\Http\Requests\Motorista\putRequest;
use App\Http\Requests\Motorista\storeRequest;
use App\Http\Services\Estado_CivilService;
use App\Http\Services\GeneroService;
use App\Http\Services\MotoristaService; 
use App\Http\Services\Tipo_DocumentoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MotoristaController extends HomeController
{
    public function create()
    {
        return view('motorista.create', [
            'generos' => GeneroService::index(),
            'documentos' => Tipo_DocumentoService::index(),
            'estados' => Estado_CivilService::index(),
        ]);
    }

    public function update($id)
    {
        return view('motorista.update', [
            'motorista' => MotoristaService::get($id),
            'generos' => GeneroService::index(),
            'documentos' => Tipo_DocumentoService::index(),
            'estados' => Estado_CivilService::index(),
        ]);
    }

    public function updateDocs($id)
    {
        return view('motorista.update-docs', [
            'motorista' => MotoristaService::get($id),
        ]);
    }

    public function store(storeRequest $request)
    {
        MotoristaService::store($request);

        session()->flash('title', 'Motorista');
        return to_route('motorista.list')->with('success-message', 'Criado com sucesso!');
    }

    public function put(putRequest $request, $id)
    {
        MotoristaService::put($request, $id);

        session()->flash('title', 'Motorista');
        return to_route('motorista.list')->with('success-message', 'Actualizado com sucesso!');
    }

    public function putDocs(putDocsRequest $request, $carta_conducao)
    {
        MotoristaService::putDocs($request, $carta_conducao);

        session()->flash('title', 'Carta de condução');
        return to_route('motorista.list')->with('success-message', 'Actualizada com sucesso!');
    }

    public function delete($id)
    {
        MotoristaService::delete($id);

        session()->flash('title', 'Motorista');
        return back()->with('success-message', 'Eliminado com sucesso!');
    }

    public function index()
    {
        return view('motorista.index', [
            'motoristas' => MotoristaService::index()
        ]);
    }
}
