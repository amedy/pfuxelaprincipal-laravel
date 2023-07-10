<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ProjectoService;

class ProjectoController extends HomeController
{
    public function create()
    {
        return view('projecto.create', [
        ]);
    }

    public function index()
    {
        return view('projecto.index', [
            'projectos' => ProjectoService::index()
        ]);
    }
}
