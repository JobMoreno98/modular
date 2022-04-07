@extends('layouts.plantilla')
@section('titulo', 'Resgitro - Pacientes')

@section('content')
    <br>
    <h3>Datos Generales</h3>
    <form action="{{ route('pacientes.store') }}" method="post">
        @csrf
        <div class="row justify-content-between">
            <div class="col-12">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" />
                @error('nombre')
                <small>{{$message}}</small>
                @enderror
            </div>

            <div class="col-sm- 12 col-md-3">
                <label class="form-label">Fecha Nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="form-control" />
                @error('fecha_nacimiento')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="col-sm- 12 col-md-3">
                <label class="form-label">Genero</label>
                <select class="form-control" name="genero" id="">
                    <option value="H">Hombre</option>
                    <option value="M">Mujer</option>
                </select>
            </div>
            <div class="col-sm- 12 col-md-3">
                <label class="form-label">Grado Escolar</label>
                <select class="form-control" name="escolaridad" id="">
                    <option value="Sin estudios">Sin Estidudios</option>
                    <option value="Primaria">Primaria</option>
                    <option value="Secundaria">Secundaria</option>
                    <option value="Preparatoria">Preparatoria</option>
                    <option value="Universidad">Universidad</option>
                    <option value="Posgrado">Posgrado</option>
                </select>
            </div>
            <div class="col-sm- 12 col-md-3">
                <label class="form-label" for="enfermedad">Enfermedad Padecida</label>
                <input class="form-control" type="text" name="enfermedad">
                @error('enfermedad')
                <small>{{$message}}</small>
                @enderror
            </div>
        </div>

        <hr />

        <h3>Procesos Cognitivos</h3>
        <div class="row">
            <div class="col-sm- 12 col-md-3">
                <label for="orientacion" class="form-label">Orientación</label>
                <select class="form-control" name="orientacion" id="orientacion">
                    <option value="1">Normal Alto</option>
                    <option value="2">Normal</option>
                    <option value="3">Leve Moderado</option>
                    <option value="4">Severo</option>
                </select>
            </div>

            <div class="col-sm- 12 col-md-3">
                <label for="atencion_concentarcion" class="form-label">Atención y Concentración</label>
                <select class="form-control" name="atencion_concentarcion" id="atencion_concentarcion">
                    <option value="1">Normal Alto</option>
                    <option value="2">Normal</option>
                    <option value="3">Leve Moderado</option>
                    <option value="4">Severo</option>
                </select>
            </div>

            <div class="col-sm- 12 col-md-3">
                <label for="memoria" class="form-label">Memoria</label>
                <select class="form-control" name="memoria" id="memoria">
                    <option value="1">Normal Alto</option>
                    <option value="2">Normal</option>
                    <option value="3">Leve Moderado</option>
                    <option value="4">Severo</option>
                </select>
            </div>
            <div class="col-sm- 12 col-md-3">
                <label for="f_ejecutivas" class="form-label">Funciones Ejecutivas</label>
                <select class="form-control" name="f_ejecutivas" id="f_ejecutivas">
                    <option value="1">Normal Alto</option>
                    <option value="2">Normal</option>
                    <option value="3">Leve Moderado</option>
                    <option value="4">Severo</option>
                </select>
            </div>
            <div class="col-sm- 12 col-md-3">
                <label for="lenguaje" class="form-label">Lenguaje</label>
                <select class="form-control" name="lenguaje" id="lenguaje">
                    <option value="1">Normal Alto</option>
                    <option value="2">Normal</option>
                    <option value="3">Leve Moderado</option>
                    <option value="4">Severo</option>
                </select>
            </div>
            <div class="col-sm- 12 col-md-3">
                <label for="percepcion" class="form-label">Percepción</label>
                <select class="form-control" name="percepcion" id="percepcion">
                    <option value="1">Normal Alto</option>
                    <option value="2">Normal</option>
                    <option value="3">Leve Moderado</option>
                    <option value="4">Severo</option>
                </select>
            </div>
        </div>

        <hr />

        <h3>Otras Enfermedades</h3>

        <div id="formulario">
            <button type="button" id="agregar" class="clonar btn btn-secondary btn-sm">+</button>
            <label for="agregar">Agregar Enfermedad</label>
        </div>
        <br />

        <button class="btn btn-success col-sm- 12 col-md-3" type="submit">Registrar</button>
    </form>
    <br>
    <script>
        var cont = 0;

        function eliminar(eliminar) {
            let elemento = document.getElementById(eliminar);
            elemento.parentNode.removeChild(elemento);
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
