<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiasActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dias_actividades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_paciente');
            $table->foreign('id_paciente')->references('id')->on('pacientes');
            $table->unsignedBigInteger('id_actividad');
            $table->foreign('id_actividad')->references('id')->on('actividades');
            $table->unsignedBigInteger('id_historial');
            $table->foreign('id_historial')->references('id')->on('historials');
            $table->string('dias');
            $table->string('fecha_inicio');
            $table->string('fecha_termino');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dias_actividades');
    }
}
