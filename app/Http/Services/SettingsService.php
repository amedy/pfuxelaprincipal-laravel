<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettingsService
{
    public static function storeAppearance($request)
    {
        DB::table('user')
                    ->where('id', Auth::user()->id)
                    ->update([
                        'dark_mode' => (($request->dark_mode == 'on') ? 1 : 0),
                        'updated_by' => Auth::user()->id,
                        'updated_at' => now(),
                    ]);
    }

    public static function store($request)
    {
        DB::table('combustivel')
                    ->where('nome', 'Gasolina')
                    ->update([
                        'preco' => $request->preco_gasolina,
                        'updated_by' => Auth::user()->id,
                        'updated_at' => now(),
                    ]);
        DB::table('combustivel')
                    ->where('nome', 'Diesel')
                    ->update([
                        'preco' => $request->preco_diesel,
                        'updated_by' => Auth::user()->id,
                        'updated_at' => now(),
                    ]);
    }

}
