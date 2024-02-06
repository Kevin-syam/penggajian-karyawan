<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'       => 1,
            'departemen_id' => 1,
            'nip'           => fake()->numberBetween(6111111, 6999999),
            'jenis_kelamin' => 'Pria',
            'waktu_masuk'   => fake()->date('Y-m-d', 'now'),
            'jabatan'       => 'Staf',
            'gaji'          => 3300000,
        ];
    }
}
