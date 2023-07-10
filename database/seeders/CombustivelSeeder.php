<?php

namespace Database\Seeders;

use App\Models\Combustivel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CombustivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Combustivel::create([
            'nome' => 'Diesel',
            'preco' => 87.97,
            'created_by' => 1,
        ]);
        
        Combustivel::create([
            'nome' => 'Gasolina',
            'preco' => 87.97,
            'created_by' => 1,
        ]);
    }
}
