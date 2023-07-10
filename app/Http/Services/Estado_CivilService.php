<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

class Estado_CivilService
{
    public static function index()
    {
        return DB::table('estado_civil')->get();
    }

    
}
