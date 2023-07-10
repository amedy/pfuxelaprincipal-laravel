<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

class GeneroService
{
    public static function index()
    {
        return DB::table('genero')->get();
    }
    
    
}
