<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absen>
 */
class AbsenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 2,
            'status' => 'Hadir',
            'keterangan' => null,
            'created_at' => fake()->dateTimeThisMonth(),
            'updated_at' => fake()->dateTimeThisMonth(),
        ];
    }
}
