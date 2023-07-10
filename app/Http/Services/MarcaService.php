<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

class MarcaService
{
    public static function index()
    {
        return DB::table('marca')->get();
    }

    
    
}
