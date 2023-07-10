<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class OcorrenciaService
{
    public static function index()
    {
        return DB::table('ocorrencia')
                        ->join('motorista', 'motorista_id', '=', 'motorista.id')
                        ->join('pessoa', 'pessoa_id', '=', 'pessoa.id')
                        ->join('viatura', 'viatura_id', '=', 'viatura.id')
                        ->whereNull('ocorrencia.deleted_at')
                        ->select([
                            'ocorrencia.*',
                            'pessoa.nome as motorista_nome',
                            'pessoa.apelido as motorista_apelido',
                            'viatura.matricula as viatura',
                        ])
                        ->get();
    }

    public static function get($id)
    {
        return DB::table('ocorrencia')
                        ->join('motorista', 'motorista_id', '=', 'motorista.id')
                        ->join('pessoa', 'pessoa_id', '=', 'pessoa.id')
                        ->join('viatura', 'viatura_id', '=', 'viatura.id')
                        ->whereNull('ocorrencia.deleted_at')
                        ->where('ocorrencia.id', Crypt::decrypt($id))
                        ->select([
                            'ocorrencia.*',
                            'pessoa.nome as motorista_nome',
                            'pessoa.apelido as motorista_apelido',
                            'viatura.matricula as viatura',
                        ])
                        ->first();
    }

    public static function store($request)
    {
        $viatura = DB::table('viatura_estado')->where('viatura_id', $request->viatura)->first();

        $ocorrencia = DB::table('ocorrencia')
                        ->insertGetId([
                            'descricao_motorista' => $request->descricao_motorista,
                            'descricao_inspeccao' => $request->descricao_inspeccao,
                            'tipo' => $request->tipo,
                            'data_hora' => $request->data_hora_ocorrencia,
                            'odometro' => $viatura->odometro,
                            'motorista_id' => $request->motorista,
                            'viatura_id' => $request->viatura,
                            'created_by' => Auth::user()->id,
                            'created_at' => now(),
                        ]);
    }

    public static function storeFromMovimento($request, $id)
    {
        $movimento = DB::table('viatura_estado')->where('id', Crypt::decrypt($id))->first();
        $viatura = DB::table('viatura_estado')->where('viatura_id', $request->viatura)->first();

        $ocorrencia = DB::table('ocorrencia')
                        ->insertGetId([
                            'descricao_motorista' => $request->descricao_motorista,
                            'descricao_inspeccao' => $request->descricao_inspeccao,
                            'tipo' => $request->tipo,
                            'data_hora' => $request->data_hora_ocorrencia,
                            'odometro' => $viatura->odometro,
                            'motorista_id' => $movimento->motorista_id,
                            'viatura_id' => $movimento->viatura_id,
                            'movimento_id' => $movimento->id,
                            'created_by' => Auth::user()->id,
                            'created_at' => now(),
                        ]);
    }

    public static function put($request, $id)
    {
        $viatura = DB::table('viatura_estado')->where('viatura_id', $request->viatura)->first();

        DB::table('ocorrencia')
                        ->where('id', Crypt::decrypt($id))
                        ->update([
                                'descricao_motorista' => $request->descricao_motorista,
                                'descricao_inspeccao' => $request->descricao_inspeccao,
                                'tipo' => $request->tipo,
                                'data_hora' => $request->data_hora_ocorrencia,
                                'odometro' => $viatura->odometro,
                                'motorista_id' => $request->motorista,
                                'viatura_id' => $request->viatura,
                                'updated_by' => Auth::user()->id,
                                'updated_at' => now(),
                        ]);
    }

    public static function delete($id)
    {
        DB::table('ocorrencia')
                        ->where('id', Crypt::decrypt($id))
                        ->update([
                            'deleted_by' => Auth::user()->id,
                            'deleted_at' => now(),
                        ]);
    }
}
