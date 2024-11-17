<?php

namespace Database\Seeders;

use App\Models\AsalGereja;
use App\Models\Gereja;
use App\Models\Keanggotaan;
use App\Models\Transaksi;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create Gereja instances
        Gereja::factory(5)->create(); 
        echo "Gereja instances created\n";

        // Create Pengguna instances
        User::factory(10)->create();
        echo "Pengguna instances created\n";

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


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
    }
}
