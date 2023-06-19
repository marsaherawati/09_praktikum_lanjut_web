<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nim' => $this->faker->randomNumber(9),
            'nama' => $this->faker->word(),
            'kelas' => $this->faker->text(10),
            'jurusan' => $this->faker->text(10),
            'no_handphone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'tanggal_lahir' => $this->faker->date(),
        ];
    }
}
