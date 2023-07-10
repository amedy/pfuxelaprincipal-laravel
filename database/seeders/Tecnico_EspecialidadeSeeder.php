<?php

namespace Database\Seeders;

use App\Models\Tecnico_Especialidade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Tecnico_EspecialidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tecnico_Especialidade::create([
            'nome' => 'Mecânico geral'
        ]);

        Tecnico_Especialidade::create([
            'nome' => 'Electrecista'
        ]);
    }
}
