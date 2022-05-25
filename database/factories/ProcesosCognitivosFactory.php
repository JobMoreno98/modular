<?php

namespace Database\Factories;

use App\Models\Pacientes;
use App\Models\ProcesosCognitivos;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProcesosCognitivosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProcesosCognitivos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $array =  [1,2,3,4];
        $num_t = [];
        for ($i=0; $i < 6; $i++) { 
            $num = random_int(0,3);
            array_push($num_t,$num);
        }
        
        return [
            'id_paciente'=>Pacientes::factory(),
            'orientacion'=>$array[$num_t[0]],
            'atencion_concentracion'=>$array[$num_t[1]],
            'memoria'=>$array[$num_t[2]],
            'funciones_ejecutivas'=>$array[$num_t[3]],
            'lenguaje'=>$array[$num_t[4]],
            'percepcion'=>$array[$num_t[5]],
        ];
    }
}
