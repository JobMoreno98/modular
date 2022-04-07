<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ActividadController extends Controller
{
    public function index(){
        $id = Auth::user()->id;
        $actividades = Actividad::where('id_doctor','=',$id)->paginate(15);
        return view('Actividades.index',compact('actividades'));
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
    public function buscar(Request $request){

        $request->validate([
            'buscar_por'=>'different::"buscar_por"',
            'buscar'=>'required'
        ]);
        $id = Auth::user()->id;
        $actividades = Actividad::where('id_doctor','=',$id)
        ->where($request->buscar_por,'LIKE','%'.$request->buscar.'%')
        ->get();
        return view('Actividades.index',compact('actividades'));
    }
}
