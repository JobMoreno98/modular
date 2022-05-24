<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pacientes;
use App\Models\User;
use App\Models\Actividad;
use App\Models\Historial;
use App\Models\ProcesosCognitivos;
use App\Models\DiasActividades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class PacientesController extends Controller
{
    public function cuadro(){
        return view('Actividades.cuadros');
    }

    public function index()
    {
        # Se obtiene el id del doctor y se devulven todos los pacientes que posee ese doctor
        $id = Auth::user()->id;
        $pacientes = Pacientes::where('id_doctor', '=', $id)->get();
        return view('Pacientes.index', compact('pacientes'));
    }
    public function create()
    {
        # ruta que nos regresa el formualrio de registro de paciente
        return view('Pacientes.registro');
    }
    public function store(Request $request)
    {
        # Se hace la validacion de 
        $request->validate([
            'nombre' => 'required',
            'fecha_nacimiento' => 'required',
            'enfermedad' => 'required'
        ]);
        $id = Auth::user()->id;
        //return $request;
        $paciente = Pacientes::create([
            'nombre' => $request->nombre,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'genero' => $request->genero,
            'escolaridad' => $request->escolaridad,
            'enfermedad' => $request->enfermedad,
            'enfermedades' => (Arr::exists($request, 'enfermedades')) ?  implode(',', $request->enfermedades) : 'Ninguna',
            'id_doctor' => $id
        ]);

        $id_paciente = $paciente->id;

        ProcesosCognitivos::create([
            'id_paciente' => $id_paciente,
            'orientacion' => $request->orientacion,
            'atencion_concentracion' => $request->atencion_concentarcion,
            'memoria' => $request->memoria,
            'funciones_ejecutivas' => $request->f_ejecutivas,
            'lenguaje' => $request->lenguaje,
            'percepcion' => $request->percepcion,
        ]);

        $usuario = new User();
        $usuario->name = $request->nombre;
        $usuario->tipo = 'paciente';
        $usuario->email = $request->nombre;
        $usuario->password = Hash::make(Auth::user()->name);
        $usuario->save();

        return redirect()->route('pacientes.index', $id);
    }
    public function show(Pacientes $paciente)
    {
        $id = Auth::user()->id;
        $cognicion = ProcesosCognitivos::where('id_paciente', $paciente->id)->orderBy('id', 'desc')->get();
        if (count($cognicion) > 0) {
            $cognicion = $cognicion[0];
        }

        $activity = Historial::where('id_paciente', $paciente->id)->get();
        if (count($activity) > 0) {
            $activity = $activity[count($activity) - 1];
        }

        $activity = collect($activity);
        $activitys = collect();
        $nombres = ['', '', 'Orientacion', 'Atención y Concentración', 'Memoria', 'Funciones Ejecutivas', 'Lenguaje', 'Percepcion'];
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
                $item->add($act);
            }
            $activitys->add($item);
            $cont = $cont + 1;
            if ($cont == 7) {
                break;
            }
        }
        $activity = $activitys;
        return view('Pacientes.show', compact('paciente', 'cognicion', 'activity'));
    }
    public function history(Pacientes $paciente)
    {
        $id = Auth::user()->id;
        $total = ProcesosCognitivos::where('id_paciente', $paciente->id)->get();
        $last = $total[count($total) - 1];
        $first = $total[0];
        $actividades = Historial::where('id_paciente', $paciente->id)->orderBy('id', 'DESC')->get();
        $nombres = ['orientacion', 'atencion_concentracion', 'memoria', 'funciones_ejecutivas', 'lenguaje', 'percepcion'];
        $actividades = collect($actividades);
        $new_actividades = collect();
        foreach ($actividades as $key => $value) {
            $cont = 0;
            $item = collect();
            $value = collect($value);
            foreach ($value as $llave => $valor) {
                $campo = $nombres[$cont];
                if ($llave == $campo) {
                    if (strpos($valor, ',')) {
                        $buscar = explode(',', $valor);
                    } else {
                        $buscar = [$valor];
                    }

                    $cont = $cont + 1;
                    $fecha = $value->get('created_at');
                    for ($i = 0; $i < count($buscar); $i++) {
                        $act = Actividad::select('id', 'nombre', 'especializa', 'grado', 'descripcion')->find($valor);
                        if ($act != Null) {
                            $act = collect($act);
                            $act->push($fecha);
                            $item->add($act);
                        }
                    }
                }
                if ($cont == 6) {
                    $new_actividades->add($item);
                    break;
                }
            }
        }
        //return $new_actividades;
        //return $last;
        return view('Pacientes.historial', compact('paciente', 'total', 'first', 'last', 'new_actividades'));
    }
    public function set_activity(Pacientes $paciente)
    {
        $id = Auth::user()->id;
        $total = ProcesosCognitivos::where('id_paciente', $paciente->id)->get();
        $actividad = $total[count($total) - 1];


        $orientacion = Actividad::where('especializa', '=', 'Orientacion')->where('grado', '>=', $actividad->orientacion)->get();
        $atencion = Actividad::where('especializa', '=', 'Atención y Concentración')->where('grado', '>=', $actividad->atencion_concentracion)->get();
        $memoria = Actividad::where('especializa', '=', 'Memoria')->where('grado', '>=', $actividad->memoria)->get();
        $funciones = Actividad::where('especializa', '=', 'Funciones Ejecutivas')->where('grado', '>=', $actividad->funciones_ejecutivas)->get();
        $lenguaje = Actividad::where('especializa', '=', 'Lenguaje')->where('grado', '>=', $actividad->lenguaje)->get();
        $percepcion = Actividad::where('especializa', '=', 'Percepcion')->where('grado', '>=', $actividad->percepcion)->get();

        $actividades = [
            'Orientacion' => $orientacion, 'Atención y Concentracion' => $atencion, 'Memoria' => $memoria,
            'Funciones Ejecutivas' => $funciones, 'Lenguaje' => $lenguaje, 'Percepción' => $percepcion
        ];

        return view('Pacientes.actividades', compact('paciente', 'actividades', 'actividad'));
    }
    public function activity_select(Request $request, Pacientes $paciente)
    {
        $request->validate([
            'aceptar' => 'required'
        ]);
        $actividades = collect();
        $n_actividades = [
            'Orientacion' => $request->orientacion, 'Atención y Concentracion' => $request->atencion_concentracion, 'Memoria' => $request->memoria,
            'Funciones Ejecutivas' => $request->funciones_ejecutivas, 'Lenguaje' => $request->lenguaje, 'Percepción' => $request->percepcion
        ];
        foreach ($n_actividades as $key => $valores) {
            if ($valores != null) {
                foreach ($valores as $llaves => $item) {
                    $actividades->add(Actividad::select('id','nombre','especializa')->where('id','=',$item)->get()[0]);
                }
            }
        }

        return view('pacientes.seleccion_dia')->with('paciente', $paciente)->with('actividades', $actividades);
    }
    public function register(Request $request, Pacientes $paciente){
        $request->validate([
            'aceptar' => 'required'
        ]);
        $valores = $request->except(['_token','aceptar']);
        $actividades = [
            'Orientacion' => [], 'Atención y Concentración' => [], 'Memoria' => [],
            'Funciones Ejecutivas' => [], 'Lenguaje' => [], 'Percepción' => []
        ];
        foreach ($valores as $llave => $key){
            $temp = Actividad::select('id','especializa')->where('id','=',$llave)->get()[0];
            echo $temp->especializa;
            array_push($actividades[$temp->especializa],$temp->id);
        }

        $id_doctor = Auth::user()->id;
        $id = $paciente->id;
        $h = Historial::create([
            'id_paciente' => $id,
            'orientacion' => (Arr::exists($actividades, 'Orientacion')) ? implode(',', $actividades['Orientacion']) : '',
            'atencion_concentracion' => (Arr::exists($actividades, 'Atención y Concentración')) ? implode(',', $actividades['Atención y Concentración']) : '',
            'memoria' => (Arr::exists($actividades, 'Memoria')) ? implode(',', $actividades['Memoria']) : '',
            'funciones_ejecutivas' => (Arr::exists($actividades, 'Funciones Ejecutivas')) ? implode(',', $actividades['Funciones Ejecutivas']) : '',
            'lenguaje' => (Arr::exists($actividades, 'Lenguaje')) ? implode(',', $actividades['Lenguaje']) : '',
            'percepcion' => (Arr::exists($actividades, 'Percepción')) ? implode(',', $actividades['Percepción']) : ''
        ]);
        foreach ($valores as $llave => $key){
            DiasActividades::create([
                'id_paciente' => $paciente->id,
                'id_actividad' => $llave,
                'id_historial' => $h->id,
                'dias' => implode(',', $key)
            ]);
        }

        //return True;
        return Redirect()->route('pacientes.show', ['id_doctor' => $id_doctor, 'paciente' => $id]);

    }

    public function activity_update(Request $request, Pacientes $paciente)
    {

        $id_doctor = Auth::user()->id;
        $id = $paciente->id;
        Historial::create([
            'id_paciente' => $id,
            'orientacion' => (Arr::exists($request, 'Orientacion')) ? implode(',', $request->Orientacion) : '',
            'atencion_concentracion' => (Arr::exists($request, 'Atención_y_Concentracion')) ? implode(',', $request->Atención_y_Concentracion) : '',
            'memoria' => (Arr::exists($request, 'Memoria')) ? implode(',', $request->Memoria) : '',
            'funciones_ejecutivas' => (Arr::exists($request, 'Funciones_Ejecutivas')) ? implode(',', $request->Funciones_Ejecutivas) : '',
            'lenguaje' => (Arr::exists($request, 'Lenguaje')) ? implode(',', $request->Lenguaje) : '',
            'percepcion' => (Arr::exists($request, 'Percepcion')) ? implode(',', $request->Percepcion) : ''
        ]);
        return Redirect()->route('pacientes.show', ['id_doctor' => $id_doctor, 'paciente' => $id]);
    }
    
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $id = Auth::user()->id;
            $pacientes = Pacientes::where($request->buscar_por, 'LIKE', '%' . $request->buscar . '%')->where('id_doctor',Auth::user()->id)->paginate(5);
            return view('Pacientes.plantilla', compact('pacientes'))->render();
        }
        //return response(json_encode($pacientes),200)->header('Content-type','text/plain');
    }
    public function edit(Pacientes $paciente)
    {
        $procesos = ProcesosCognitivos::where('id_paciente', $paciente->id)->limit(1)->get()[0];
        return view('Pacientes.edit', compact('paciente', 'procesos'));
    }
    public function update(Request $request, $id)
    {
        # Se hace la validacion de 
        $request->validate([
            'nombre' => 'required',
            'fecha_nacimiento' => 'required',
            'enfermedad' => 'required'
        ]);
        $id = Auth::user()->id;
        Pacientes::where('id', '=', $id)->update([
            'nombre' => $request->nombre,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'genero' => $request->genero,
            'escolaridad' => $request->escolaridad,
            'enfermedad' => $request->enfermedad,
            'enfermedades' => (sizeof($request->enfermedades) > 0) ? implode(',', $request->enfermedades) : 'Ninguna',
            'id_doctor' => $id
        ]);
        ProcesosCognitivos::create([
            'id_paciente' => $request->id,
            'orientacion' => $request->orientacion,
            'atencion_concentracion' => $request->atencion_concentarcion,
            'memoria' => $request->memoria,
            'funciones_ejecutivas' => $request->f_ejecutivas,
            'lenguaje' => $request->lenguaje,
            'percepcion' => $request->percepcion,
        ]);
        return redirect()->route('pacientes.show', $id);
    }
}
