<?php

namespace App\Http\Controllers;

use App\Http\Services\PecaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InventarioController extends HomeController
{
    public function create()
    {
        return view('inventario.create', [
            'pecas' => PecaService::index(),
            'entradas' => Session::get('entradas'),
        ]);
    }

    public function update($id)
    {
        return view('inventario.update', [
        ]);
    }

    // public function store(storeRequest $request)
    // {
    //     PecaService::store($request);

    //     session()->flash('title', 'Inventário');
    //     return to_route('pecas.list')->with('success-message', 'Registada com sucesso!');
    // }

    // public function put(putRequest $request, $id)
    // {
    //     PecaService::put($request, $id);

    //     session()->flash('title', 'Inventário');
    //     return to_route('pecas.list')->with('success-message', 'Actualizada com sucesso!');
    // }

    public function addOrder(Request $request)
    {

        if (isset(Session::get('entradas')[$request->peca])) {
            return 'duplicate';
        } else {

            return view('inventario.components.pecas-table', [
                'ordens' => PecaService::addEntrada($request),
            ]);
        }

    }

    public function removeEntrada(Request $request)
    {
        PecaService::removeEntrada($request);

    }

    public function delete($id)
    {
        PecaService::delete($id);

        session()->flash('title', 'Inventário');
        return back()->with('success-message', 'Eliminada com sucesso!');
    }

    public function index()
    {
        return view('inventario.index', [
            'pecas' => PecaService::index()
        ]);
    }
}
