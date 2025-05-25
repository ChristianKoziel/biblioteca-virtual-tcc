<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PdfSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pdfs')->insert([
            [
                'title' => 'Laravel Guide',
                'author' => 'Laravel Team',
                'description' => 'A complete guide to Laravel framework.',
                'image_path' => 'images/laravel_guide.jpg',
                'file_path' => 'uploads/laravel_guide.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'PHP Basics',
                'author' => 'PHP Group',
                'description' => 'An introduction to PHP programming.',
                'image_path' => 'images/php_basics.jpg',
                'file_path' => 'uploads/php_basics.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
