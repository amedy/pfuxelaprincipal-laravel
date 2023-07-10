<?php

namespace Database\Seeders;

use App\Models\Submenu_Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Submenu_RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $submenus = DB::table('submenu')->get();

        foreach ($submenus as $submenu) {
            Submenu_Role::create([
                'submenu_id' => $submenu->id,
                'role_id' => 1,
                'created_by' => 1,
                'created_at' => now(),
            ]);
        }
    }
}
