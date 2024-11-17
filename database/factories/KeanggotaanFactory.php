<?php

namespace Database\Factories;

use App\Models\Gereja;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Keanggotaan>
 */
class KeanggotaanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tanggalLahir = $this->faker->dateTimeBetween('-70 years', '-18 years'); // Age range 18-60
        $umur = Carbon::parse($tanggalLahir)->age;

        return [
            'id' => Str::uuid(),
            'id_gereja' => Gereja::factory(),
            'nama' => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'kelompok_doa' => $this->faker->randomElement(['1', '2', '3']),
            'tanggal_lahir' => $tanggalLahir,
            'umur' => $umur,
            'pendidikan_terakhir' => $this->faker->randomElement(['Tidak Sekolah','SD', 'SMP','SMA', 'D1', 'D2', 'S1', 'S2', 'S3']),
            'pekerjaan' => $this->faker->jobTitle(),
            'jabatan' => $this->faker->randomElement(['Anggota', 'Pengurus', 'BPG', 'Seksi Acara', 'Seksi Sosial', 'Pengurus Kelompok', 'Diakonis', 'Pengurus Seksi']),
            'status_anggota' => $this->faker->randomElement(['Baptisan', 'Umum']),
            'kategori' => $this->faker->randomElement(['Pria', 'Wanita', 'Lansia', 'Pemuda', 'Remaja', 'Sekolah Minggu', 'Balita', 'Janda/Duda']),
        ];
    }
}
