@extends('layouts.plantilla')
@section('titulo', 'Actividades - Paciente')
@section('content')
    <br>
    <div class="row">
        <div class="col-sm-12">
            <h3>Por favor Selecciona los dias para realizar cada actividad</h3>
            <hr>
        </div>

        <form class="row" action="{{route('pacientes.register',['paciente'=> $paciente->id])}}" method="post">
            @csrf
            @foreach ($actividades as $key => $valores)
                @if ($valores != null)
                    <div class="row border m-1 p-1">
                        <h5>{{ $valores->especializa }}</h5>
                        <div class="col-sm-12">
                            Nombre: {{ $valores->nombre }}
                        </div>

                        <div class="col-sm-12 col-md-2 form-check">
                            <input name="{{ $valores->id }}[]" value="l" class="form-check-input" type="checkbox" value=""
                                id="{{ $valores->id }}-l">
                            <label class="form-check-label" for="{{ $valores->id }}-l">
                                Lunes
                            </label>
                        </div>
                        <div class="col-sm-12 col-md-2 form-check">
                            <input name="{{ $valores->id }}[]" value="m" class="form-check-input" type="checkbox" value=""
                                id="{{ $valores->id }}-m">
                            <label class="form-check-label" for="{{ $valores->id }}-m">
                                Martes
                            </label>
                        </div>
                        <div class="col-sm-12 col-md-2 form-check">
                            <input name="{{ $valores->id }}[]" value="mi" class="form-check-input" type="checkbox"
                                value="" id="{{ $valores->id }}-mi">
                            <label class="form-check-label" for="{{ $valores->id }}-mi">
                                Miercoles
                            </label>
                        </div>
                        <div class="col-sm-12 col-md-2 form-check">
                            <input name="{{ $valores->id }}[]" value="j" class="form-check-input" type="checkbox"
                                value="" id="{{ $valores->id }}-j">
                            <label class="form-check-label" for="-j">
                                Jueves
                            </label>
                        </div>
                        <div class="col-sm-12 col-md-2 form-check">
                            <input name="{{ $valores->id }}[]" value="l" class="form-check-input" type="checkbox"
                                value="" id="{{ $valores->id }}-v">
                            <label class="form-check-label" for="{{ $valores->id }}-v">
                                Viernes
                            </label>
                        </div>
                        <div class="col-sm-12 col-md-2 form-check">
                            <input name="{{ $valores->id }}[]" value="s" class="form-check-input" type="checkbox"
                                value="" id="{{ $valores->id }}-s">
                            <label class="form-check-label" for="{{ $valores->id }}-s">
                                Sabado
                            </label>
                        </div>
                        <div class="col-sm-12 col-md-2 form-check">
                            <input name="{{ $valores->id }}[]" value="d" class="form-check-input" type="checkbox"
                                value="" id="{{ $valores->id }}-d">
                            <label class="form-check-label" for="{{ $valores->id }}-d">
                                Domingo
                            </label>
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="col-auto  text-center align-middle">
                <button type="submit" class="btn btn-success"> Guardar</button>
            </div>
            <br>
            <div class="col-auto text-center">
                <input type="checkbox" name="aceptar" id="aceptar" class="btn form-check-input" >
                <label class="form-check-label" for="aceptar">Aceptar cambios</label>
                @error('aceptar')
                <span class="alert alert-danger">{{$message}}</span>
                @enderror
            </div>
        </form>
    </div>
@endsection
