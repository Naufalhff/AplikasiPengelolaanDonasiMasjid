<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['roles' => 'admin'],
            ['roles' => 'bendahara'],
            ['roles' => 'pengurus_masjid'],
            ['roles' => 'user_biasa'],
        ]);
    }
}
