<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\DiasActividades;
use App\Models\User;
use App\Models\Historial;
use App\Models\Pacientes;
use Illuminate\Support\Facades\Auth;

class ActividadController extends Controller
{
    public function index(){
        date_default_timezone_set('America/Mexico_City');
        $dias = ['0'=>'d','1'=>'l','2'=>'m','3'=>'mi','4'=>'j','5'=>'v','6'=>'s'];
        $paciente = Auth::user();
        $paciente = Pacientes::where('nombre', $paciente->name)->get()[0];
        
        $activity = Historial::where('id_paciente', $paciente->id)->get();
        if (count($activity) > 0) {
            $activity = $activity[count($activity) - 1];
        }

        $activity = collect($activity);
        $activitis = collect();
        $nombres = ['','','Orientacion', 'Atención y Concentración', 'Memoria', 'Funciones Ejecutivas', 'Lenguaje', 'Percepcion'];
        $cont = 0;
        foreach ($activity as $key => $value) {
            $item = collect();
            $campo = $nombres[$cont];
            if (strpos($value, ',')) {
                $buscar = explode(',', $value);
            } else {
                $buscar = [$value];
            }
            for ($i = 0; $i < count($buscar); $i++) {
                $act = Actividad::select('id', 'nombre', 'especializa', 'grado', 'descripcion')->where('especializa', '=', $campo)->where('id', '=', $buscar[$i])->get();

                //return $dias[date('w')];
                if(count($act) > 0 ){
                    $t = $act[0];
                    $contiene = DiasActividades::select('dias')->where('id_actividad',$t->id)->where('id_paciente',$paciente->id)->latest('id')->first();
                    if(str_contains($contiene->dias,$dias[date('w')])){
                        $item->add($act[0]);
                    }

                    //return $act;
                    
                }                
            }
            if(count($item)>0){
                $activitis->add($item[0]);
            }
            
            $cont = $cont + 1;
            if ($cont == 7) {
                break;
            }
        }
        $activity = $activitis;
        return view('Actividades.index',compact('activity'));
    }
    public function registro(Request $request){
        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'required'
        ]);
        $id = Auth::user()->id;
        Actividad::create([
            'nombre' => $request->nombre,
            'especializa' => $request->area,
            'grado' => $request->nivel,
            'id_doctor' => $id,
            'descripcion' => $request->descripcion
        ]);
        return redirect()->route('actividades.index',$id);
    }
    public function buscar($nombre){
        return view('Actividades.'.$nombre);
    }
}
