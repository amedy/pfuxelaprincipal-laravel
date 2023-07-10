<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PiqueteService
{
// metodo para visualizar todos dados em tabela
          public static function index()
    {
        return DB::table('plano')

                        ->select([
                            'plano.*'
                        ])
                        ->get();
                  
    }
    // Metodo para buscar dados enquanto podes usar para consulta
     public static function create()
    {
        $motoristas= DB::table('motorista')
                      
                        ->join('pessoa', 'pessoa_id', '=', 'pessoa.id')                
                        ->select( 'motorista.*',
                            'pessoa.nome',
                           
                        )
                        ->get();

                      
                      $rotas= DB::table('rota')
                                
                         ->select( 'rota.*',
                            
                           
                         )
                         ->get();
                         //retornar todas as consultas feitas
                         
                        

                        
  $name_clientes= DB::table('cliente')
                                 
                        ->select( 
                            'cliente.*',
                           
                        )
                        ->get();

                        
                          return['motoristas'=>$motoristas,
                        'rotas'=>$rotas,
                        'name_clientes'=>$name_clientes,

                    ]; 
    }
//metodo para salvar dados para bd
    public static function store($request)
    {

         if ($request->File('file')) {
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/pdf/', $filename);

        }
            
            DB::table('plano') 
                ->insert([
                    'motorista' => $request->motorista,
                    'cliente' => $request->cliente,
                    'local_origem' => $request->local_origem,
                    'local_destino' => $request->local_destino,
                    'data_chegada' => $request->data_chegada,
                    'data_partida' => $request->data_partida,
                    'numero_passageiro' => $request->numero_passageiro,
                    'espe_viatura' => $request->espe_viatura,
                    'km_prevista' => $request->km_prevista,
                    'alocar_viatura' => $request->alocar_viatura,
                    'qtd_combustivel' => $request->qtd_combustivel,
                    'arquivos' => $filename, // Armazena o nome do arquivo no banco de dados
                    'created_at' => now(),
                ]);
            
 
}
//Metodo para buscar um dado pelo ID serve para depois fazer update ou deletar ou consulta
//Nota pode ser id , nome, ou qualquer variavel que atribuste na tabela
 public static function get($id)
    {
        return DB::table('plano')
                        //Crypt::decrypt($id)) serve para descripitografar 
                        ->where('plano.id', Crypt::decrypt($id))
                        
                        ->select([
                            'plano.*', 
                        ])
                        //first=primeiro ou get=pega todos ou last=ultimo sao forma de consulta 
                        ->first();
    }

}
