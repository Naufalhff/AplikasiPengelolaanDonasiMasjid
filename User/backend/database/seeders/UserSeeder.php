<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama_lengkap' => 'B-kun',
            'email' => 'b-kun@gmail.com',
            'password' => bcrypt('halohalo123'),
            'role_id' => 4,
        ]);
    }
}
