<?php

namespace App\Http\Controllers;

use App\Http\Services\PermissoesService;
use App\Http\Requests\Permissoes\storeRequest;
use App\Http\Requests\Permissoes\putManageRequest;
use App\Http\Services\MenusService;
use Illuminate\Http\Request;

class PermissoesController extends HomeController
{
    public function create()
    {
        return view('permissoes.create', [
        ]);
    }

    public function update($id)
    {
        return view('permissoes.update', [
            'grupo' => PermissoesService::get($id),
        ]);
    }

    public function manage($id)
    {
        return view('permissoes.manage', [
            'grupo' => PermissoesService::get($id),
            'items' => MenusService::indexMenus(),
            'categories' => MenusService::indexCategorias(),
            'subitems' => MenusService::indexSubmenus(),
            'submenu_roles' => MenusService::indexSubmenuRoles($id),
        ]);
    }

    public function store(storeRequest $request)
    {
        PermissoesService::store($request);

        session()->flash('title', 'Grupo de Permissões');
        return to_route('permissoes.list')->with('success-message', 'Registado com sucesso!');
    }

    public function put(storeRequest $request, $id)
    {
        PermissoesService::put($request, $id);

        session()->flash('title', 'Grupo de Permissões');
        return to_route('permissoes.list')->with('success-message', 'Actualizado com sucesso!');
    }

    public function putManage(putManageRequest $request, $id)
    {
        PermissoesService::putManage($request, $id);

        session()->flash('title', 'Grupo de Permissões');
        return to_route('permissoes.list')->with('success-message', 'Actualizado com sucesso!');
    }

    public function delete($id)
    {
        PermissoesService::delete($id);

        session()->flash('title', 'Grupo de Permissões');
        return back()->with('success-message', 'Eliminado com sucesso!');
    }

    public function index()
    {
        return view('permissoes.index', [
            'grupos' => PermissoesService::index()
        ]);
    }
}
