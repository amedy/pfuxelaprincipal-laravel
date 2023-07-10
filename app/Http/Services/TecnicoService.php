<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class TecnicoService
{
    public static function index()
    {
        return DB::table('tecnico')
                        ->join('tecnico_especialidade', 'especialidade_id', '=', 'tecnico_especialidade.id')
                        ->join('pessoa', 'pessoa_id', '=', 'pessoa.id')
                        ->join('genero', 'genero_id', '=', 'genero.id')
                        ->leftJoin('estado_civil', 'estado_civil_id', '=', 'estado_civil.id')
                        ->join('tipo_documento', 'tipo_documento_id', '=', 'tipo_documento.id')
                        ->whereNull('tecnico.deleted_at')
                        ->select([
                            'tecnico.*',
                            'tecnico_especialidade.nome as especialidade',
                            'pessoa.nome',
                            'pessoa.apelido',
                            'pessoa.data_nascimento',
                            'pessoa.genero_id',
                            'pessoa.estado_civil_id',
                            'pessoa.tipo_documento_id',
                            'pessoa.numero_documento',
                            'pessoa.nuit',
                            'pessoa.inss',
                            'pessoa.morada',
                            'pessoa.contacto',
                            'pessoa.contacto_alt',
                            'genero.nome as genero',
                            'estado_civil.nome as estado_civil',
                            'tipo_documento.nome as tipo_documento',
                        ])
                        ->get();
    }

    public static function get($id)
    {
        return DB::table('tecnico')
                        ->join('tecnico_especialidade', 'especialidade_id', '=', 'tecnico_especialidade.id')
                        ->join('pessoa', 'pessoa_id', '=', 'pessoa.id')
                        ->join('genero', 'genero_id', '=', 'genero.id')
                        ->leftJoin('estado_civil', 'estado_civil_id', '=', 'estado_civil.id')
                        ->join('tipo_documento', 'tipo_documento_id', '=', 'tipo_documento.id')
                        ->where('tecnico.id', Crypt::decrypt($id))
                        ->whereNull('tecnico.deleted_at')
                        ->select([
                            'tecnico.*',
                            'tecnico_especialidade.nome as especialidade',
                            'pessoa.nome',
                            'pessoa.apelido',
                            'pessoa.data_nascimento',
                            'pessoa.genero_id',
                            'pessoa.estado_civil_id',
                            'pessoa.tipo_documento_id',
                            'pessoa.numero_documento',
                            'pessoa.nuit',
                            'pessoa.inss',
                            'pessoa.morada',
                            'pessoa.contacto',
                            'pessoa.contacto_alt',
                            'genero.nome as genero',
                            'estado_civil.nome as estado_civil',
                            'tipo_documento.nome as tipo_documento',
                        ])
                        ->first();
    }

    public static function store($request)
    {
        $pessoa = DB::table('pessoa')
                ->insertGetId([
                    'nome' => $request->nome,
                    'apelido' => $request->apelido,
                    'data_nascimento' => date('Y-m-d', strtotime($request->data_de_nascimento)),
                    'genero_id' => $request->genero,
                    'estado_civil_id' => $request->estado_civil,
                    'tipo_documento_id' => $request->documento,
                    'numero_documento' => $request->numero_documento,
                    'categoria_id' => 2,
                    'contacto' => $request->contacto,
                    'contacto_alt' => $request->contacto_alternativo,
                    'created_by' => Auth::user()->id,
                    'created_at' => now(),
                ]);

        DB::table('tecnico')
                ->insert([
                    'pessoa_id' => $pessoa,
                    'especialidade_id' => $request->especialidade,
                    'created_by' => Auth::user()->id,
                    'created_at' => now(),
                ]);
    }

    public static function put($request, $id)
    {

        $tecnico = DB::table('tecnico')->where('id', Crypt::decrypt($id))->first();
        DB::table('pessoa')
                ->where('id', $tecnico->pessoa_id)
                ->update([
                    'nome' => $request->nome,
                    'apelido' => $request->apelido,
                    'data_nascimento' => date('Y-m-d', strtotime($request->data_de_nascimento)),
                    'genero_id' => $request->genero,
                    'estado_civil_id' => $request->estado_civil,
                    'tipo_documento_id' => $request->documento,
                    'numero_documento' => $request->numero_documento,
                    'contacto' => $request->contacto,
                    'contacto_alt' => $request->contacto_alternativo,
                    'updated_by' => Auth::user()->id,
                    'updated_at' => now(),
                ]);


        DB::table('tecnico')
                ->where('id', Crypt::decrypt($id))
                ->update([
                    'especialidade_id' => $request->especialidade,
                    'created_by' => Auth::user()->id,
                    'created_at' => now(),
                ]);
    }

    public static function delete($id)
    {

        $tecnico = DB::table('tecnico')->where('id', Crypt::decrypt($id))->first();
        DB::table('pessoa')
                    ->where('id', $tecnico->pessoa_id)
                    ->update([
                        'deleted_by' => Auth::user()->id,
                        'deleted_at' => now(),
                    ]);

        DB::table('tecnico')
                    ->where('id', Crypt::decrypt($id))
                    ->update([
                        'deleted_by' => Auth::user()->id,
                        'deleted_at' => now(),
                    ]);
    }

}
