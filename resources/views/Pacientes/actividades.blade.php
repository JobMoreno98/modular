@php($o = ['1' => 'Normal Alto', '2' => 'Normal', '3' => 'Leve Moderado', '4' => 'Severo'])
@php($values = ['Orientacion' => 'orientacion', 'Atención y Concentracion' => 'atencion_concentracion',
            'Memoria' => 'memoria', 'Funciones Ejecutivas' => 'funciones_ejecutivas',
            'Lenguaje'=>'lenguaje','Precepcion'=>'percepcion'
])
@extends('layouts.plantilla')
@section('titulo', 'Actividades - Paciente')
@section('content')
    <br>
    <div class="row">
        {{--<h4>Aviso si usted desmarca todas las casillas y envia el formulario no asignara ninguna actividad</h4>--}}
        <h4>Actividades Actuales Disponibles</h4>
    </div>
    <hr>
    <div class="row">
        @php($o = ['1' => 'Normal Alto', '2' => 'Normal', '3' => 'Leve Moderado', '4' => 'Severo'])
        <form class="row" action="{{route('pacientes.activity_select',['paciente'=> $paciente->id])}}" method="post">
            @csrf
            @foreach ($actividades as $key => $valores)
                <h5>{{ $key }}</h5>
                @foreach ($valores as $llaves => $item)
                    <div class="form-check" >
                        <input name="{{$values[$key]}}[]" value="{{$item->id}}" class="form-check-input" type="checkbox" value="" id="{{$item->id}}">
                        <label class="form-check-label" for="{{$item->id}}">
                            <b>Nombre:</b> {{ $item->nombre }}
                            <b>Nivel de cognición:</b> {{ $o[$item->grado] }}
                            <b>Descripción:</b> {{ $item->descripcion }}
                        </label>
                    </div>
                @endforeach
                @if ($valores->all() == null)
                    No hay actividades que se adecuen para este estado del paciente
                @endif
                <hr>
            @endforeach
            <div class="col-auto  text-center align-middle">
                <button type="submit" class="btn btn-success">Siguiente paso</button>
            </div>
            <br>
            <div class="col-auto text-center">
                <input type="checkbox" name="aceptar" id="aceptar" class="form-check-input" >
                <label class="form-check-label" for="aceptar">Aceptar cambios</label>
                @error('aceptar')
                <span class="alert alert-danger">{{$message}}</span>
                @enderror
            </div>
        </form>
    </div>
    <br>
@endsection
