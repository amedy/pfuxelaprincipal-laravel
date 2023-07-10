<?php

namespace App\Http\Controllers;

use App\Http\Requests\Peca\putRequest;
use App\Http\Requests\Peca\storeRequest;
use App\Http\Services\PecaService;
use Illuminate\Http\Request;

class PecaController extends HomeController
{
    public function create()
    {
        return view('peca.create', [
        ]);
    }

    public function update($id)
    {
        return view('peca.update', [
            'peca' => PecaService::get($id),
        ]);
    }

    public function store(storeRequest $request)
    {
        PecaService::store($request);

        session()->flash('title', 'Peça');
        return to_route('pecas.list')->with('success-message', 'Registada com sucesso!');
    }

    public function put(putRequest $request, $id)
    {
        PecaService::put($request, $id);

        session()->flash('title', 'Peça');
        return to_route('pecas.list')->with('success-message', 'Actualizada com sucesso!');
    }

    public function delete($id)
    {
        PecaService::delete($id);

        session()->flash('title', 'Peça');
        return back()->with('success-message', 'Eliminada com sucesso!');
    }

    public function index()
    {
        return view('peca.index', [
            'pecas' => PecaService::index()
        ]);
    }
}
