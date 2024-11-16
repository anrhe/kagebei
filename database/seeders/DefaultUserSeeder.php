<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Gereja;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada data di tabel gereja dengan id = 1
        $gereja = Gereja::firstOrCreate(['id' => 1], [
            'nama' => 'Gereja Default',
            'alamat' => 'Alamat Default', // Sesuaikan kolom lain sesuai struktur tabel gereja
        ]);

        // Tambahkan user default yang terhubung ke id_gereja = 1
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password123'),
                'id_gereja' => $gereja->id, // Pastikan menggunakan id yang ada di tabel gereja
            ]
        );
    }
}
