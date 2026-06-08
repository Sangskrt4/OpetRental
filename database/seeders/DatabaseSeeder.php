<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Update Admin (jika sudah ada)
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@opet.com'],
            [
                'name' => 'Admin OPET',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'no_wa' => '08123456789',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}