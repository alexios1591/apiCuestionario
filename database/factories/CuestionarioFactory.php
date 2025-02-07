<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\UsuarioRoles;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cuestionario>
 */
class CuestionarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $usuario = Usuario::find(UsuarioRoles::where('CodRol', 2)
            ->inRandomOrder()->first()->CodUsu);

        $opcionesPre13 = [
            'Pareja',
            'Expareja',
            'Familiar',
            'Desconocido',
            'Amigo/a',
            'Compañero/a de trabajo',
            'Vecino/a',
            'Profesor/a',
            'Autoridad (policía, jefe, etc.)',
            'Otro'
        ];

        $opcionesObsPre = [
            'No quiso dar más detalles.',
            'Solicita ayuda psicológica.',
            'Prefiere no hablar del tema.',
            'Indica que ha sido un evento recurrente.',
            'Muestra signos de ansiedad al hablar del tema.',
            'No se sintió cómoda respondiendo.',
            'Ha recibido apoyo de familiares/amigos.',
            'Menciona que ha denunciado el caso.',
            'No desea tomar acciones por el momento.',
            'Otro'
        ];

        return [
            'CodClie' => Cliente::factory()->create()->CodClie,
            'CodUsu' => $usuario->CodUsu,
            'Pre1' => $this->faker->numberBetween(0, 3),
            'Pre2' => $this->faker->numberBetween(0, 3),
            'Pre3' => $this->faker->numberBetween(0, 3),
            'Pre4' => $this->faker->numberBetween(0, 3),
            'Pre5' => $this->faker->numberBetween(0, 3),
            'Pre6' => $this->faker->numberBetween(0, 3),
            'Pre7' => $this->faker->numberBetween(0, 3),
            'Pre8' => $this->faker->numberBetween(0, 3),
            'Pre9' => $this->faker->numberBetween(0, 3),
            'Pre10' => $this->faker->numberBetween(0, 3),
            'Pre11' => $this->faker->numberBetween(1, 9),
            'Pre12' => $this->faker->randomElement(['si', 'no']),
            'Pre13' => function ($attributes) use ($opcionesPre13) {
                return $attributes['Pre12'] === 'si' ? $this->faker->randomElement($opcionesPre13) : null;
            },
            'ObsPre' => $this->faker->randomElement($opcionesObsPre),
            'PunPre' => function ($attributes) {
                return array_sum([
                    $attributes['Pre1'],
                    $attributes['Pre2'],
                    $attributes['Pre3'],
                    $attributes['Pre4'],
                    $attributes['Pre5'],
                    $attributes['Pre6'],
                    $attributes['Pre7'],
                    $attributes['Pre8'],
                    $attributes['Pre9'],
                    $attributes['Pre10'],
                    $attributes['Pre11']
                ]);
            }
        ];
    }
}
