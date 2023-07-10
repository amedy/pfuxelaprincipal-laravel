<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class RotasService
{
    public static function index()
    {
        return DB::connection('mysql_c')
                        ->table('routes')
                        ->join('clients', 'id_company', '=', 'clients.id')
                        ->select([
                            'routes.*',
                            'clients.name as projecto',
                        ])
                        ->orderBy('created_at', 'desc')
                        ->get();
    }

    public static function indexNaoAlocadas()
    {
        $rotas_alocadas = [];
        $rotas = DB::table('rota_motorista')->whereNull('rota_motorista.deleted_at')->whereDate('rota_motorista.created_at', date('Y-m-d'))->get();

        foreach ($rotas as $key => $rota) {
            $rotas_alocadas[$key] = $rota->rota_id;
        }

        return DB::connection('mysql_c')
                        ->table('routes')
                        ->join('clients', 'id_company', '=', 'clients.id')
                        ->whereNotIn('routes.id', $rotas_alocadas)
                        ->select([
                            'routes.*',
                            'clients.name as projecto',
                        ])
                        ->orderBy('created_at', 'desc')
                        ->get();
    }

    public static function indexNaoAlocadasExcept($id)
    {
        $rotas_alocadas = [];
        $rotas = DB::table('rota_motorista')->whereNull('rota_motorista.deleted_at')->whereDate('rota_motorista.created_at', date('Y-m-d'))->whereNot('rota_motorista.alocacao_id', Crypt::decrypt($id))->get();

        foreach ($rotas as $key => $rota) {
            $rotas_alocadas[$key] = $rota->rota_id;
        }

        return DB::connection('mysql_c')
                        ->table('routes')
                        ->join('clients', 'id_company', '=', 'clients.id')
                        ->whereNotIn('routes.id', $rotas_alocadas)
                        ->select([
                            'routes.*',
                            'clients.name as projecto',
                        ])
                        ->orderBy('created_at', 'desc')
                        ->get();
    }

    public static function get($id)
    {
        return DB::connection('mysql_c')
                        ->table('routes')
                        ->where('id', $id)
                        ->first();
    }

}
