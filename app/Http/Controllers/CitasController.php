<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pacientes;


class CitasController extends Controller
{
    public function store(Pacientes $paciente){

        return view('Pacientes.cita',compact('paciente'));
    }
}
