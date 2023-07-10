<?php

namespace App\Http\Services;

use App\Models\Viatura;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ViaturaService
{
    public static function index()
    {
        return DB::table('viatura')
                        ->join('viatura_estado', 'viatura_id', '=', 'viatura.id')
                        ->join('combustivel', 'combustivel_id', '=', 'combustivel.id')
                        ->join('marca', 'marca_id', '=', 'marca.id')
                        ->join('modelo', 'modelo_id', '=', 'modelo.id')
                        ->join('viatura_tipo', 'tipo_id', '=', 'viatura_tipo.id')
                        ->join('viatura_documento', 'viatura_documento.viatura_id', '=', 'viatura.id')
                        ->whereNull('viatura.deleted_at')
                        ->select([
                            'viatura.*',
                            'viatura_estado.combustivel_disponivel',
                            'viatura_estado.odometro',
                            'viatura_estado.localizacao',
                            'combustivel.nome as combustivel',
                            'marca.nome as marca',
                            'modelo.nome as modelo',
                            'viatura_tipo.nome as tipo',
                            'viatura_documento.inspeccao_emissao as inspeccao_emissao',
                            'viatura_documento.inspeccao_validade as inspeccao_validade',
                            'viatura_documento.manifesto_emissao as manifesto_emissao',
                            'viatura_documento.manifesto_validade as manifesto_validade',
                            'viatura_documento.seguro_emissao as seguro_emissao',
                            'viatura_documento.seguro_validade as seguro_validade',
                            'viatura_documento.taxa_radio_emissao as taxa_radio_emissao',
                            'viatura_documento.taxa_radio_validade as taxa_radio_validade',
                        ])
                        ->get();
    }

    public static function indexNaoAlocadas()
    {
        $viaturas_alocadas = [];
        $viaturas = DB::table('viatura_alocacao')->whereNull('viatura_alocacao.deleted_at')->whereDate('viatura_alocacao.created_at', date('Y-m-d'))->get();

        foreach ($viaturas as $key => $viatura) {
            $viaturas_alocadas[$key] = $viatura->viatura_id;
        }

        return DB::table('viatura')
                        ->join('viatura_estado', 'viatura_id', '=', 'viatura.id')
                        ->join('combustivel', 'combustivel_id', '=', 'combustivel.id')
                        ->join('marca', 'marca_id', '=', 'marca.id')
                        ->join('modelo', 'modelo_id', '=', 'modelo.id')
                        ->join('viatura_tipo', 'tipo_id', '=', 'viatura_tipo.id')
                        ->join('viatura_documento', 'viatura_documento.viatura_id', '=', 'viatura.id')
                        ->whereNull('viatura.deleted_at')
                        ->whereNotIn('viatura.id', $viaturas_alocadas)
                        ->select([
                            'viatura.*',
                            'viatura_estado.combustivel_disponivel',
                            'viatura_estado.odometro',
                            'viatura_estado.localizacao',
                            'combustivel.nome as combustivel',
                            'marca.nome as marca',
                            'modelo.nome as modelo',
                            'viatura_tipo.nome as tipo',
                            'viatura_documento.inspeccao_emissao as inspeccao_emissao',
                            'viatura_documento.inspeccao_validade as inspeccao_validade',
                            'viatura_documento.manifesto_emissao as manifesto_emissao',
                            'viatura_documento.manifesto_validade as manifesto_validade',
                            'viatura_documento.seguro_emissao as seguro_emissao',
                            'viatura_documento.seguro_validade as seguro_validade',
                            'viatura_documento.taxa_radio_emissao as taxa_radio_emissao',
                            'viatura_documento.taxa_radio_validade as taxa_radio_validade',
                        ])
                        ->get();
    }

    public static function indexNaoAlocadasExcept($id)
    {
        $viaturas_alocadas = [];
        $viaturas = DB::table('viatura_alocacao')->whereNull('viatura_alocacao.deleted_at')->whereDate('viatura_alocacao.created_at', date('Y-m-d'))->whereNot('viatura_alocacao.id', Crypt::decrypt($id))->get();

        foreach ($viaturas as $key => $viatura) {
            $viaturas_alocadas[$key] = $viatura->viatura_id;
        }

        return DB::table('viatura')
                        ->join('viatura_estado', 'viatura_id', '=', 'viatura.id')
                        ->join('combustivel', 'combustivel_id', '=', 'combustivel.id')
                        ->join('marca', 'marca_id', '=', 'marca.id')
                        ->join('modelo', 'modelo_id', '=', 'modelo.id')
                        ->join('viatura_tipo', 'tipo_id', '=', 'viatura_tipo.id')
                        ->join('viatura_documento', 'viatura_documento.viatura_id', '=', 'viatura.id')
                        ->whereNull('viatura.deleted_at')
                        ->whereNotIn('viatura.id', $viaturas_alocadas)
                        ->select([
                            'viatura.*',
                            'viatura_estado.combustivel_disponivel',
                            'viatura_estado.odometro',
                            'viatura_estado.localizacao',
                            'combustivel.nome as combustivel',
                            'marca.nome as marca',
                            'modelo.nome as modelo',
                            'viatura_tipo.nome as tipo',
                            'viatura_documento.inspeccao_emissao as inspeccao_emissao',
                            'viatura_documento.inspeccao_validade as inspeccao_validade',
                            'viatura_documento.manifesto_emissao as manifesto_emissao',
                            'viatura_documento.manifesto_validade as manifesto_validade',
                            'viatura_documento.seguro_emissao as seguro_emissao',
                            'viatura_documento.seguro_validade as seguro_validade',
                            'viatura_documento.taxa_radio_emissao as taxa_radio_emissao',
                            'viatura_documento.taxa_radio_validade as taxa_radio_validade',
                        ])
                        ->get();
    }

    public static function indexAlocadasOnly()
    {
        return DB::table('viatura')
                        ->join('viatura_alocacao', 'viatura_id', '=', 'viatura.id')
                        ->whereNull('viatura_alocacao.deleted_at')
                        ->whereDate('viatura_alocacao.created_at', date('Y-m-d'))
                        ->select([
                            'viatura.*',
                        ])
                        ->get();
    }

    public static function indexAlocadas()
    {
        $viaturas_ordens = [];
        $viaturas = DB::table('ordem_viatura')->join('ordem', 'ordem.id', '=', 'ordem_id')->whereNull('ordem_viatura.deleted_at')->whereNot('ordem.estado', 'Cancelada')->whereDate('ordem_viatura.created_at', date('Y-m-d'))->get();

        foreach ($viaturas as $key => $viatura) {
            $viaturas_ordens[$key] = $viatura->viatura_id;
        }
        return DB::table('viatura')
                        ->join('viatura_alocacao', 'viatura_id', '=', 'viatura.id')
                        ->whereNull('viatura_alocacao.deleted_at')
                        ->whereDate('viatura_alocacao.created_at', date('Y-m-d'))
                        ->whereNotIn('viatura.id', $viaturas_ordens)
                        ->select([
                            'viatura.*',
                        ])
                        ->get();
    }

    public static function indexAlocacao()
    {
        return DB::table('viatura_alocacao')
                        ->join('viatura', 'viatura_id', '=', 'viatura.id')
                        ->join('motorista', 'motorista_id', '=', 'motorista.id')
                        ->join('pessoa', 'motorista.pessoa_id', '=', 'pessoa.id')
                        ->whereNull('viatura_alocacao.deleted_at')
                        ->whereDate('viatura_alocacao.created_at', date('Y-m-d'))
                        ->select([
                            'viatura_alocacao.*',
                            'viatura.matricula',
                            'pessoa.nome as motorista_nome',
                            'pessoa.apelido as motorista_apelido',
                        ])
                        ->orderBy('created_at', 'desc')
                        ->get();
    }

    public static function indexHistorico()
    {
        return DB::table('viatura_alocacao')
                        ->join('viatura', 'viatura_id', '=', 'viatura.id')
                        ->join('motorista', 'motorista_id', '=', 'motorista.id')
                        ->join('pessoa', 'motorista.pessoa_id', '=', 'pessoa.id')
                        ->whereNull('viatura_alocacao.deleted_at')
                        ->whereDate('viatura_alocacao.created_at', '<', date('Y-m-d'))
                        ->select([
                            'viatura_alocacao.*',
                            'viatura.matricula',
                            'pessoa.nome as motorista_nome',
                            'pessoa.apelido as motorista_apelido',
                        ])
                        ->get();
    }

    public static function indexRotasAlocacao()
    {
        return DB::table('rota_motorista as rota_motorista')
                            ->whereNull('rota_motorista.deleted_at')
                            // ->whereDate('rota_motorista.created_at', '=', date('Y-m-d'))
                            ->get();
    }

    public static function countViaturas()
    {
        return DB::table('viatura')
                        ->whereNull('viatura.deleted_at')
                        ->count();
    }

    public static function get($id)
    {
        return DB::table('viatura')
                        ->join('viatura_estado', 'viatura_id', '=', 'viatura.id')
                        ->join('combustivel', 'combustivel_id', '=', 'combustivel.id')
                        ->join('marca', 'marca_id', '=', 'marca.id')
                        ->join('modelo', 'modelo_id', '=', 'modelo.id')
                        ->join('viatura_tipo', 'tipo_id', '=', 'viatura_tipo.id')
                        ->join('viatura_documento', 'viatura_documento.viatura_id', '=', 'viatura.id')
                        ->where('viatura.id', Crypt::decrypt($id))
                        ->whereNull('viatura.deleted_at')
                        ->select([
                            'viatura.*',
                            'viatura_estado.combustivel_disponivel',
                            'viatura_estado.odometro',
                            'viatura_estado.localizacao',
                            'combustivel.nome as combustivel',
                            'combustivel.preco as combustivel_preco',
                            'marca.nome as marca',
                            'modelo.nome as modelo',
                            'viatura_tipo.nome as tipo',
                            'viatura_documento.inspeccao_emissao as inspeccao_emissao',
                            'viatura_documento.inspeccao_validade as inspeccao_validade',
                            'viatura_documento.manifesto_emissao as manifesto_emissao',
                            'viatura_documento.manifesto_validade as manifesto_validade',
                            'viatura_documento.seguro_emissao as seguro_emissao',
                            'viatura_documento.seguro_validade as seguro_validade',
                            'viatura_documento.taxa_radio_emissao as taxa_radio_emissao',
                            'viatura_documento.taxa_radio_validade as taxa_radio_validade',
                        ])
                        ->first();
    }

    public static function getAlocacao($id)
    {
        return DB::table('viatura_alocacao')
                        ->join('viatura_estado', 'viatura_alocacao.viatura_id', '=', 'viatura_estado.id')
                        ->join('motorista', 'motorista_id', '=', 'motorista.id')
                        ->join('pessoa', 'pessoa_id', '=', 'pessoa.id')
                        ->where('viatura_alocacao.id', Crypt::decrypt($id))
                        ->whereNull('viatura_alocacao.deleted_at')
                        ->select([
                            'viatura_alocacao.*',
                            'viatura_estado.odometro',
                            'viatura_estado.combustivel_disponivel',
                            'pessoa.nome as motorista_nome',
                            'pessoa.apelido as motorista_apelido',
                        ])
                        ->first();
    }

    public static function getAlocacaoRotas($id)
    {
        $routes = [];
        $rotas = DB::table('rota_motorista')->where('alocacao_id', Crypt::decrypt($id))->whereNull('deleted_at')->get();

        foreach ($rotas as $rota) {
            $routes[$rota->rota_id] = $rota->rota_id;
        }
        return $routes;
    }
    public static function getViaturaInfo($request)
    {
        $rotas = [];
        $id = DB::table('viatura_alocacao')->whereNull('viatura_alocacao.deleted_at')->whereDate('viatura_alocacao.created_at', date('Y-m-d'))->where('viatura_alocacao.viatura_id', $request->id)->select(['viatura_alocacao.*'])->first();
        if ($id) {
            $routes = DB::table('rota_motorista')->whereNull('deleted_at')->whereDate('created_at', date('Y-m-d'))->where('alocacao_id', $id->id)->get();

            foreach ($routes as $key => $route) {
                $rotas[$key] = $route->rota_id;
            }
        }

        return [
                    'odometer' => DB::table('viatura_estado')->where('viatura_id', $request->id)->whereNull('deleted_at')->first()->odometro,
                    'fuel' => DB::table('viatura_estado')->where('viatura_id', $request->id)->whereNull('deleted_at')->first()->combustivel_disponivel,
                    'fuel_efficiency' => DB::table('viatura')->where('id', $request->id)->whereNull('deleted_at')->first()->consumo_medio,
                    'fuel_estimate' => (DB::table('viatura_alocacao')->whereNull('deleted_at')->whereDate('created_at', date('Y-m-d'))->where('viatura_id', $request->id)->first()) ? DB::table('viatura_alocacao')->whereNull('deleted_at')->whereDate('created_at', date('Y-m-d'))->where('viatura_id', $request->id)->first()->combustivel_estimativa : null,
                    'distance_estimate' => (DB::table('viatura_alocacao')->whereNull('deleted_at')->whereDate('created_at', date('Y-m-d'))->where('viatura_id', $request->id)->first()) ? DB::table('viatura_alocacao')->whereNull('deleted_at')->whereDate('created_at', date('Y-m-d'))->where('viatura_id', $request->id)->first()->distancia_estimativa : null,
                    'rotas' => $rotas,
        ];
    }

    public static function getODO($request)
    {
        return DB::table('viatura_estado')
                        ->where('viatura_id', $request->id)
                        ->whereNull('deleted_at')
                        ->first()->odometro;
    }

    public static function getFuel($request)
    {
        return DB::table('viatura_estado')
                        ->where('viatura_id', $request->id)
                        ->whereNull('deleted_at')
                        ->first()->combustivel_disponivel;
    }

    public static function getFuelEfficiency($request)
    {
        return DB::table('viatura')
                        ->where('id', $request->id)
                        ->whereNull('deleted_at')
                        ->first()->consumo_medio;
    }

    public static function files()
    {
        return DB::table('viatura_anexo')
                        ->whereNull('deleted_at')
                        ->get();
    }

    public static function store($request)
    {

        $modelo = DB::table('modelo')
                    ->insertGetId([
                        'nome' => $request->modelo,
                        'marca_id' => $request->marca,
                        'created_by' => Auth::user()->id,
                        'created_at' => now(),
                    ]);

        $car = DB::table('viatura')
                ->insertGetId([
                    'matricula' => $request->matricula,
                    'nr_livrete' => $request->livrete,
                    'nr_motor' => $request->motor,
                    'nr_chassi' => $request->chassi,
                    'ano_fabrico' => $request->ano_de_fabrico,
                    'lotacao' => $request->lotacao,
                    'combustivel_id' => $request->combustivel,
                    'capacidade_tanque' => $request->capacidade_do_tanque,
                    'consumo_medio' => $request->consumo_medio,
                    'odometro_registo' => $request->kilometragem,
                    'descricao' => $request->descricao,
                    'marca_id' => $request->marca,
                    'modelo_id' => $modelo,
                    'tipo_id' => $request->tipo,
                    'created_by' => Auth::user()->id,
                    'created_at' => now(),
                ]);

        DB::table('viatura_estado')
                ->insertGetId([
                    'combustivel_disponivel' => 0,
                    'odometro_anterior' => $request->kilometragem,
                    'odometro' => $request->kilometragem,
                    'localizacao' => 'Dentro',
                    'viatura_id' => $car,
                    'created_at' => now(),
                ]);

        DB::table('viatura_documento')
                ->insertGetId([
                    'inspeccao_emissao' => date('Y-m-d', strtotime($request->inspeccao_data_emissao)),
                    'inspeccao_validade' => date('Y-m-d', strtotime($request->inspeccao_data_validade)),
                    'manifesto_emissao' => date('Y-m-d', strtotime($request->manifesto_data_emissao)),
                    'manifesto_validade' => date('Y-m-d', strtotime($request->manifesto_data_validade)),
                    'seguro_emissao' => date('Y-m-d', strtotime($request->seguro_data_emissao)),
                    'seguro_validade' => date('Y-m-d', strtotime($request->seguro_data_validade)),
                    'taxa_radio_emissao' => date('Y-m-d', strtotime($request->taxa_radio_data_emissao)),
                    'taxa_radio_validade' => date('Y-m-d', strtotime($request->taxa_radio_data_validade)),
                    'viatura_id' => $car,
                    'created_at' => now(),
                ]);

        if ($request->has('anexos')) {
            foreach ($request->anexos as $anexo) {
                $ext = $anexo->getClientOriginalExtension();

                $matricula = str_replace(' ', '', preg_replace('/[\'\@\.\;\" "]+/', '_', addslashes($request->matricula)));
                $filename   = $matricula . '_' . time() . '.' . $ext;
                $url = $anexo->storeAs('storage/anexos/' . $matricula, $filename);
                DB::table('viatura_anexo')
                        ->insert([
                            'nome' => $filename,
                            'ficheiro_tipo' => $ext,
                            'path' => $url,
                            'viatura_id' => $car,
                            'created_at' => now(),
                        ]);
            }
        }

    }

    public static function storeAlocar($request)
    {
        $alocar = DB::table('viatura_alocacao')
                    ->insertGetId([
                        'viatura_id' => $request->viatura,
                        'motorista_id' => $request->motorista,
                        'distancia_estimativa' => $request->distancia,
                        'combustivel_estimativa' => $request->estimativa_combustivel,
                        'created_by' => Auth::user()->id,
                        'created_at' => now(),
                    ]);
        $rotas = $request->rota;

        foreach ($rotas as $rota) {
            DB::table('rota_motorista')
                        ->insert([
                            'rota_id' => $rota,
                            'motorista_id' => $request->motorista,
                            'alocacao_id' => $alocar,
                            'created_by' => Auth::user()->id,
                            'created_at' => now(),
                        ]);
        }
    }

    public static function put($request, $id)
    {
        $exists = DB::table('modelo')->where('id', $request->modelo)->first();
        if (!$exists) {
            $modelo = DB::table('modelo')
                            ->insertGetId([
                                'nome' => $request->modelo,
                                'marca_id' => $request->marca,
                                'created_by' => Auth::user()->id,
                                'created_at' => now(),
                            ]);
        } else {
            $modelo = $request->modelo;
        }

        $car = DB::table('viatura')
                ->where('id', Crypt::decrypt($id))
                ->update([
                    'matricula' => $request->matricula,
                    'nr_livrete' => $request->livrete,
                    'nr_motor' => $request->motor,
                    'nr_chassi' => $request->chassi,
                    'ano_fabrico' => $request->ano_de_fabrico,
                    'lotacao' => $request->lotacao,
                    'combustivel_id' => $request->combustivel,
                    'capacidade_tanque' => $request->capacidade_do_tanque,
                    'consumo_medio' => $request->consumo_medio,
                    'descricao' => $request->descricao,
                    'marca_id' => $request->marca,
                    'modelo_id' => $modelo,
                    'tipo_id' => $request->tipo,
                    'updated_by' => Auth::user()->id,
                    'updated_at' => now(),
                ]);

        if ($request->has('anexos')) {
            foreach ($request->anexos as $anexo) {
                $ext = $anexo->getClientOriginalExtension();

                $matricula = str_replace(' ', '', preg_replace('/[\'\@\.\;\" "]+/', '_', addslashes($request->matricula)));
                $filename   = $matricula . '_' . time() . '.' . $ext;
                $url = $anexo->storeAs('storage/anexos/' . $matricula, $filename);
                DB::table('viatura_anexo')
                        ->insert([
                            'nome' => $filename,
                            'ficheiro_tipo' => $ext,
                            'path' => $url,
                            'viatura_id' => $car,
                            'created_at' => now(),
                        ]);
            }
        }

    }

    public static function putAlocar($request, $id)
    {
        $alocar = DB::table('viatura_alocacao')
                    ->where('id', Crypt::decrypt($id))
                    ->update([
                        'viatura_id' => $request->viatura,
                        'motorista_id' => $request->motorista,
                        'distancia_estimativa' => $request->distancia,
                        'combustivel_estimativa' => $request->estimativa_combustivel,
                        'updated_by' => Auth::user()->id,
                        'updated_at' => now(),
                    ]);
        $rotas = $request->rota;

        DB::table('rota_motorista')
                    ->where('alocacao_id', Crypt::decrypt($id))
                    ->update([
                        'deleted_by' => Auth::user()->id,
                        'deleted_at' => now()
                    ]);

        foreach ($rotas as $rota) {
            $test = DB::table('rota_motorista')->where('alocacao_id', Crypt::decrypt($id))->where('rota_id', $rota)->first();
            if ($test) {
                DB::table('rota_motorista')
                            ->where('alocacao_id', Crypt::decrypt($id))
                            ->where('rota_id', $rota)
                            ->update([
                                'motorista_id' => $request->motorista,
                                'updated_by' => Auth::user()->id,
                                'updated_at' => now(),
                                'deleted_by' => null,
                                'deleted_at' => null,
                            ]);
            } else {
                DB::table('rota_motorista')
                            ->insert([
                                'rota_id' => $rota,
                                'motorista_id' => $request->motorista,
                                'alocacao_id' => $alocar,
                                'created_by' => Auth::user()->id,
                                'created_at' => now(),
                            ]);
            }

        }
    }

    public static function putDocs($request, $id)
    {
        DB::table('viatura_documento')
                ->where('viatura_id', Crypt::decrypt($id))
                ->update([
                    'inspeccao_emissao' => date('Y-m-d', strtotime($request->inspeccao_data_emissao)),
                    'inspeccao_validade' => date('Y-m-d', strtotime($request->inspeccao_data_validade)),
                    'manifesto_emissao' => date('Y-m-d', strtotime($request->manifesto_data_emissao)),
                    'manifesto_validade' => date('Y-m-d', strtotime($request->manifesto_data_validade)),
                    'seguro_emissao' => date('Y-m-d', strtotime($request->seguro_data_emissao)),
                    'seguro_validade' => date('Y-m-d', strtotime($request->seguro_data_validade)),
                    'taxa_radio_emissao' => date('Y-m-d', strtotime($request->taxa_radio_data_emissao)),
                    'taxa_radio_validade' => date('Y-m-d', strtotime($request->taxa_radio_data_validade)),
                    'updated_at' => now(),
                ]);

    }

    public static function delete($id)
    {
        DB::table('viatura_estado')
                    ->where('viatura_id', Crypt::decrypt($id))
                    ->update([
                        'deleted_at' => now(),
                    ]);
        DB::table('viatura_anexo')
                    ->where('viatura_id', Crypt::decrypt($id))
                    ->update([
                        'deleted_at' => now(),
                    ]);
        DB::table('viatura_documento')
                    ->where('viatura_id', Crypt::decrypt($id))
                    ->update([
                        'deleted_at' => now(),
                    ]);

        DB::table('viatura')
                    ->where('id', Crypt::decrypt($id))
                    ->update([
                        'deleted_by' => Auth::user()->id,
                        'deleted_at' => now(),
                    ]);
    }

    public static function deleteAlocar($id)
    {
        DB::table('rota_motorista')
                    ->where('alocacao_id', Crypt::decrypt($id))
                    ->update([
                        'deleted_by' => Auth::user()->id,
                        'deleted_at' => now()
                    ]);

        DB::table('viatura_alocacao')
                    ->where('id', Crypt::decrypt($id))
                    ->update([
                        'deleted_by' => Auth::user()->id,
                        'deleted_at' => now()
                    ]);
    }

    public static function indexTipos()
    {
        return DB::table('viatura_tipo')->get();
    }

}
