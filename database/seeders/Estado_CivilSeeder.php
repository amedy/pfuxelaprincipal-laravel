<?php

namespace Database\Seeders;

use App\Models\Estado_Civil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Estado_CivilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estado_Civil::create([
        'nome'=>'Solteiro(a)'
        ]);
                    
        Estado_Civil::create([
        'nome'=>'Casado(a)'
        ]);
                    
        Estado_Civil::create([
        'nome'=>'Divorciado(a)'
        ]);
                    
        Estado_Civil::create([
        'nome'=>'Viúvo(a)'
        ]);
    }
}
