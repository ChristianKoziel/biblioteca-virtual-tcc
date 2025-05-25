<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UploadSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('uploads')->insert([
            [
                'user_id' => 1, // Admin User
                'file_path' => 'uploads/laravel_guide.pdf',
                'title' => 'Laravel Guide',
                'author' => 'Laravel Team',
                'description' => 'A guide uploaded by Admin User.',
                'image_path' => 'images/laravel_guide.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Test User
                'file_path' => 'uploads/php_basics.pdf',
                'title' => 'PHP Basics',
                'author' => 'PHP Group',
                'description' => 'An upload from Test User.',
                'image_path' => 'images/php_basics.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
