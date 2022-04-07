@extends('layouts.plantilla')
@section('titulo', 'Resgitro - Pacientes')

@section('content')
<br>
<h3>Datos Generales</h3>
<form action="{{ route('pacientes.update',['id' => $paciente->id]) }}" method="post">
    @csrf
    @method('PUT')
    <div class="row justify-content-between">
        <div class="col-12">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $paciente->nombre }}" />
        </div>

        <div class="col-sm- 12 col-md-3">
            <label class="form-label">Fecha Nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form-control" value="{{ date('Y-m-d', strtotime($paciente->fecha_nacimiento)) }}" />
        </div>
        <div class="col-sm- 12 col-md-3">
            <label class="form-label">Genero</label>
            <select class="form-control" name="genero" id="">
                <option {{ ($paciente->genero == 'H') ? 'selected' : '' }} value="H">Hombre</option>
                <option {{ ($paciente->genero == 'M') ? 'selected' : '' }} value="M">Mujer</option>
            </select>
        </div>
        <div class="col-sm- 12 col-md-3">
            <label class="form-label">Grado Escolar</label>
            <select class="form-control" name="escolaridad" id="">
                <option {{ $paciente->escolaridad == 'Sin estudios' ? 'selected' : '' }} value="Sin estudios">Sin
                    Estidudios</option>
                <option {{ $paciente->escolaridad == 'Primaria' ? 'selected' : '' }} value="Primaria">Primaria</option>
                <option {{ $paciente->escolaridad == 'Secundaria' ? 'selected' : '' }} value="Secundaria">Secundaria
                </option>
                <option {{ $paciente->escolaridad == 'Preparatoria' ? 'selected' : '' }} value="Preparatoria">
                    Preparatoria</option>
                <option {{ $paciente->escolaridad == 'Universidad' ? 'selected' : '' }} value="Universidad">Universidad
                </option>
                <option {{ $paciente->escolaridad == 'Posgrado' ? 'selected' : '' }} value="Posgrado">Posgrado
                </option>
            </select>
        </div>
        <div class="col-sm- 12 col-md-3">
            <label class="form-label" for="enfermedad">Enfermedad Padecida</label>
            <input class="form-control" type="text" name="enfermedad" value="{{ $paciente->enfermedad }}">
        </div>
    </div>

    <hr />
    <h3>Procesos Cognitivos</h3>
    <div class="row">
        <div class="col-sm- 12 col-md-3">
            <label for="orientacion" class="form-label">Orientación</label>
            <select class="form-control" name="orientacion" id="orientacion">
                <option {{($procesos->orientacion==1)? 'selected' : ''}} value="1">Normal Alto</option>
                <option {{($procesos->orientacion==2)? 'selected' : ''}} value="2">Normal</option>
                <option {{($procesos->orientacion==3)? 'selected' : ''}} value="3">Leve Moderado</option>
                <option {{($procesos->orientacion==4)? 'selected' : ''}} value="4">Severo</option>
            </select>
        </div>
        <div class="col-sm- 12 col-md-3">
            <label for="atencion_concentarcion" class="form-label">Atención y Concentración</label>
            <select class="form-control" name="atencion_concentarcion" id="atencion_concentarcion">
                <option {{($procesos->atencion_concentracion==1)? 'selected' : ''}} value="1">Normal Alto</option>
                <option {{($procesos->atencion_concentracion==2)? 'selected' : ''}} value="2">Normal</option>
                <option {{($procesos->atencion_concentracion==3)? 'selected' : ''}} value="3">Leve Moderado</option>
                <option {{($procesos->atencion_concentracion==4)? 'selected' : ''}} value="4">Severo</option>
            </select>
        </div>

        <div class="col-sm- 12 col-md-3">
            <label for="memoria" class="form-label">Memoria</label>
            <select class="form-control" name="memoria" id="memoria">
                <option {{($procesos->memoria==1)? 'selected' : ''}} value="1">Normal Alto</option>
                <option {{($procesos->memoria==2)? 'selected' : ''}} value="2">Normal</option>
                <option {{($procesos->memoria==3)? 'selected' : ''}} value="3">Leve Moderado</option>
                <option {{($procesos->memoria==4)? 'selected' : ''}} value="4">Severo</option>
            </select>
        </div>
        <div class="col-sm- 12 col-md-3">
            <label for="f_ejecutivas" class="form-label">Funciones Ejecutivas</label>
            <select class="form-control" name="f_ejecutivas" id="f_ejecutivas">
                <option {{($procesos->funciones_ejecutivas==1)? 'selected' : ''}} value="1">Normal Alto</option>
                <option {{($procesos->funciones_ejecutivas==2)? 'selected' : ''}} value="2">Normal</option>
                <option {{($procesos->funciones_ejecutivas==3)? 'selected' : ''}} value="3">Leve Moderado</option>
                <option {{($procesos->funciones_ejecutivas==4)? 'selected' : ''}} value="4">Severo</option>
            </select>
        </div>
        <div class="col-sm- 12 col-md-3">
            <label for="lenguaje" class="form-label">Lenguaje</label>
            <select class="form-control" name="lenguaje" id="lenguaje">
                <option {{($procesos->lenguaje==1)? 'selected' : ''}} value="1">Normal Alto</option>
                <option {{($procesos->lenguaje==2)? 'selected' : ''}} value="2">Normal</option>
                <option {{($procesos->lenguaje==3)? 'selected' : ''}} value="3">Leve Moderado</option>
                <option {{($procesos->lenguaje==4)? 'selected' : ''}} value="4">Severo</option>
            </select>
        </div>
        <div class="col-sm- 12 col-md-3">
            <label for="percepcion" class="form-label">Percepción</label>
            <select class="form-control" name="percepcion" id="percepcion">
                <option {{($procesos->percepcion==1)? 'selected' : ''}} value="1">Normal Alto</option>
                <option {{($procesos->percepcion==2)? 'selected' : ''}} value="2">Normal</option>
                <option {{($procesos->percepcion==3)? 'selected' : ''}} value="3">Leve Moderado</option>
                <option {{($procesos->percepcion==4)? 'selected' : ''}} value="4">Severo</option>
            </select>
        </div>
    </div>

    <hr />
    {{ $paciente->enfermedades }}
    <h3>Otras Enfermedades</h3>

    <div id="formulario">
        <button type="button" class="clonar btn btn-secondary btn-sm">+</button>
        <label for="enfermedades">Agregar Enfermedad</label>
        @foreach (explode(',', $paciente->enfermedades) as $item)
        @php($valor = $item)
        <div class="input-group" id="{{ $item }}">
            <input type="text" class="form-control col-md-6" name="enfermedades[]" value={{ $item }}>
            <span class="btn btn-danger" onclick="eliminar(<?php echo $valor ?>)">X</span>
            <br>
        </div>
        @endforeach
    </div>
    <br />

    <button class="btn btn-success col-sm- 12 col-md-3" type="submit">Guardar cambios</button>
