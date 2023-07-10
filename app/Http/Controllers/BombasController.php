<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bombas\putRequest;
use App\Http\Requests\Bombas\storeRefillRequest;
use App\Http\Requests\Bombas\storeRequest;
use App\Http\Services\CombustivelService;
use App\Http\Services\BombasService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BombasController extends HomeController
{
    public function create()
    {
        return view('bombas.create', [
            'combustiveis' => CombustivelService::index(),
        ]);
    }

    public function update($id)
    {
        return view('bombas.update', [
            'bomba' => BombasService::get($id),
            'combustiveis' => CombustivelService::index(),
        ]);
    }

    public function refill($id)
    {
        return view('bombas.refill', [
            'bomba' => BombasService::get($id),
            'combustiveis' => CombustivelService::index(),
        ]);
    }

    public function refillIndex($id)
    {
        return view('bombas.refill-index', [
            'bomba' => BombasService::get($id),
            'reabastecimentos' => BombasService::indexReabstecimentos($id),
        ]);
    }

    public function store(storeRequest $request)
    {
        BombasService::store($request);

        session()->flash('title', 'Bombas');
        return to_route('bombas.list')->with('success-message', 'Criadas com sucesso!');
    }

    public function storeRefill(storeRefillRequest $request, $id)
    {
        BombasService::storeRefill($request, $id);

        session()->flash('title', 'Bombas');
        return to_route('bombas.list')->with('success-message', 'Reabastecidas com sucesso!');
    }

    public function put(putRequest $request, $id)
    {
        BombasService::put($request, $id);

        session()->flash('title', 'Bombas');
        return to_route('bombas.list')->with('success-message', 'Actualizadas com sucesso!');
    }

    public function changeState($id, $state)
    {
        BombasService::changeState($id, $state);

        session()->flash('title', 'Bombas');
        return back()->with('success-message', (Crypt::decrypt($state) == 'Disponível') ? 'Activadas' : 'Desactivadas' .' com sucesso!');
    }

    public function delete($id)
    {
        BombasService::delete($id);

        session()->flash('title', 'Bombas');
        return back()->with('success-message', 'Eliminadas com sucesso!');
    }

    public function index()
    {
        return view('bombas.index', [
            'bombas' => BombasService::index(),
        ]);
    }
}
