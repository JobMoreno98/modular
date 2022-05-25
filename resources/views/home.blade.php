@extends('layouts.plantilla')
@section('titulo', 'Inicio')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-5">
                <h2 class="text-center">Bienvenido, {{ Auth::user()->name }}</h2>
            </div>

        </div>
        @if (Auth::check() && Auth::user()->tipo == 'doctor')
            <div class="row justify-content-center ">
                <div class="col-sm-12 col-md-3 border-top border-dark mt-1 pt-3">
                    <a href="{{ route('pacientes.index') }}" class="text-decoration-none">
                        <div class="card btn btn-outline-dark shadow">
                            <div class="card-body text-center">
                                Ver los pacientes
                            </div>
                        </div>
                    </a>

                </div>

            </div>
            <div class="row justify-content-center ">
                <div class="col-sm-12 col-md-3  mt-1 pt-3">
                    <a href="{{ route('analisis') }}" class="text-decoration-none">
                        <div class="card btn btn-outline-dark shadow">
                            <div class="card-body text-center">
                                Ver Estadisticas
                            </div>
                        </div>
                    </a>

                </div>

            </div>
        @endif
    </div>
@endsection
