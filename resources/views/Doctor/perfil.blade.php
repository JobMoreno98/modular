@extends('layouts.plantilla')
@section('titulo', 'Perfil')
@section('content')
    <br>
    <h2>Perfil de usuario</h2>
    <hr>
    <h4> <b>Nombre</b> {{ $user->name }}</h4>
    <h4> <b>Correo</b> {{ $user->email }}</h4>
    <hr>
    <h4>Selecciona las horas de trabajo </h4>
    @php
    $inicio = 8;
    $fin = 12;
    @endphp
    <form action="" class="row align-items-center">
        <div class="col-sm-12 col-md-4 row align-items-center">
            <div class="col-sm-12 col-md-4">
                <label for="" class="form-label">Hora de inicio</label>
            </div>
            <div class="col-sm-12 col-md-4 w-100">
                <select class="form-control " name="" id="">
                    @for ($i = 0; $i < 10; $i++)
                        <option> {{ $inicio }} </option>
                        {{ $inicio = $inicio + 1 }}
                    @endfor
                </select>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 row  align-items-center">
            <div class="col-sm-12 col-md-4">
                <label for="" class="form-label">Hora de fin</label>
            </div>
            <div class="col-sm-12 col-md-4 w-100">
                <select class="form-control w-100" name="" id="">
                    @for ($i = 0; $i < 10; $i++)
                        <option> {{ $fin }} </option>
                        {{ $fin = $fin + 1 }}
                    @endfor
                </select>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <button type="submit" class="btn btn-primary btn-sm">Registar hora de trabajo</button>
        </div>

    </form>
@endsection
