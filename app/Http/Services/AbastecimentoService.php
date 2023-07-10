<?php

namespace App\Http\Services;

use App\Events\CarFilled;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AbastecimentoService
{
    public static function index()
    {
        return DB::table('ordem')
                        ->join('bombas', 'bombas_id', '=', 'bombas.id')
                        ->whereNull('ordem.deleted_at')
                        ->select([
                            'ordem.*',
                            'bombas.nome',
                        ])
                        ->orderBy('created_at', 'desc')
                        ->get();
    }

    public static function indexTodaysOrders()
    {
        return DB::table('ordem')
                        ->join('bombas', 'bombas_id', '=', 'bombas.id')
                        ->whereNull('ordem.deleted_at')
                        ->whereDate('ordem.created_at', date('Y-m-d'))
                        ->select([
                            'ordem.*',
                            'bombas.nome',
                        ])
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();
    }

    public static function getFuelData()
    {
        $data = [];
        $count = 0;
        for ($i = date('Y-m-01'); $i <= date("Y-m-t"); $i = date('Y-m-d', strtotime($i . '+1 day'))) {
            $orders = DB::table('ordem')->whereNull('deleted_at')->whereDate('ordem.created_at', $i)->where('ordem.estado', 'Autorizada');
            $data[$count] = ($orders->get()) ? $orders->sum('combustivel_total') : 0;

            $count++;
        }

        return $data;
    }

    public static function get($id)
    {
        return DB::table('ordem')
                        ->join('bombas', 'bombas_id', '=', 'bombas.id')
                        ->leftJoin('user as user_created', 'ordem.created_by', '=', 'user_created.id')
                        ->leftJoin('user as user_action', 'ordem.action_by', '=', 'user_action.id')
                        ->whereNull('ordem.deleted_at')
                        ->where('ordem.id', Crypt::decrypt($id))
                        ->select([
                            'ordem.*',
                            'bombas.nome as bombas',
                            'user_created.name as created_by',
                            'user_action.name as action_by',
                        ])
                        ->first();
    }

    public static function getOrdemViatura($id)
    {
        return DB::table('ordem_viatura')
                        ->join('viatura', 'viatura_id', '=', 'viatura.id')
                        ->join('combustivel', 'combustivel_id', '=', 'combustivel.id')
                        ->whereNull('ordem_viatura.deleted_at')
                        ->where('ordem_viatura.ordem_id', Crypt::decrypt($id))
                        ->select([
                            'ordem_viatura.*',
                            'viatura.matricula',
                            'combustivel.nome as combustivel',
                        ])
                        ->get();
    }

    public static function getOrdemRotas($id)
    {
        return DB::table('ordem_rota')
                        ->join('ordem_viatura', 'ordem_viatura_id', '=', 'ordem_viatura.id')
                        ->whereNull('ordem_rota.deleted_at')
                        ->where('ordem_viatura.ordem_id', Crypt::decrypt($id))
                        ->select([
                            'ordem_rota.*',
                        ])
                        ->get();
    }

    public static function retrieveOrdens($id)
    {
        if (!Session::has('ordens')) {
            $orders = DB::table('ordem')
                        ->join('ordem_viatura', 'ordem_id', '=', 'ordem.id')
                        ->whereNull('ordem.deleted_at')
                        ->where('ordem.id', Crypt::decrypt($id))
                        ->select([
                            'ordem.*',
                            'ordem_viatura.viatura_id',
                            'ordem_viatura.combustivel_abastecer',
                            'ordem_viatura.hora_saida',
                            'ordem_viatura.justificacao',
                            'ordem_viatura.preco_total',
                        ])
                        ->get();


            foreach ($orders as $order) {

                $viatura = ViaturaService::get(Crypt::encrypt($order->viatura_id));

                $rotas = DB::table('ordem_viatura')
                    ->join('ordem_rota', 'ordem_viatura_id', '=', 'ordem_viatura.id')
                    ->whereNull('ordem_viatura.deleted_at')
                    ->where('ordem_viatura.ordem_id', Crypt::decrypt($id))
                    ->where('ordem_viatura.viatura_id', $order->viatura_id)
                    ->select([
                        'ordem_rota.rota_id'
                    ])
                    ->get();

                foreach ($rotas as $key => $rota) {
                    $routes[$key] = RotasService::get($rota->rota_id)->name;
                    $routes_ids[$key] = $rota->rota_id;
                }

                $order = [
                    'viatura' => $viatura->matricula,
                    'viatura_id' => $viatura->id,
                    'odometro' => $viatura->odometro,
                    'rotas' => $routes,
                    'rotas_ids' => $routes_ids,
                    'quantidade' => $order->combustivel_abastecer,
                    'distancia' => 0,
                    'hora_saida' => $order->hora_saida,
                    'justificacao' => $order->justificacao,
                    'preco_combustivel' => $order->preco_total/$order->combustivel_abastecer,
                    'total' => $order->preco_total,
                ];

                $list[$viatura->matricula] = $order;
            }

            Session::put('ordens', $list);
        }

        return Session::get('ordens');
    }

    public static function store($request)
    {
        $codigo = 10000;
        $orders = Session::get('ordens');
        $total = 0;

        foreach ($orders as $order) {

            $total = $total + $order['quantidade'];
        }

        $last_code = DB::table('ordem')->latest('codigo')->first();
            if (!empty($last_code)) {
                $codigo = ($last_code->codigo + 1);
            }
            $open_order = DB::table('ordem')->where('tipo', 'Normal')->where('estado', 'Pendente')->where('created_by', Auth::user()->id)->first();
            if (!empty($open_order)) {
                session()->flash('title', 'Abastecimento');
                return back()->with('error-message', 'Existe uma ordem pendente no sistema, por favor verifique antes de tentar novamente!');
            }

        $ordem = DB::table('ordem')->insertGetId([
            'referencia' => Str::uuid()->toString(),
            'codigo' => $codigo,
            'tipo' => 'Normal',
            'estado' => 'Pendente',
            'objectivo' => 'Rota',
            'combustivel_total' => $total,
            'bombas_id' => $request->bombas,
            'created_by' => Auth::user()->id,
            'created_at' => now(),
        ]);


        foreach ($orders as $order) {

            $viatura = DB::table('ordem_viatura')->insertGetId([
                'combustivel_abastecer' => $order['quantidade'],
                'combustivel_estimativa' => $order['combustivel_estimativa'],
                'distancia_estimativa' => $order['distancia_estimada'],
                'distancia_calculada' => $order['distancia_calculada'],
                'periodo' => $order['periodo'],
                'justificacao' => $order['justificacao'],
                'preco_total' => $order['total'],
                'ordem_id' => $ordem,
                'viatura_id' => $order['viatura_id'],
                'created_at' => now(),
            ]);

            foreach ($order['rotas_ids'] as $rota) {
                DB::table('ordem_rota')->insert([
                    'ordem_viatura_id' => $viatura,
                    'rota_id' => $rota,
                    'created_at' => now(),
                ]);
            }
        }

        Session::forget('ordens');
        return Crypt::encrypt($ordem);

    }

    public static function storeExtra($request)
    {
        $codigo = 10000;
        $combustivel = DB::table('viatura')->join('combustivel', 'combustivel_id', '=', 'combustivel.id')->where('viatura.id', $request->viatura)->first();
        $alocacao = DB::table('viatura_alocacao')->where('id', Crypt::decrypt($request->alocacao))->first();
        $total = $combustivel->preco * $request->quantidade;

        $last_code = DB::table('ordem')->latest('codigo')->first();
            if (!empty($last_code)) {
                $codigo = ($last_code->codigo + 1);
            }
            $has_order = DB::table('ordem')->where('tipo', 'Extraordinária')->where('created_by', Auth::user()->id)->where('estado', 'Pendente')->orWhere('estado', 'Autorizada')->whereDate('created_at', date('Y-m-d'))->first();
            if (!empty($has_order)) {
                session()->flash('title', 'Abastecimento Extraordinário');
                return back()->with('error-message', 'Já foi criada uma ordem extraordinária para esta viatura!');
            }

        $ordem = DB::table('ordem')->insertGetId([
            'referencia' => Str::uuid()->toString(),
            'codigo' => $codigo,
            'tipo' => 'Extraordinária',
            'estado' => 'Pendente',
            'objectivo' => $request->objectivo,
            'combustivel_total' => $request->quantidade,
            'destino' => $request->destino,
            'bombas_id' => $request->bombas,
            'created_by' => Auth::user()->id,
            'created_at' => now(),
        ]);

        $viatura = DB::table('ordem_viatura')->insertGetId([
            'combustivel_abastecer' => $request->quantidade,
            'combustivel_estimativa' => $alocacao->combustivel_estimativa,
            'distancia_estimativa' => $request->distancia_estimada,
            'distancia_calculada' => $request->distancia_calculada,
            'periodo' => (date('H:i') < '12:00') ? 'Manhã' : 'Tarde',
            'justificacao' => $request->justificacao,
            'preco_total' => $total,
            'ordem_id' => $ordem,
            'viatura_id' => $request->viatura,
            'created_at' => now(),
        ]);

        if ($request->objectivo  == 'Rota') {
            $rotas = DB::table('rota_motorista')->whereNull('deleted_at')->where('alocacao_id', $alocacao->id)->get();

            foreach ($rotas as $rota) {
                DB::table('ordem_rota')->insert([
                    'ordem_viatura_id' => $viatura,
                    'rota_id' => $rota->rota_id,
                    'created_at' => now(),
                ]);
            }
        }
        return Crypt::encrypt($ordem);

    }

    public static function addOrder($request)
    {
        $viatura = ViaturaService::get(Crypt::encrypt($request->viatura));

        foreach ($request->rotas as $key => $rota) {
            $routes[$key] = RotasService::get($rota)->name;
        }

        $order = [
            'viatura' => $viatura->matricula,
            'viatura_id' => $request->viatura,
            'combustivel_actual' => $viatura->combustivel_disponivel,
            'combustivel_estimativa' => $request->combustivel_estimativa,
            'quantidade' => $request->quantidade,
            'distancia_estimada' => $request->distancia_estimada,
            'distancia_calculada' => $request->distancia_calculada,
            'periodo' => $request->periodo,
            'rotas' => $routes,
            'rotas_ids' => $request->rotas,
            'justificacao' => $request->justificacao,
            'preco_combustivel' => $viatura->combustivel_preco,
            'total' => $request->quantidade * $viatura->combustivel_preco,
        ];

        $count = 0;
        if (Session::has('ordens')) {

            $count = count(Session::get('ordens'));
            foreach (Session::get('ordens') as $key => $ordem) {
                $list[$ordem['viatura_id']] = $ordem;

            }
        }

        $list[$request->viatura] = $order;

        Session::put('ordens', $list);
        return Session::get('ordens');

    }

    public static function removeOrder($request)
    {

        $ordens = Session::get('ordens');

        if (count($ordens) == 1) {
            Session::forget('ordens');
        } else {
            unset($ordens[$request->id]);

            Session::put('ordens', $ordens);
        }

    }

    public static function cancel($id)
    {
        $order = DB::table('ordem')->where('id', Crypt::decrypt($id))->first();
        $station = DB::table('bombas')->where('id', $order->bombas_id)->first();
        $cars = DB::table('ordem_viatura')->where('ordem_id', Crypt::decrypt($id))->get();

        DB::table('bombas')
                        ->where('id', $order->bombas_id)
                        ->update([
                            'disponivel' => ($station->disponivel + $order->combustivel_total),
                            'updated_by' => Auth::user()->id,
                            'updated_at' => now(),
                        ]);

        foreach ($cars as $car) {
            $fuel = DB::table('viatura_estado')->where('viatura_id', $car->viatura_id)->first();

            DB::table('viatura_estado')
                        ->where('viatura_id', $car->viatura_id)
                        ->update([
                            'combustivel_disponivel' => $fuel->combustivel_disponivel - $car->combustivel_abastecer,
                            'updated_by' => Auth::user()->id,
                            'updated_at' => now(),
                        ]);
        }

        DB::table('ordem')
                        ->where('id', Crypt::decrypt($id))
                        ->update([
                            'estado' => 'Cancelada',
                            'action_by' => Auth::user()->id,
                            'action_at' => now(),
                        ]);
    }

    public static function approve($id)
    {
        $order = DB::table('ordem')->where('id', Crypt::decrypt($id))->first();
        $station = DB::table('bombas')->where('id', $order->bombas_id)->first();
        $cars = DB::table('ordem_viatura')->where('ordem_id', Crypt::decrypt($id))->get();

        DB::table('bombas')
                        ->where('id', $order->bombas_id)
                        ->update([
                            'disponivel' => ($station->disponivel > $order->combustivel_total) ? ($station->disponivel - $order->combustivel_total) : 0,
                            'updated_by' => Auth::user()->id,
                            'updated_at' => now(),
                        ]);

        $check = DB::table('bombas')->where('id', $order->bombas_id)->first();

        if ($check->tipo == 'Interna' && $check->disponivel <= $station->minima) {
            event(new CarFilled($station));
        }

        foreach ($cars as $car) {
            $fuel = DB::table('viatura_estado')->where('viatura_id', $car->viatura_id)->first();

            DB::table('viatura_estado')
                        ->where('viatura_id', $car->viatura_id)
                        ->update([
                            'combustivel_disponivel' => $fuel->combustivel_disponivel + $car->combustivel_abastecer,
                            'updated_by' => Auth::user()->id,
                            'updated_at' => now(),
                        ]);
        }

        DB::table('ordem')
                        ->where('id', Crypt::decrypt($id))
                        ->update([
                            'estado' => 'Autorizada',
                            'action_by' => Auth::user()->id,
                            'action_at' => now(),
                        ]);
    }

    public static function delete($id)
    {

        $viaturas = DB::table('ordem_viatura')
                                    ->where('ordem_id', Crypt::decrypt($id))
                                    ->get();

        foreach ($viaturas as $viatura) {
            DB::table('ordem_rota')
                            ->where('ordem_viatura_id', $viatura->id)
                            ->update([
                                'deleted_at' => now(),
                            ]);
        }

        DB::table('ordem_viatura')
                        ->where('ordem_id', Crypt::decrypt($id))
                        ->update([
                            'deleted_at' => now(),
                        ]);

        DB::table('ordem')
                        ->where('id', Crypt::decrypt($id))
                        ->update([
                            'estado' => 'Cancelada',
                            'deleted_by' => Auth::user()->id,
                            'deleted_at' => now(),
                        ]);

    }

}
