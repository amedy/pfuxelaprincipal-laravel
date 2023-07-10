<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

class Tipo_DocumentoService
{
    public static function index()
    {
        return DB::table('tipo_documento')->get();
    }

    
    
}
