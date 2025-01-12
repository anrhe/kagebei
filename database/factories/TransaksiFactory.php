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
            'Pembelian bahan makanan' => 'pengeluaran',
            'Pembayaran listrik' => 'pengeluaran',
            'Donasi' => 'pemasukan',
            'Uang syukuran' => 'pemasukan',
            'Persembahan' => 'pemasukan',
            'Aksi Dana' => 'pemasukan',
            'Perpuluhan' => 'pemasukan',
            'Persembahan Pendalaman Alkitab' => 'pemasukan',
            'Sampul Sumbangan' => 'pemasukan',
            'Biaya pemeliharaan' => 'pengeluaran',
            'Pembelian peralatan gereja' => 'pengeluaran',
        ];

        $nama = $this->faker->randomKey($transactionTypes);
        $daysAgo = 162;

        return [
            'id' => Str::uuid(),
            'id_gereja' => Gereja::factory(),
            'nama' => $nama,
            'tipe' => $transactionTypes[$nama],
            'nominal' => $this->faker->randomFloat(2, 500000, 30000000),
            'tanggal' => $this->faker->dateTimeBetween('-' . $daysAgo . ' days', 'now')->format('d-m-Y'),
        ];
    }
}
