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
                'nama_lengkap' => 'Unknown',
                'email' => 'unknown@gmail.com',
                'password' => bcrypt('halohalo123'),
                'id_role' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'John Doe',
                'email' => 'johndoe@gmail.com',
                'password' => bcrypt('password123'),
                'id_role' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Jane Smith',
                'email' => 'janesmith@gmail.com',
                'password' => bcrypt('password123'),
                'id_role' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Alice Johnson',
                'email' => 'alicejohnson@gmail.com',
                'password' => bcrypt('password123'),
                'id_role' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Bob Williams',
                'email' => 'bobwilliams@gmail.com',
                'password' => bcrypt('password123'),
                'id_role' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Charlie Davis',
                'email' => 'charliedavis@gmail.com',
                'password' => bcrypt('password123'),
                'id_role' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
