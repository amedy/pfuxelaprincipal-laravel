<?php

namespace Database\Seeders;

use App\Models\Tipo_Documento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Tipo_DocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tipo_Documento::create([
        'nome'=>'BI'
        ]);

        Tipo_Documento::create([
        'nome'=>'Carta de Condução'
        ]);
                   
        Tipo_Documento::create([
        'nome'=>'DIRE'
        ]);
                    
        Tipo_Documento::create([
        'nome'=>'Passaporte'
        ]);
    }
}
