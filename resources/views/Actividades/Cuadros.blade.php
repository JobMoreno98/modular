@extends('layouts.plantilla')
@section('titulo', 'Cuadros')
@section('content')
    <?php $cont = 5 + $nombre->grado; ?>
    <br>
    <div class="container" onload="inicio()">
    <h3> {{$nombre->descripcion}}</h3>
        <button onclick="colores()" class="btn btn-primary">Empezar</button>
        <div class="row" style="height: 250px;">
            @for ($i = 0; $i < $cont; $i++)
                <div class="col-sm-3 border m-1 w-45" ontouchstart="anadir(this)" id="{{ $i }}">
                </div>
            @endfor
        </div>

        <div id="contenedor"></div>
    </div>
    <script>
        var orden = [];
        var seleccionado = [];
        var ultimo = [];
        const cont = {!! json_encode($cont) !!}
        var colors = [];
        while (colors.length < cont) {
            colors.push(`rgb(${rand(0, 255)}, ${rand(0, 255)}, ${rand(0, 255)})`);
        }

        function rand(frm, to) {
            return ~~(Math.random() * (to - frm)) + frm;
        }


        function getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min)) + min;
        }

        async function colores() {
            console.log(ultimo.length);
            if (ultimo.length == 0) {
                for (let index = 0; index < cont; index++) {
                    orden.push(getRandomInt(1, cont));
                }
                var temp = orden.sort(function() {
                    return Math.random() - .5
                });
            } else {
                var temp = orden;
            }
            console.log(temp);
            for (var i = 0; i < temp.length; i++) {
                document.getElementById(temp[i]).style.backgroundColor = colors[i];
                await new Promise(r => setTimeout(r, 1000));
                document.getElementById(temp[i]).style.backgroundColor = "white"
            }
            ultimo = orden;
        }

        function anadir(params) {
            //document.getElementById('contenedor').innerHTML += params.id
            let id = parseInt(params.id, 10);
            seleccionado.push(id)
            console.log(seleccionado, orden);
            if (seleccionado.length == orden.length) {
                if (JSON.stringify(seleccionado) == JSON.stringify(orden)) {
                    orden = [];
                    seleccionado = [];
                    ultimo = [];
                    $.alert({
                        title: 'Correccto!',
                        content: 'Felicidades haz contestado todo correctamente',
                    });
                    document.getElementById('contenedor').innerHTML = '';
                }else{
                    orden = [];
                    seleccionado = [];
                    ultimo = [];
                    $.alert({
                        title: 'Incorrecto!',
                        content: 'Favor de volver a intentarlo',
                    });
                }
            }

        }
    </script>

@endsection
