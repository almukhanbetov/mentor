<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create([
            'title' => 'Laravel SaaS',
            'description' => 'Build production SaaS with Laravel 12',
            'price' => 80000,
            'mentor_id' => 2,
            'category' => 'backend',
            'level' => 'middle'
        ]);

        Course::create([
            'title' => 'Go API',
            'description' => 'Realtime API with Gin + PostgreSQL',
            'price' => 70000,
            'mentor_id' => 3,
            'category' => 'backend',
            'level' => 'middle'
        ]);
    }
}
