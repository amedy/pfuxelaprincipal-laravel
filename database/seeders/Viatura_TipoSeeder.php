<?php

namespace Database\Seeders;

use App\Models\Viatura_Tipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Viatura_TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Viatura_Tipo::create([
            'nome' => '4x4',
        ]);
        
        Viatura_Tipo::create([
            'nome' => 'Sedan (Ligeiro)',
        ]);
        
        Viatura_Tipo::create([
            'nome' => 'Mini-Bus',
        ]);
        
        Viatura_Tipo::create([
            'nome' => 'Bus',
        ]);
        
        Viatura_Tipo::create([
            'nome' => 'Pick-Up',
        ]);
        
        Viatura_Tipo::create([
            'nome' => 'Camião',
        ]);
    }
}
