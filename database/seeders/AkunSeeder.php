<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Akun;
use Illuminate\Support\Facades\Hash;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Akun::create([
            'name' => 'YangMulia',
            'email' => 'tet@gmail.com',
            'password' => Hash::make('admin'),  // Menggunakan Hash::make untuk hashing
            'role' => 'admin',
            'img' => '../public/images/akun/default.jpg'
        ]);
    }
}
