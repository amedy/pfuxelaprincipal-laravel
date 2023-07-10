<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

class Tecnico_EspecialidadeService
{
    public static function index()
    {
        return DB::table('tecnico_especialidade')->get();
    }

}
