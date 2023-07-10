<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

class CombustivelService
{
    public static function index()
    {
        return DB::table('combustivel')->get();
    }

    public static function getPetrol()
    {
        return DB::table('combustivel')->where('nome', 'Gasolina')->first();
    }

    public static function getDiesel()
    {
        return DB::table('combustivel')->where('nome', 'Diesel')->first();
    }

}
