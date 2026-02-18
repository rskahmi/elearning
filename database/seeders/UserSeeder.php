<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'id' => '7174b28a-d066-11ee-8bb8-744ca1759434',
                'nama' => 'Risky Ahmi',
                'email'=> 'riskyahmad0506@gmail.com',
                'password' => Hash::make('12345678'),
                'role' =>'mahasiswa',
                'created_at' => '2024-03-27 07:43:05',
            ],
            [
                'id' => '9212c2a0-c177-11ef-91ae-8aef9f07e607',
                'nama' => 'Risky Ahmad',
                'email'=> 'dosen@gmail.com',
                'password' => Hash::make('12345678'),
                'role' =>'dosen',
                'created_at' => '2024-03-27 07:43:05',
            ],
        ];
        User::insert($data);
    }
}
