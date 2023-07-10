<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BombasService
{
    public static function index()
    {
        return DB::table('bombas')
                        ->whereNull('deleted_at')
                        ->get();
    }

    public static function indexReabstecimentos($id)
    {
        return DB::table('bombas_abastecimento')
                        ->whereNull('deleted_at')
                        ->where('bombas_id', Crypt::decrypt($id))
                        ->get();
    }

    public static function get($id)
    {
        return DB::table('bombas')
                        ->whereNull('deleted_at')
                        ->where('id', Crypt::decrypt($id))
                        ->first();
    }

    public static function store($request)
    {
        DB::table('bombas')
                    ->insert([
                        'nome' => $request->nome,
                        'tipo' => $request->tipo,
                        'capacidade' => $request->capacidade_das_bombas,
                        'disponivel' => $request->quantidade_disponivel,
                        'minima' => $request->quantidade_minima,
                        'estado' => 'Disponível',
                        'created_by' => Auth::user()->id,
                        'created_at' => now(),
                    ]);

    }

    public static function storeRefill($request, $id)
    {
        $codigo = 10000;

        $last_code = DB::table('bombas_abastecimento')->latest('codigo')->first();
            if (!empty($last_code)) {
                $codigo = ($last_code->codigo + 1);
            }

        DB::table('bombas_abastecimento')
                    ->insert([
                        'referencia' => Str::uuid()->toString(),
                        'codigo' => $codigo,
                        'factura' => $request->factura,
                        'quantidade_anterior' => $request->quantidade_anterior,
                        'quantidade_abastecida' => $request->quantidade,
                        'bombas_id' => Crypt::decrypt($id),
                        'created_by' => Auth::user()->id,
                        'created_at' => now(),
                    ]);

        DB::table('bombas')
                    ->update([
                        'disponivel' => $request->quantidade_anterior + $request->quantidade,
                        'updated_by' => Auth::user()->id,
                        'updated_at' => now(),
                    ]);
    }

    public static function put($request, $id)
    {

        DB::table('bombas')
                    ->where('id', Crypt::decrypt($id))
                    ->update([
                        'nome' => $request->nome,
                        'tipo' => $request->tipo,
                        'capacidade' => $request->capacidade_das_bombas,
                        'disponivel' => $request->quantidade_disponivel,
                        'minima' => $request->quantidade_minima,
                        'updated_by' => Auth::user()->id,
                        'updated_at' => now(),
                    ]);

    }

    public static function changeState($id, $state)
    {
        DB::table('bombas')
                    ->where('id', Crypt::decrypt($id))
                    ->update([
                        'estado' => Crypt::decrypt($state),
                    ]);
    }

    public static function delete($id)
    {
        DB::table('bombas')
                    ->where('id', Crypt::decrypt($id))
                    ->update([
                        'estado' => 'Indisponível',
                        'deleted_by' => Auth::user()->id,
                        'deleted_at' => now(),
                    ]);
    }

}
