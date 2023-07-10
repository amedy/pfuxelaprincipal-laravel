<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

class ProjectoService
{
    public static function index()
    {
        return DB::connection('mysql_c')
                        ->table('clients')
                        ->where('active', 1)
                        ->get();
    }

    public static function countProjectos()
    {
        // return DB::connection('mysql_c')
        //                 ->table('clients')
        //                 ->where('active', 1)
        //                 ->count();
    }
}
