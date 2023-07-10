<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Departamento::create([
            'nome' => 'Piquete'
        ]);
        
        Departamento::create([
            'nome' => 'HST'
        ]);
        
        Departamento::create([
            'nome' => 'Guarita'
        ]);
        
        Departamento::create([
            'nome' => 'Oficina'
        ]);
        
        Departamento::create([
            'nome' => 'Armazém'
        ]);
        
        Departamento::create([
            'nome' => 'Direcção'
        ]);
        
        Departamento::create([
            'nome' => 'Sala de Controle'
        ]);
        
        Departamento::create([
            'nome' => 'Inspecção'
        ]);

    }
}
