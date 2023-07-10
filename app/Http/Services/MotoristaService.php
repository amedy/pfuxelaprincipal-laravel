<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class MotoristaService
{
    public static function index()
    {
        return DB::table('motorista')
                        ->join('carta_conducao', 'carta_conducao_id', '=', 'carta_conducao.id')
                        ->join('pessoa', 'pessoa_id', '=', 'pessoa.id')
                        ->join('genero', 'genero_id', '=', 'genero.id')
                        ->leftJoin('estado_civil', 'estado_civil_id', '=', 'estado_civil.id')
                        ->join('tipo_documento', 'tipo_documento_id', '=', 'tipo_documento.id')
                        ->whereNull('motorista.deleted_at')
                        ->select([
                            'motorista.*',
                            'carta_conducao.numero',
                            'carta_conducao.data_emissao',
                            'carta_conducao.data_validade',
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

    public static function indexNaoAlocados()
    {
        $motoristas_alocados = [];
        $motoristas = DB::table('viatura_alocacao')->whereNull('viatura_alocacao.deleted_at')->whereDate('viatura_alocacao.created_at', date('Y-m-d'))->get();

        foreach ($motoristas as $key => $motorista) {
            $motoristas_alocados[$key] = $motorista->motorista_id;
        }

        return DB::table('motorista')
                        ->join('carta_conducao', 'carta_conducao_id', '=', 'carta_conducao.id')
                        ->join('pessoa', 'pessoa_id', '=', 'pessoa.id')
                        ->join('genero', 'genero_id', '=', 'genero.id')
                        ->leftJoin('estado_civil', 'estado_civil_id', '=', 'estado_civil.id')
                        ->join('tipo_documento', 'tipo_documento_id', '=', 'tipo_documento.id')
                        ->whereNull('motorista.deleted_at')
                        ->whereNotIn('motorista.id', $motoristas_alocados)
                        ->select([
                            'motorista.*',
                            'carta_conducao.numero',
                            'carta_conducao.data_emissao',
                            'carta_conducao.data_validade',
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

    public static function indexNaoAlocadosExcept($id)
    {
        $motoristas_alocados = [];
        $motoristas = DB::table('viatura_alocacao')->whereNull('viatura_alocacao.deleted_at')->whereDate('viatura_alocacao.created_at', date('Y-m-d'))->whereNot('viatura_alocacao.id', Crypt::decrypt($id))->get();

        foreach ($motoristas as $key => $motorista) {
            $motoristas_alocados[$key] = $motorista->motorista_id;
        }

        return DB::table('motorista')
                        ->join('carta_conducao', 'carta_conducao_id', '=', 'carta_conducao.id')
                        ->join('pessoa', 'pessoa_id', '=', 'pessoa.id')
                        ->join('genero', 'genero_id', '=', 'genero.id')
                        ->leftJoin('estado_civil', 'estado_civil_id', '=', 'estado_civil.id')
                        ->join('tipo_documento', 'tipo_documento_id', '=', 'tipo_documento.id')
                        ->whereNull('motorista.deleted_at')
                        ->whereNotIn('motorista.id', $motoristas_alocados)
                        ->select([
                            'motorista.*',
                            'carta_conducao.numero',
                            'carta_conducao.data_emissao',
                            'carta_conducao.data_validade',
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
        return DB::table('motorista')
                        ->join('carta_conducao', 'carta_conducao_id', '=', 'carta_conducao.id')
                        ->join('pessoa', 'pessoa_id', '=', 'pessoa.id')
                        ->join('genero', 'genero_id', '=', 'genero.id')
                        ->leftJoin('estado_civil', 'estado_civil_id', '=', 'estado_civil.id')
                        ->join('tipo_documento', 'tipo_documento_id', '=', 'tipo_documento.id')
                        ->where('motorista.id', Crypt::decrypt($id))
                        ->whereNull('motorista.deleted_at')
                        ->select([
                            'motorista.*',
                            'carta_conducao.numero',
                            'carta_conducao.data_emissao',
                            'carta_conducao.data_validade',
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
                    'categoria_id' => 1,
                    'contacto' => $request->contacto,
                    'contacto_alt' => $request->contacto_alternativo,
                    'created_by' => Auth::user()->id,
                    'created_at' => now(),
                ]);

        $carta = DB::table('carta_conducao')
                ->insertGetId([
                    'numero' => $request->carta_conducao,
                    'data_emissao' => date('Y-m-d', strtotime($request->data_emissao)),
                    'data_validade' => date('Y-m-d', strtotime($request->data_validade)),
                    'created_at' => now(),
                ]);

        DB::table('motorista')
                ->insert([
                    'pessoa_id' => $pessoa,
                    'carta_conducao_id' => $carta,
                    'created_by' => Auth::user()->id,
                    'created_at' => now(),
                ]);
    }

    public static function put($request, $id)
    {

        $motorista = DB::table('motorista')->where('id', Crypt::decrypt($id))->first();
        DB::table('pessoa')
                ->where('id', $motorista->pessoa_id)
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

        DB::table('motorista')
                ->where('id', Crypt::decrypt($id))
                ->update([
                    'updated_by' => Auth::user()->id,
                    'updated_at' => now(),
                ]);
    }

    public static function putDocs($request, $carta_conducao)
    {
        DB::table('carta_conducao')
                ->where('id', Crypt::decrypt($carta_conducao))
                ->update([
                    'data_emissao' => date('Y-m-d', strtotime($request->data_emissao)),
                    'data_validade' => date('Y-m-d', strtotime($request->data_validade)),
                    'updated_at' => now(),
                ]);

    }

    public static function delete($id)
    {

        $motorista = DB::table('motorista')->where('id', Crypt::decrypt($id))->first();
        DB::table('pessoa')
                    ->where('id', $motorista->pessoa_id)
                    ->update([
                        'deleted_by' => Auth::user()->id,
                        'deleted_at' => now(),
                    ]);

        DB::table('carta_conducao')
                    ->where('id', $motorista->carta_conducao_id)
                    ->update([
                        'deleted_at' => now(),
                    ]);

        DB::table('motorista')
                    ->where('id', Crypt::decrypt($id))
                    ->update([
                        'deleted_by' => Auth::user()->id,
                        'deleted_at' => now(),
                    ]);
    }

}
