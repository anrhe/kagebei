<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengumuman>
 */
class PengumumanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'id_pengguna' => User::whereIn('role', ['operator', 'gembala'])->inRandomOrder()->value('id') 
                          ?? User::factory()->state(['role' => $this->faker->randomElement(['operator', 'gembala'])]),
            'judul' => $this->faker->sentence(),
            'isi' => $this->faker->paragraph(),
        ];
    }
}
