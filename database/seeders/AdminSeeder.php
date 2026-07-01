<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'mobileno' => '1234567890',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'user_type' => 'admin',
        ]);
    }
}
