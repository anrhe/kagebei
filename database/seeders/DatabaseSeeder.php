<?php

namespace Database\Seeders;

use App\Models\AsalGereja;
use App\Models\Gereja;
use App\Models\Keanggotaan;
use App\Models\Pengumuman;
use App\Models\Transaksi;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create Gereja instances
        Gereja::factory(5)->create(); 
        echo "Gereja instances created\n";

        $gereja = Gereja::inRandomOrder()->first();

        // Create Pengguna instances
        User::factory()->create([
            'id_gereja' => $gereja->id,
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password123'),
            'remember_token' => Str::random(10),
        ]);
        User::factory()->create([
            'id_gereja' => $gereja->id,
            'name' => 'User',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'password' => Hash::make('password123'),
            'remember_token' => Str::random(10),
        ]);

        User::factory(10)->create();
        echo "Pengguna instances created\n";

        // Create Keanggotaan instances (with relationships)
        $chosenGerejaId = Gereja::inRandomOrder()->value('id');
        // Create Keanggotaan instances (with relationships)
        Keanggotaan::factory(127)->create([
            'id_gereja' => $chosenGerejaId,
        ]);
        echo "Keanggotaan instances created\n";

        // Create Transaksi instances (with relationships), using the same Gereja ID
        Transaksi::factory(163)->create([
            'id_gereja' => $chosenGerejaId, // Use the same $chosenGerejaId
        ]);
        echo "Transaksi instances created\n";

        Pengumuman::factory(15)->create();
        echo "Pengumuman instances created\n";
    }
}
