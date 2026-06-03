<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    // Perintah Robot: Masukkan 3 Kategori sekaligus

    DB::table('categories')->insert([
    [
        'name' => 'Class Meeting',
        'slug' => 'class-meeting',
        'created_at' => now()
    ],
    [
        'name' => 'Pentas Seni (Pensi)',
        'slug' => 'pensi',
        'created_at' => now()
    ],
    [
        'name' => 'Seminar Teknologi',
        'slug' => 'seminar',
        'created_at' => now()
    ],
    ]);
    }
}
