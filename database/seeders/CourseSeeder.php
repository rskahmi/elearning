<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => '5a6bce43-4821-4a7a-86ea-b9f5c5bdf6c9',
                'nama' => 'Algoritma Pemrograman',
                'deskripsi' => 'Algoritma Pemrograman adalah cabang ilmu komputer yang
                mempelajari cara merancang langkah-langkah logis dan sistematis untuk
                menyelesaikan masalah menggunakan komputer. Materi ini mencakup perancangan
                algoritma, struktur kontrol, pemecahan masalah, dan dasar-dasar logika pemrograman
                sebelum diterapkan dalam bahasa pemrograman.',
                'user_id' => '9212c2a0-c177-11ef-91ae-8aef9f07e607',
                'created_at' =>now() ,
            ],
        ];
        DB::table('course')->insert($data);
    }
}
