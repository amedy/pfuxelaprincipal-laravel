<?php

namespace App\Http\Controllers;

use App\Events\RequisicaoFeita;
use App\Http\Requests\ClientRequisicao\storeRequest;
use App\Http\Services\RequisicaoService;
use Illuminate\Http\Request;

class ClientRequisicaoController extends Controller
{

    public function create($id)
    {
        return view('requisicao.answer', [
        ]);
    }

    public function store(Request $request)
    {
        try {
            $params = RequisicaoService::store($request);

            event(new RequisicaoFeita($params));
            
            return [
                'resposta' => 'successo',
                'msg' => 'Requisição enviada com sucesso!',
            ];
        } catch (\Throwable $th) {
    
            return [
                'resposta' => 'erro',
                'msg' => $th,
            ];
        }
    }
}