</form>
<br>
<script>
    var cont = 0;
    function eliminar(eliminar) {
        console.log(eliminar.id);

        let elemento = document.getElementById(eliminar.id);
        let padre = elemento.parentNode;
        padre.removeChild(elemento);
    }
    $('.clonar').click(function() {
            // Clona el .input-group
            //let $clone = $('#formulario .input-group').last().clone();
            let form = document.getElementById('formulario');
            var div = document.createElement("div");
            var input = document.createElement("input");
            var span = document.createElement("span");

            input.type = "text";
            input.name = 'enfermedades[]';
            input.placeholder = 'Nombre Enfermedad';
            input.className = "form-control col-md-6";
            input.setAttribute("id", 'enfermedades');

            span.className = "btn btn-danger";

            input.type = "text";
            input.name = 'enfermedades[]';
            input.placeholder = 'Nombre Enfermedad';
            input.className = "form-control col-md-6";
            input.setAttribute("id", 'enfermedades');

            span.className = "btn btn-danger";
            span.textContent = 'X';
            let numero = cont;
            span.addEventListener("click", function() {
                eliminar(numero)
            }, false);

            div.className = 'input-group';
            div.setAttribute('id', cont);
            div.appendChild(input);
            div.appendChild(span);
            form.appendChild(div);

            cont = cont + 1;

            /*
              // Borra los valores de los inputs clonados
              $clone.find(':input').each(function () {
                if ($(this).is('select')) {
                  this.selectedIndex = 0;
                } else {
                  this.value = '';
                }
              });

              $clone.id = (parseInt(Object.keys(anterior)[0]) + 1).toString();
              console.log($clone);
              // Agrega lo clonado al final del #formulario
              $clone.appendTo('#formulario');*/
        });
</script>
@endsection