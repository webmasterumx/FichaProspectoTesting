<?php

use App\Http\Controllers\FichaController;
use App\Http\Controllers\PeticionesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FichaController::class, 'index']);
Route::get('/getFichaProspecto/{folio_crm}/{promotor}', [FichaController::class, 'getInfoFichaProspecto'])->name('get.ficha.prospecto');
Route::get('/search/crm/{type_search}/{text_search}/{clave_plantel}', [FichaController::class, 'searcCrm'])->name('search.crm');
Route::get('/guardar/bitacora', [FichaController::class, 'guardarBitacora'])->name('guardar.bitacora');
Route::get('/guardar/referido', [FichaController::class, 'guardarReferido'])->name('guardar.referido');

//! Consultas a la api

Route::get('/guardar/datos/prospecto', [FichaController::class, 'guardarDatosProspecto'])->name('guardar.datos.prospecto');
Route::get('/get/planteles', [PeticionesController::class, 'getPlanteles'])->name('get.planteles');
Route::get('/get/niveles/{clavePlan}', [PeticionesController::class, 'getNiveles'])->name('get.niveles');
Route::get('/obtener/info/promotor/{promotor}', [FichaController::class, 'validarPromotor'])->name('validar.promotor');
Route::get('/obtener/carreras/{claveCampana}/{clavePlantel}/{claveNivel}', [PeticionesController::class, 'getCarreras'])->name('obtener.carreras');
Route::get('/obtener/horarios/{claveCampana}/{clavePlantel}/{claveNivel}/{claveCarrera}', [PeticionesController::class, 'getHorarios'])->name('obtener.horarios');
Route::get('/obtener/campanas/{claveCampana}', [PeticionesController::class, 'getCampanas'])->name('obtener.campanas');
Route::get('/obtener/mensajes/whatsapp/{folio_crm}', [PeticionesController::class, 'getConversacionesWhatsapp'])->name('obtener.mensajes');
Route::get('/obtener/menu/{idMenu}', [PeticionesController::class, 'getMenu'])->name('obtener.menu');
