<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\PiqueteService;
use App\Http\Requests\Rpiquete\planoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\RotasService;

class PiqueteController extends HomeController
{
    public function index()
    {
//retornar o metodo Piqueteserve o metodo index
//rpiquete.index o nome da pasta e a pagina rpiquete =pasta e index=pagina
        return view('rpiquete.index', [
            'rpiquetes' => PiqueteService::index()

        ]);
    }
    public function create()
    {
        //$data carregar todas as consulta para a pagina
        $data = PiqueteService::create();
        
        return view('rpiquete.create', $data);

    }

    public function store(planoRequest $request) 
    {
    
       PiqueteService::store($request);

        //session()->flash('title', 'Piquete');
        //emite uma mensagem e volta a pagina depois de salvar
        return to_route('rpiquete.create')->with('success-message', 'Criadas com sucesso!');
    }

//metodo update atravez do id 
 public function update( $id)
    {
        
        return view('rpiquete.piquete_editar', ['rpiquete'=>PiqueteService::get($id)]);
        
        
    }
}
