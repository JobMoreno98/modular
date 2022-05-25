<?php

namespace Database\Factories;

use App\Models\Pacientes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PacientesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pacientes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $array =  ['Normal Alto','Normal','Moderado','Severo'];
        $num = random_int(0,3);
        $genero = ['H','M'];
        
        return [
            'nombre'=>$this->faker->name(),
            'fecha_nacimiento'=> $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'genero'=>$genero[random_int(0,1)],
            'escolaridad'=>'Sin Estudios',
            'enfermedad'=>'Alzhaimer',
            'general'=> $array[$num],
            'enfermedades'=>' ',
            'id_doctor'=> random_int(1,2),
        ];
    }
}
