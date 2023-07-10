<?php

namespace Database\Seeders;

use App\Models\Saida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Saida::create([
            'nome' => 'Rota',
            'created_at' => now(),
        ]);
        
        Saida::create([
            'nome' => 'Oficina',
            'created_at' => now(),
        ]);
        
        Saida::create([
            'nome' => 'Especial',
            'created_at' => now(),
        ]);
        
        Saida::create([
            'nome' => 'Extraordinário',
            'created_at' => now(),
        ]);
        
        Saida::create([
            'nome' => 'Serviço Administrativo',
            'created_at' => now(),
        ]);
    }
}
