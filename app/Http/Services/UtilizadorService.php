<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UtilizadorService
{
    public static function index()
    {
        return DB::table('user')
                        ->leftJoin('pessoa', 'pessoa.id', '=', 'user.pessoa_id')
                        ->leftJoin('genero', 'genero_id', '=', 'genero.id')
                        ->leftJoin('estado_civil', 'estado_civil_id', '=', 'estado_civil.id')
                        ->leftJoin('tipo_documento', 'tipo_documento_id', '=', 'tipo_documento.id')
                        ->join('user_role', 'user_role.user_id', '=', 'user.id')
                        ->join('role', 'role.id', '=', 'user_role.role_id')
                        ->whereNull('user.deleted_at')
                        ->select([
                            'user.*',
                            'user_role.id as user_role_id',
                            'user_role.role_id',
                            'role.nome as role_nome',
                            'pessoa.nome as pessoa_nome',
                            'pessoa.apelido as pessoa_apelido',
                            'pessoa.data_nascimento as pessoa_data_nascimento',
                            'pessoa.genero_id as pessoa_genero',
                            'genero.nome as genero_nome',
                            'pessoa.estado_civil_id as pessoa_estado_civil',
                            'estado_civil.nome as estado_civil_nome',
                            'pessoa.tipo_documento_id as pessoa_tipo_documento',
                            'tipo_documento.nome as tipo_documento_nome',
                            'pessoa.numero_documento as pessoa_numero_documento',
                            'pessoa.categoria_id as pessoa_categoria',
                            'pessoa.departamento_id as pessoa_departamento',
                            'pessoa.nuit as pessoa_nuit',
                            'pessoa.inss as pessoa_inss',
                            'pessoa.morada as pessoa_morada',
                            'pessoa.contacto as pessoa_contacto',
                            'pessoa.contacto_alt as pessoa_contacto_alt',
                        ])
                        ->get();
    }

    public static function countUsers()
    {
        return DB::table('user')
                        ->whereNull('deleted_at')
                        ->count();
    }

    public static function getCurrent()
    {
        return DB::table('user')
                        ->leftJoin('pessoa', 'pessoa.id', '=', 'user.pessoa_id')
                        ->join('user_role', 'user_role.user_id', '=', 'user.id')
                        ->join('role', 'role.id', '=', 'user_role.role_id')
                        ->where('user.id', Auth::user()->id)
                        ->whereNull('user.deleted_at')
                        ->select([
                            'user.*',
                            'role.*',
                            'user_role.*',
                            'pessoa.nome as pessoa_nome',
                            'pessoa.apelido as pessoa_apelido',
                            'pessoa.data_nascimento as pessoa_data_nascimento',
                            'pessoa.genero_id as pessoa_genero',
                            'pessoa.estado_civil_id as pessoa_estado_civil',
                            'pessoa.tipo_documento_id as pessoa_tipo_documento',
                            'pessoa.numero_documento as pessoa_numero_documento',
                            'pessoa.categoria_id as pessoa_categoria',
                            'pessoa.departamento_id as pessoa_departamento',
                            'pessoa.nuit as pessoa_nuit',
                            'pessoa.inss as pessoa_inss',
                            'pessoa.morada as pessoa_morada',
                            'pessoa.contacto as pessoa_contacto',
                            'pessoa.contacto_alt as pessoa_contacto_alt',
                        ])
                        ->first();
    }

    public static function get($id)
    {
        return DB::table('user')
                        ->leftJoin('pessoa', 'pessoa.id', '=', 'user.pessoa_id')
                        ->join('user_role', 'user_role.user_id', '=', 'user.id')
                        ->where('user.id', Crypt::decrypt($id))
                        ->whereNull('user.deleted_at')
                        ->select([
                            'user.*',
                            'user_role.id as user_role_id',
                            'user_role.role_id',
                            'pessoa.nome as pessoa_nome',
                            'pessoa.apelido as pessoa_apelido',
                            'pessoa.data_nascimento as pessoa_data_nascimento',
                            'pessoa.genero_id as pessoa_genero',
                            'pessoa.estado_civil_id as pessoa_estado_civil',
                            'pessoa.tipo_documento_id as pessoa_tipo_documento',
                            'pessoa.numero_documento as pessoa_numero_documento',
                            'pessoa.categoria_id as pessoa_categoria',
                            'pessoa.departamento_id as pessoa_departamento',
                            'pessoa.nuit as pessoa_nuit',
                            'pessoa.inss as pessoa_inss',
                            'pessoa.morada as pessoa_morada',
                            'pessoa.contacto as pessoa_contacto',
                            'pessoa.contacto_alt as pessoa_contacto_alt',
                        ])
                        ->first();
    }

    public static function store($request)
    {
        $user = DB::table('user')
                ->insertGetId([
                    'name' => $request->nome,
                    'email' => $request->email,
                    'password' => Hash::make($request->senha),
                    'active' => 1,
                    'created_by' => Auth::user()->id,
                    'created_at' => now(),
                ]);

        DB::table('user_role')
                ->insert([
                    'user_id' => $user,
                    'role_id' => $request->grupo_de_permissoes,
                    'created_by' => Auth::user()->id,
                    'created_at' => now(),
                ]);
    }

    public static function storeOrPutPessoa($request)
    {
        if (!Auth::user()->pessoa_id) {
            $pessoa = DB::table('pessoa')
                    ->insertGetId([
                        'nome' => $request->nome,
                        'apelido' => $request->apelido,
                        'data_nascimento' => date('Y-m-d', strtotime($request->data_de_nascimento)),
                        'genero_id' => $request->genero,
                        'estado_civil_id' => $request->estado_civil,
                        'tipo_documento_id' => $request->documento,
                        'numero_documento' => $request->numero_documento,
                        'inss' => $request->inss,
                        'nuit' => $request->nuit,
                        'morada' => $request->morada,
                        'contacto' => $request->contacto,
                        'contacto_alt' => $request->contacto_alternativo,
                        'created_by' => Auth::user()->id,
                        'created_at' => now(),
                    ]);

            DB::table('user')
                    ->where('id', Auth::user()->id)
                    ->update([
                        'pessoa_id' => $pessoa,
                        'updated_by' => Auth::user()->id,
                        'updated_at' => now(),
                    ]);
        } else {
            DB::table('pessoa')
                    ->where('id', Auth::user()->pessoa_id)
                    ->update([
                        'nome' => $request->nome,
                        'apelido' => $request->apelido,
                        'data_nascimento' => date('Y-m-d', strtotime($request->data_de_nascimento)),
                        'genero_id' => $request->genero,
                        'estado_civil_id' => $request->estado_civil,
                        'tipo_documento_id' => $request->documento,
                        'numero_documento' => $request->numero_documento,
                        'inss' => $request->inss,
                        'nuit' => $request->nuit,
                        'morada' => $request->morada,
                        'contacto' => $request->contacto,
                        'contacto_alt' => $request->contacto_alternativo,
                        'updated_by' => Auth::user()->id,
                        'updated_at' => now(),
                    ]);
        }
    }

    public static function put($request, $id, $user_role)
    {
        DB::table('user')
                ->where('id', Crypt::decrypt($id))
                ->update([
                    'name' => $request->nome,
                    'email' => $request->email,
                    'updated_by' => Auth::user()->id,
                    'updated_at' => now(),
                ]);


        DB::table('user_role')
                ->where('id', Crypt::decrypt($user_role))
                ->update([
                    'user_id' => Crypt::decrypt($id),
                    'role_id' => $request->grupo_de_permissoes,
                    'updated_by' => Auth::user()->id,
                    'updated_at' => now(),
                ]);
    }

    public static function putPerfil($request)
    {
        if($request->has('senha')) {
            DB::table('user')
                    ->where('id', Auth::user()->id)
                    ->update([
                        'name' => $request->nome,
                        'email' => $request->email,
                        'password' => Hash::make($request->senha),
                        'updated_by' => Auth::user()->id,
                        'updated_at' => now(),
                    ]);
        } else {
            DB::table('user')
                    ->where('id', Auth::user()->id)
                    ->update([
                        'name' => $request->nome,
                        'email' => $request->email,
                        'updated_by' => Auth::user()->id,
                        'updated_at' => now(),
                    ]);
        }
    }

    public static function changeState($id, $state)
    {
        DB::table('user')
                    ->where('id', Crypt::decrypt($id))
                    ->update([
                        'active' => Crypt::decrypt($state),
                    ]);
    }

    public static function delete($id, $user_role)
    {
        DB::table('user')
                    ->where('id', Crypt::decrypt($id))
                    ->update([
                        'active' => 0,
                        'deleted_by' => Auth::user()->id,
                        'deleted_at' => now(),
                    ]);



        DB::table('user_role')
                ->where('id', Crypt::decrypt($user_role))
                ->update([
                    'deleted_by' => Auth::user()->id,
                    'deleted_at' => now(),
                ]);
    }

}
