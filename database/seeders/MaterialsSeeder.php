<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => '532bce43-4821-4a7a-86ea-b9f5c5bdf6c9',
                'title' => 'Materi Pertemuan Pertama',
                'file_path' => 'materi1.pdf',
                'course_id' => '5a6bce43-4821-4a7a-86ea-b9f5c5bdf6c9',
                'created_at' =>now() ,
            ],
        ];
        DB::table('materials')->insert($data);
    }
}
