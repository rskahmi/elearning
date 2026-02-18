<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 'fe232143-4821-4a7a-86ea-b9f5bdf6c9',
                'file_path' => 'RiskyAhmi-CV.pdf',
                'score' => '80',
                'assignment_id' => '53232143-4821-4a7a-86ea-b9f5bdf6c9',
                'user_id' => '7174b28a-d066-11ee-8bb8-744ca1759434'
            ],
        ];
        DB::table('submissions')->insert($data);
    }
}
