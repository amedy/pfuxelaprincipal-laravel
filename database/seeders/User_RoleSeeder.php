<?php

namespace Database\Seeders;

use App\Models\User_Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class User_RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User_Role::create([
            'user_id' => 1,
            'role_id' => 1,
            'created_by' => 1,
            'created_at' => now(),
        ]);
    }
}
