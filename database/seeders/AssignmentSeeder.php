<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => '53232143-4821-4a7a-86ea-b9f5bdf6c9',
                'title' => 'Assignment Pertemuan Pertama',
                'description' => 'Silahkan Dikerjakan dengan Deadline yang Sudah Ditentukan !',
                'course_id' => '5a6bce43-4821-4a7a-86ea-b9f5c5bdf6c9',
                'deadline' =>now() ,
            ],
        ];
        DB::table('assignment')->insert($data);
    }
}
