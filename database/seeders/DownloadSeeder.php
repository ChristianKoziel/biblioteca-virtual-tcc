<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DownloadSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('downloads')->insert([
            [
                'user_id' => 1, // Admin User
                'pdf_id' => 1, // Laravel Guide
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Test User
                'pdf_id' => 2, // PHP Basics
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
