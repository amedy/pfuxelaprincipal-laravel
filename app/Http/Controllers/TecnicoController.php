<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tecnico\storeRequest;
use App\Http\Services\Estado_CivilService;
use App\Http\Services\GeneroService;
use App\Http\Services\Tecnico_EspecialidadeService;
use App\Http\Services\TecnicoService;
use App\Http\Services\Tipo_DocumentoService;
use Illuminate\Http\Request;

class TecnicoController extends HomeController
{
    public function create()
    {
        return view('tecnico.create', [
            'generos' => GeneroService::index(),
            'documentos' => Tipo_DocumentoService::index(),
            'estados' => Estado_CivilService::index(),
            'especialidades' => Tecnico_EspecialidadeService::index(),
        ]);
    }

    public function update($id)
    {
        return view('tecnico.update', [
            'tecnico' => TecnicoService::get($id),
            'generos' => GeneroService::index(),
            'documentos' => Tipo_DocumentoService::index(),
            'estados' => Estado_CivilService::index(),
            'especialidades' => Tecnico_EspecialidadeService::index(),
        ]);
    }

    public function store(storeRequest $request)
    {
        TecnicoService::store($request);

        session()->flash('title', 'Técnico');
        return to_route('tecnico.list')->with('success-message', 'Registado com sucesso!');
    }

    public function put(storeRequest $request, $id)
    {
        TecnicoService::put($request, $id);

        session()->flash('title', 'Técnico');
        return to_route('tecnico.list')->with('success-message', 'Actualizado com sucesso!');
    }

    public function delete($id)
    {
        TecnicoService::delete($id);

        session()->flash('title', 'Técnico');
        return back()->with('success-message', 'Eliminado com sucesso!');
    }

    public function index()
    {
        return view('tecnico.index', [
            'tecnicos' => TecnicoService::index()
        ]);
    }
}
