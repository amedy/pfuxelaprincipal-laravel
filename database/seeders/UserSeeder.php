<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@pfuxela.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin@support'),
            'active' => 1,
            'dark_mode' => 0,
            'created_by' => 1,
            'created_at' => now(),
        ]);
    }
}
