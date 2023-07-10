<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\RotasService;


class RotasController extends HomeController
{

    public function create()
    {
        return view('rotas.create', [
        ]);
    }

    public function index()
    {
        return view('rotas.index', [
            'rotas' => RotasService::index()
        ]);
    }
}
