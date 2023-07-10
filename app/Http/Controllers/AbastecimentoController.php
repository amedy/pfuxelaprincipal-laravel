<?php

namespace App\Http\Controllers;

use App\Events\OrdemAnswered;
use App\Events\OrdemEnviada;
use App\Http\Requests\Abastecimento\storeExtraRequest;
use App\Http\Requests\Abastecimento\storeRequest;
use App\Http\Services\AbastecimentoService;
use App\Http\Services\BombasService;
use App\Http\Services\MotoristaService;
use App\Http\Services\RotasService;
use App\Http\Services\ViaturaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AbastecimentoController extends HomeController
{
    public function create()
    {
        return view('abastecimento.create', [
            'bombas' => BombasService::index(),
            'viaturas' => ViaturaService::indexAlocadas(),
            'motoristas' => MotoristaService::index(),
            'ordens' => Session::get('ordens'),
            'rotas' => RotasService::index(),
        ]);
    }

    public function createExtra()
    {
        return view('abastecimento.create-extra', [
            'bombas' => BombasService::index(),
            'viaturas' => ViaturaService::index(),
            'motoristas' => MotoristaService::index(),
            'rotas' => RotasService::index(),
        ]);
    }

    public function show($id)
    {
        return view('abastecimento.show', [
            'ordem' => AbastecimentoService::get($id),
            'viaturas' => AbastecimentoService::getOrdemViatura($id),
            'rotas_ordem' => AbastecimentoService::getOrdemRotas($id),
            'rotas' => RotasService::index(),
        ]);
    }

    public function retrieve($id)
    {
        return view('abastecimento.retrieve', [
            'bombas' => BombasService::index(),
            'viaturas' => ViaturaService::index(),
            'motoristas' => MotoristaService::index(),
            'ordem' => AbastecimentoService::get($id),
            'ordens' => AbastecimentoService::retrieveOrdens($id),
        ]);
    }

    public function cancel($id)
    {
        AbastecimentoService::cancel($id);

        event(new OrdemAnswered($id, 'Cancelada'));

        session()->flash('title', 'Ordem de abastecimento');
        return back()->with('success-message', 'Cancelada com sucesso!');
    }

    public function approve($id)
    {
        AbastecimentoService::approve($id);

        event(new OrdemAnswered($id, 'Autorizada'));

        session()->flash('title', 'Ordem de abastecimento');
        return back()->with('success-message', 'Autorizada com sucesso!');
    }

    public function store(storeRequest $request)
    {
        if (!Session::has('ordens')) {
            session()->flash('title', 'Abastecimento');
            return back()->with('error-message', 'Não pode registar sem fazer adicionar pelo menos uma ordem!');
        }

        $order = AbastecimentoService::store($request);
        if (Session::has('error-message')) {
            return back();
        }

        event(new OrdemEnviada($order));

        session()->flash('title', 'Ordem de abastecimento');
        return to_route('abastecimento.list')->with('success-message', 'Criada com sucesso!');
    }

    public function storeExtra(storeExtraRequest $request)
    {
        $order = AbastecimentoService::storeExtra($request);
        if (Session::has('error-message')) {
            return back();
        }

        event(new OrdemEnviada($order));

        session()->flash('title', 'Ordem de abastecimento extraordinário');
        return to_route('abastecimento.list')->with('success-message', 'Criada com sucesso!');
    }

    public function put(storeRequest $request, $id)
    {

        session()->flash('title', 'Ordem de abastecimento');
        return to_route('abastecimento.list')->with('success-message', 'Actualizada com sucesso!');
    }

    public function addOrder(Request $request)
    {
        if (isset(Session::get('ordens')[$request->viatura])) {
            return 'duplicate';
        } else {

            return view('abastecimento.components.order-table', [
                'ordens' => AbastecimentoService::addOrder($request),
            ]);
        }

    }

    public function removeOrder(Request $request)
    {
        AbastecimentoService::removeOrder($request);
    }

    public function getFuelData()
    {
        return AbastecimentoService::getFuelData();
    }

    public function delete($id)
    {
        AbastecimentoService::delete($id);

        session()->flash('title', 'Ordem de abastecimento');
        return back()->with('success-message', 'Eliminada com sucesso!');
    }

    public function getOther(Request $request)
    {
        return view('abastecimento.components.other', [
            'alocacao' => DB::table('viatura_alocacao')->where('viatura_id', $request->id)->whereDate('created_at', date('Y-m-d'))->first(),
        ]);

    }

    public function index()
    {
        return view('abastecimento.index', [
            'ordens' => AbastecimentoService::index()
        ]);
    }
}
