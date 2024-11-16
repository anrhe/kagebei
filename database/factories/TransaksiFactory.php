<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Gereja;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $transactionTypes = [
            'Pembelian bahan makanan' => 'Pengeluaran',
            'Pembayaran listrik' => 'Pengeluaran',
            'Donasi' => 'Pemasukan',
            'Uang syukuran' => 'Pemasukan',
            'Persembahan' => 'Pemasukan',
            'Aksi Dana' => 'Pemasukan',
            'Perpuluhan' => 'Pemasukan',
            'Persembahan Pendalaman Alkitab' => 'Pemasukan',
            'Sampul Sumbangan' => 'Pemasukan',
            'Biaya pemeliharaan' => 'Pengeluaran',
            'Pembelian peralatan gereja' => 'Pengeluaran',
        ];

        $nama = $this->faker->randomKey($transactionTypes);
        static $daysAgo = 162;

        return [
            'id' => Str::uuid(),
            'id_gereja' => Gereja::factory(),
            'nama' => $nama,
            'tipe' => $transactionTypes[$nama],
            'nominal' => $this->faker->randomFloat(2, 500000, 30000000),
            'created_at' => Carbon::now()->subDays($daysAgo),
            'updated_at' => Carbon::now()->subDays($daysAgo--),
        ];
    }
}
