<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insertOrIgnore([
            [
                'name' => "Admin",
                'slug' => "admin",
                'username' => "admin",
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
                'role' => 'admin'
            ],
            [
                'name' => "Muhammad Rizki",
                'slug' => "muhammad-rizki",
                'username' => "kii",
                'email' => 'rizki@gmail.com',
                'password' => bcrypt('rizki123'),
                'role' => 'user'
            ],
        ]);
    }
}