@extends('layouts.plantilla')
@section('titulo', 'Actividades')
@section('content')
    <br>
    <br>
    <div class="card-list" id="card-list">
        <div class="row justify-content-between">
            <div class="col-sm-12">
                <h3>Actividades</h3>
                <hr>
                @foreach ($activity as $item)
                    <a href="{{ route('actividad', $item->nombre) }}" class="text-left btn btn-outline-dark">
                        <div class="col-sm-12">
                            Nombre: {{ $item->nombre }} <br>
                            Descripción:{{ $item->descripcion }}
                        </div>
                    </a>
                @endforeach
                @if ($activity->all() == null)
                    <h4>No hay actividades por hacer</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
