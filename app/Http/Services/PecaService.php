<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PecaService
{
    public static function index()
    {
        return DB::table('peca')
                        ->join('peca_inventario' , 'peca_id', '=', 'peca.id')
                        ->whereNull('peca.deleted_at')
                        ->select([
                            'peca.*',
                            'peca_inventario.quantidade_inicial',
                            'peca_inventario.quantidade_minima',
                            'peca_inventario.quantidade_actual',
                        ])
                        ->get();
    }

    public static function get($id)
    {
        return DB::table('peca')
                        ->join('peca_inventario' , 'peca_id', '=', 'peca.id')
                        ->whereNull('peca.deleted_at')
                        ->where('peca.id', Crypt::decrypt($id))
                        ->select([
                            'peca.*',
                            'peca_inventario.quantidade_inicial',
                            'peca_inventario.quantidade_minima',
                            'peca_inventario.quantidade_actual',
                        ])
                        ->first();
    }

    public static function store($request)
    {
        $codigo = 10000;

        $last_code = DB::table('peca')->latest('codigo')->first();
        if (!empty($last_code)) {
            $codigo = ($last_code->codigo + 1);
        }

        $peca = DB::table('peca')
                        ->insert([
                            'codigo' => $codigo,
                            'designacao' => $request->designacao,
                            'valor' => $request->custo_da_peca,
                            'descricao' => $request->descricao,
                            'created_by' => Auth::user()->id,
                            'created_at' => now(),
                        ]);

        DB::table('peca_inventario')
                        ->insert([
                            'quantidade_inicial' => $request->quantidade_inicial,
                            'quantidade_minima' => $request->quantidade_minima,
                            'quantidade_actual' => $request->quantidade_inicial,
                            'peca_id' => $peca,
                            'created_at' => now(),
                        ]);
    }

    public static function put($request, $id)
    {
        DB::table('peca')
                        ->where('id', Crypt::decrypt($id))
                        ->update([
                                'designacao' => $request->designacao,
                                'valor' => $request->custo_da_peca,
                                'descricao' => $request->descricao,
                                'updated_by' => Auth::user()->id,
                                'updated_at' => now(),
                        ]);

        DB::table('peca_inventario')
                        ->where('peca_id', Crypt::decrypt($id))
                        ->update([
                                'quantidade_minima' => $request->quantidade_minima,
                        ]);
    }

    public static function putInventario($request, $id)
    {
        DB::table('peca_inventario')
                        ->where('id', Crypt::decrypt($id))
                        ->update([
                                'quantidade_inicial' => $request->quantidade_inicial,
                                'quantidade_minima' => $request->quantidade_minima,
                                'quantidade_actual' => $request->quantidade_inicial,
                                'updated_by' => Auth::user()->id,
                                'updated_at' => now(),
                        ]);
    }

    public static function delete($id)
    {
        DB::table('peca')
                        ->where('id', Crypt::decrypt($id))
                        ->update([
                            'deleted_by' => Auth::user()->id,
                            'deleted_at' => now(),
                        ]);

        DB::table('peca_inventario')
                        ->where('peca_id', Crypt::decrypt($id))
                        ->update([
                            'deleted_at' => now(),
                        ]);
    }

    public static function addEntrada($request)
    {
        $peca = PecaService::get(Crypt::encrypt($request->peca));

        $part = [
            'peca' => $peca->designacao,
            'peca_id' => $request->peca,
            'quantidade' => $request->quantidade,
            'preco' => $request->preco,
            'observacao' => $request->observacao,
            'total' => $request->preco * $peca->valor,
        ];

        $count = 0;
        if (Session::has('entradas')) {

            $count = count(Session::get('entradas'));
            foreach (Session::get('entradas') as $key => $entrada) {
                $list[$entrada['peca_id']] = $entrada;

            }
        }

        $list[$request->peca] = $part;

        Session::put('entradas', $list);
        return Session::get('entradas');

    }

    public static function removeEntrada($request)
    {

        $entradas = Session::get('entradas');

        if (count($entradas) == 1) {
            Session::forget('entradas');
        } else {
            unset($entradas[$request->id]);

            Session::put('entradas', $entradas);
        }

    }
}
