<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'nama_lengkap' => 'John Doe',
                'email' => 'johndoe@gmail.com',
                'password' => bcrypt('halohalo123'),
                'role_id' => 1,
            ],
            [
                'nama_lengkap' => 'Jane Doe',
                'email' => 'janedoe@gmail.com',
                'password' => bcrypt('halohalo123'),
                'role_id' => 1,
            ],
        ]);
    }
}
