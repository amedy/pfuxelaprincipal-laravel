<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(Estado_CivilSeeder::class);
        $this->call(Tipo_DocumentoSeeder::class);
        $this->call(GeneroSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(DepartamentoSeeder::class);
        $this->call(CombustivelSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(Viatura_TipoSeeder::class);
        $this->call(SaidaSeeder::class);
        $this->call(Menu_CategoriaSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(SubmenuSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(User_RoleSeeder::class);
        $this->call(Submenu_RoleSeeder::class);
        $this->call(Tecnico_EspecialidadeSeeder::class);
    }
}
