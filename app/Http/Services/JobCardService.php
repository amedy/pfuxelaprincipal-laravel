<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class JobCardService
{
    public static function index()
    {
        return DB::table('job_card')
                        ->leftJoin('ocorrencia', 'ocorrencia_id', '=', 'ocorrencia.id')
                        ->leftJoin('viatura as v1', 'ocorrencia.viatura_id', '=', 'v1.id')
                        ->leftJoin('viatura as v2', 'job_card.viatura_id', '=', 'v2.id')
                        ->whereNull('job_card.deleted_at')
                        ->select([
                            'job_card.*',
                            'ocorrencia.data_hora as data_hora',
                            'v1.matricula as viatura_1',
                            'v2.matricula as viatura_2',
                        ])
                        ->get();
    }

    public static function get($id)
    {
        return DB::table('job_card')
                        ->leftJoin('ocorrencia', 'ocorrencia_id', '=', 'ocorrencia.id')
                        ->leftJoin('viatura as v1', 'ocorrencia.viatura_id', '=', 'v1.id')
                        ->leftJoin('viatura as v2', 'job_card.viatura_id', '=', 'v2.id')
                        ->where('job_card.id', Crypt::decrypt($id))
                        ->whereNull('job_card.deleted_at')
                        ->select([
                            'job_card.*',
                            'ocorrencia.data_hora as data_hora',
                            'v1.matricula as viatura_1',
                            'v2.matricula as viatura_2',
                        ])
                        ->first();
    }

    public static function indexJobs($id)
    {
        return DB::table('job_card_trabalho')
                        ->leftJoin('tecnico as t1', 'tecnico_id', '=', 't1.id')
                        ->leftJoin('pessoa as p1', 't1.pessoa_id', '=', 'p1.id')
                        ->leftJoin('tecnico as t2', 'tecnico_2_id', '=', 't2.id')
                        ->leftJoin('pessoa as p2', 't2.pessoa_id', '=', 'p2.id')
                        ->where('job_card_id', Crypt::decrypt($id))
                        ->whereNull('job_card_trabalho.deleted_at')
                        ->select([
                            'job_card_trabalho.*',
                            'p1.nome as tecnico_nome_1',
                            'p2.nome as tecnico_nome_2',
                            'p1.apelido as tecnico_apelido_1',
                            'p2.apelido as tecnico_apelido_2',
                        ])
                        ->get();
    }

    public static function store($request, $ocorrencia)
    {
        $codigo = 10000;
        $viatura = $request->viatura;

        $last_code = DB::table('job_card')->latest('codigo')->first();
        if (!empty($last_code)) {
            $codigo = ($last_code->codigo + 1);
        }
        if ($ocorrencia) {
            $viatura = DB::table('ocorrencia')->where('id', Crypt::decrypt($ocorrencia))->first()->viatura_id;
        }

        DB::table('job_card')
                ->insert([
                    'referencia' => Str::uuid()->toString(),
                    'codigo' => $codigo,
                    'descricao_diagnostico' => $request->descricao_diagnostico,
                    'causa_avaria' => $request->causa_avaria,
                    'ocorrencia_id' => ($ocorrencia) ? Crypt::decrypt($ocorrencia) : null,
                    'viatura_id' => $viatura,
                    'created_by' => Auth::user()->id,
                    'created_at' => now(),
                ]);
    }

    public static function storeJobs($job)
    {
        $trabalhos = Session::get('jobs');
        foreach ($trabalhos as $trabalho) {
            DB::table('job_card_trabalho')
                    ->insert([
                        'descricao_trabalho' => $trabalho['descricao'],
                        'data_hora_inicio_1' => $trabalho['data_hora_inicio_1'],
                        'data_hora_fim_1' => $trabalho['data_hora_fim_1'],
                        'data_hora_inicio_2' => $trabalho['data_hora_inicio_2'],
                        'data_hora_fim_2' => $trabalho['data_hora_fim_2'],
                        'job_card_id' => Crypt::decrypt($job),
                        'tecnico_id' => $trabalho['tecnico_id'],
                        'tecnico_2_id' => ($trabalho['tecnico_id_2'] == '-') ? null : $trabalho['tecnico_id_2'],
                        'created_by' => Auth::user()->id,
                        'created_at' => now(),
                    ]);
        }
    }

    public static function put($request, $id)
    {
        DB::table('job_card')
                ->where('id', Crypt::decrypt($id))
                ->update([
                    'descricao_diagnostico' => $request->descricao_diagnostico,
                    'causa_avaria' => $request->causa_avaria,
                    'viatura_id' => $request->viatura,
                    'updated_by' => Auth::user()->id,
                    'updated_at' => now(),
                ]);
    }

    public static function delete($id)
    {
        DB::table('job_card')
                    ->where('id', Crypt::decrypt($id))
                    ->update([
                        'deleted_by' => Auth::user()->id,
                        'deleted_at' => now(),
                    ]);

        DB::table('job_card_trabalho')
                    ->where('job_card_id', Crypt::decrypt($id))
                    ->update([
                        'deleted_by' => Auth::user()->id,
                        'deleted_at' => now(),
                    ]);
    }

    public static function addJob($request)
    {
        $tecnico_1 = TecnicoService::get(Crypt::encrypt($request->tecnico_1));
        $tecnico_2 = TecnicoService::get(Crypt::encrypt($request->tecnico_2));

        $trabalho = [
            'descricao' => $request->descricao_trabalho,
            'tecnico_1' => $tecnico_1->nome . ' ' . $tecnico_1->apelido,
            'tecnico_id' => $request->tecnico_1,
            'data_hora_inicio_1' => $request->data_hora_inicio_1,
            'data_hora_fim_1' => $request->data_hora_fim_1,
            'data_hora_inicio_2' => $request->data_hora_inicio_2,
            'data_hora_fim_2' => $request->data_hora_fim_2,
            'tecnico_2' => ($tecnico_2) ? $tecnico_2->nome . ' ' . $tecnico_2->apelido : '-',
            'tecnico_id_2' => ($request->tecnico_2) ? $request->tecnico_2 : '-',
        ];

        $count = 0;
        if (Session::has('jobs')) {

            $count = count(Session::get('jobs'));
            foreach (Session::get('jobs') as $key => $job) {
                $list[$key] = $job;

            }
        }

        $list[$count] = $trabalho;

        Session::put('jobs', $list);
        return Session::get('jobs');
    }

    public static function removeJob($request)
    {
        $jobs = Session::get('jobs');

        if (count($jobs) == 1) {
            Session::forget('jobs');
        } else {
            unset($jobs[$request->id]);

            Session::put('jobs', $jobs);
        }
    }

}
