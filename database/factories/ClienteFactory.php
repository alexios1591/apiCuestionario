<?php

namespace Database\Factories;

use App\Models\Distrito;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'NomClie' => $this->faker->firstName,
            'AppClie' => $this->faker->lastName,
            'ApmClie' => $this->faker->lastName,
            'EmaClie' => $this->faker->unique()->safeEmail,
            'DniClie' => $this->faker->unique()->numerify('########'),
            'FnaClie' => $this->faker->date('Y-m-d', '2003-12-31'),
            'CelClie' => $this->faker->phoneNumber,
            'localidad' => Distrito::inRandomOrder()->first()->distrito,
            'RegClie' => $this->faker->dateTimeBetween('first day of January this year', 'now')
        ];
    }
}
