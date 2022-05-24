<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActividadController;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('pacientes', PacientesController::class)->middleware('auth');

Route::post('pacientes/store', [PacientesController::class, 'store'])->name('pacientes.store')->middleware('auth');

/*Route::get('paciente',[PacientesController::class,'index'])->name('pacientes.index')->middleware('auth');
*/
# Ruta para obtener el historial del paciente
Route::get(
    'pacientes/{paciente}/historial',
    [PacientesController::class, 'history']
)->name('pacientes.history')->middleware('auth');

# Ruta para obtener el historial del paciente
Route::put(
    'pacientes/{id}/update',
    [PacientesController::class, 'update']
)->name('pacientes.update')->middleware('auth');

# Ruta para deifinir las actividades del paciente
Route::get(
    'pacientes/{paciente}/actividades',
    [PacientesController::class, 'set_activity']
)->name('pacientes.activity')->middleware('auth');

# Ruta para actualizar las actividades
Route::post(
    'pacientes/{paciente}/actividades/update',
    [PacientesController::class, 'activity_update']
)->name('pacientes.activity_update')->middleware('auth');

#

Route::post('pacientes/{paciente}/actividades/select',[PacientesController::class, 'activity_select'])->name('pacientes.activity_select')->middleware('auth');


Route::post('pacientes/{paciente}/actividades/register',[PacientesController::class, 'register'])->name('pacientes.register')->middleware('auth');

# Ruta para hacer la busqueda en el index de los pacientes
Route::post(
    'pacientes/',
    [PacientesController::class, 'search']
)->name('pacientes.search')->middleware('auth');


Route::get(
    'cuadros',
    [PacientesController::class, 'cuadro']
)->name('pacientes.cuadros')->middleware('auth');



# Ver perfil del usuario
Route::get('perfil', [UserController::class, 'perfil'])->name('usuario.perfil')->middleware('auth');

# Rutas de las actividades
Route::resource('actividades', PacientesController::class)->except([
    'index', 'store'
])->middleware('auth');

Route::get('activdades', [ActividadController::class, 'index'])->name('actividades.index')->middleware('auth');
Route::get('activdades/{nombre}', [ActividadController::class, 'buscar'])->name('actividad')->middleware('auth');