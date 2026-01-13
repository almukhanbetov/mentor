<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'almuko.m@gmail.com'],
            [
                'name' => 'almuko',
                'password' => Hash::make('Zxcvbnm123'),
                'role' => 'admin',
                'is_online' => false,
            ]
        );

        User::factory()->count(5)->create([
            'role' => 'mentor',
            'is_online' => true,
        ]);

        User::factory()->count(10)->create([
            'role' => 'student',
            'is_online' => false,
        ]);
    }
}
