<?php

namespace Database\Factories;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class PacienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Paciente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'afiliacion' => random_int(100000000,999999999),
            'nombre' => $this->faker->name(),
            'sexo' => $this->faker->boolean()?'F':'M',
            'nacimiento' => $this->faker->date(),
            'edad' => $this->faker->randomNumber(),
            'alergias' => $this->faker->paragraph(),
            'enfermedades_cronica' => $this->faker->paragraph(),
            'estado_id' => 26,
            'ciudad_id' => 1925,
            'estatus' => $this->faker->boolean()
        ];
    }
}
