<?php

namespace App\Http\Controllers;

use App\Http\Requests\Utilizador\putPerfilRequest;
use App\Http\Requests\Utilizador\putRequest;
use App\Http\Requests\Utilizador\storePessoaRequest;
use App\Http\Requests\Utilizador\storeRequest;
use App\Http\Services\Estado_CivilService;
use App\Http\Services\GeneroService;
use App\Http\Services\PermissoesService;
use App\Http\Services\Tipo_DocumentoService;
use App\Http\Services\UtilizadorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UtilizadoresController extends HomeController
{
    public function create()
    {
        return view('utilizador.create', [
            'grupos' => PermissoesService::index(),
        ]);
    }

    public function update($id)
    {
        return view('utilizador.update', [
            'utilizador' => UtilizadorService::get($id),
            'grupos' => PermissoesService::index(),
        ]);
    }

    public function updateProfile($id)
    {
        return view('utilizador.update-profile', [
            'utilizador' => UtilizadorService::get($id),
            'generos' => GeneroService::index(),
            'documentos' => Tipo_DocumentoService::index(),
            'estados' => Estado_CivilService::index(),
        ]);
    }

    public function store(storeRequest $request)
    {
        UtilizadorService::store($request);

        session()->flash('title', 'Utilizador');
        return to_route('utilizador.list')->with('success-message', 'Registado com sucesso!');
    }

    public function storeOrPutPessoa(storePessoaRequest $request)
    {
        UtilizadorService::storeOrPutPessoa($request);

        session()->flash('title', 'Perfil do utilizador');
        return back()->with('success-message', 'Actualizado com sucesso!');
    }

    public function put(putRequest $request, $id, $user_role)
    {
        UtilizadorService::put($request, $id, $user_role);

        session()->flash('title', 'Utilizador');
        return to_route('utilizador.list')->with('success-message', 'Actualizado com sucesso!');
    }

    public function putPerfil(putPerfilRequest $request)
    {
        UtilizadorService::putPerfil($request);

        session()->flash('title', 'Utilizador');
        return back()->with('success-message', 'Actualizado com sucesso!');
    }

    public function changeState($id, $state)
    {
        UtilizadorService::changeState($id, $state);

        session()->flash('title', 'Utilizador');
        return back()->with('success-message', (Crypt::decrypt($state) == 1) ? 'Activado' : 'Desactivado' .' com sucesso!');
    }

    public function delete($id, $user_role)
    {
        UtilizadorService::delete($id, $user_role);

        session()->flash('title', 'Utilizador');
        return back()->with('success-message', 'Eliminado com sucesso!');
    }

    public function index()
    {
        return view('utilizador.index', [
            'utilizadores' => UtilizadorService::index()
        ]);
    }
}
