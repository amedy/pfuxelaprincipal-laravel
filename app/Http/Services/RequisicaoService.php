<?php

namespace App\Http\Services;

use App\Mail\RequisicaoRespondida;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class RequisicaoService
{
    public static function get($id)
    {
        return DB::table('requisicao')
                        ->join('cliente', 'requisicao.cliente_id', '=', 'cliente.id')
                        ->whereNull('requisicao.deleted_at')
                        ->where('requisicao.id', Crypt::decrypt($id))
                        ->select([
                                'requisicao.*',
                                'cliente.nome',
                                'cliente.email',
                                'cliente.contacto',
                                'cliente.contacto_alt',
                                ])
                        ->first();
    }

    public static function show($client, $requisicao)
    {
        return DB::table('requisicao')
                        ->join('cliente', 'requisicao.cliente_id', '=', 'cliente.id')
                        ->whereNull('requisicao.deleted_at')
                        ->where('requisicao.id', Crypt::decrypt($requisicao))
                        ->where('cliente.id', Crypt::decrypt($client))
                        ->select([
                                'requisicao.*',
                                'cliente.nome',
                                'cliente.email',
                                'cliente.contacto',
                                'cliente.contacto_alt',
                                ])
                        ->first();
    }

    public static function index()
    {
        return DB::table('requisicao')
                        ->join('cliente', 'requisicao.cliente_id', '=', 'cliente.id')
                        ->whereNull('requisicao.deleted_at')
                        ->select([
                                'requisicao.*',
                                'cliente.nome',
                                'cliente.email',
                                'cliente.contacto',
                                'cliente.contacto_alt',
                                ])
                        ->orderByDesc('requisicao.created_at')
                        ->get();
    }

    public static function count()
    {
        return DB::table('requisicao')
                        ->whereNull('deleted_at')
                        ->where('estado', 'Pendente')
                        ->orderByDesc('created_at')
                        ->count();
    }

    public static function store($request)
    {
        $client = DB::table('cliente')
                            ->insertGetId([
                                'nome' => $request->nome,
                                'email' => $request->email,
                                'contacto' => $request->contacto,
                                'contacto_alt' => $request->contacto_alt,
                                'created_at' => now(),
                            ]);

        $requisicao = DB::table('requisicao')
                    ->insertGetId([
                        'codigo' => date('Ymdhis'),
                        'data_hora_inicio' => $request->data_hora_inicio,
                        'data_hora_fim' => $request->data_hora_fim,
                        'local_origem' => $request->local_origem,
                        'local_destino' => $request->local_destino,
                        'numero_passageiros' => $request->numero_passageiros,
                        'descricao' => $request->descricao,
                        'cliente_id' => $client,
                        'created_at' => now(),
                    ]);
        return [ Crypt::encrypt($client), Crypt::encrypt($requisicao) ];

    }

    public static function send($request, $id)
    {
        $requisicao = RequisicaoService::get($id);
        Mail::to($requisicao->email, $requisicao->nome)->send(new RequisicaoRespondida($request));
    }

    public static function update()
    {
        return DB::table('bombas')->get();
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
