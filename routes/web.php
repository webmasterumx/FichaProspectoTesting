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
Route::get('/search/crm/', [FichaController::class, 'searcCrm'])->name('search.crm');
Route::get('/guardar/bitacora', [FichaController::class, 'guardarBitacora'])->name('guardar.bitacora');
Route::get('/guardar/referido', [FichaController::class, 'guardarReferido'])->name('guardar.referido');
Route::get('/optener/referidos/{folio_crm}', [FichaController::class, 'getReferidos'])->name('get.referidos');

//! Consultas a la api

Route::get('/guardar/datos/prospecto', [FichaController::class, 'guardarDatosProspecto'])->name('guardar.datos.prospecto');
Route::get('/get/infomacion/promotor/{idPromotor}', [PeticionesController::class, 'optenerDatosPromotor'])->name('get.info.promotor');
Route::get('/get/planteles', [PeticionesController::class, 'getPlanteles'])->name('get.planteles');
Route::get('/get/niveles/{clavePlan}', [PeticionesController::class, 'getNiveles'])->name('get.niveles');
Route::get('/obtener/info/promotor/{promotor}', [FichaController::class, 'validarPromotor'])->name('validar.promotor');
Route::get('/obtener/carreras/{claveCampana}/{clavePlantel}/{claveNivel}', [PeticionesController::class, 'getCarreras'])->name('obtener.carreras');
Route::get('/obtener/horarios/{claveCampana}/{clavePlantel}/{claveNivel}/{claveCarrera}', [PeticionesController::class, 'getHorarios'])->name('obtener.horarios');
Route::get('/obtener/campanas/{claveCampana}', [PeticionesController::class, 'getCampanas'])->name('obtener.campanas');
Route::get('/obtener/mensajes/whatsapp/{folio_crm}', [PeticionesController::class, 'getConversacionesWhatsapp'])->name('obtener.mensajes');
Route::get('/obtener/menu/{idMenu}', [PeticionesController::class, 'getMenu'])->name('obtener.menu');
Route::get('/obtener/origenes', [PeticionesController::class, 'getOrigenes'])->name('obtener.origenes');
Route::get('/obtener/listado/callcenter/{promotor}', [PeticionesController::class, 'getListadoCallCenter'])->name('get.callcenter.listado');
//combos bitacora
Route::get('/obtener/estados', [PeticionesController::class, 'getCatalogoEstatusDetalle']);
Route::get('/obtener/horariosContacto', [PeticionesController::class, 'getCatalogoHorarioContacto']);
Route::get('/obtener/actividadesRealizadas/{type}', [PeticionesController::class, 'getCatalogoTipoContacto']);
Route::get('/obtener/actividadesProximas/{type}', [PeticionesController::class, 'getCatalogoTipoContacto']);
Route::get('/viabilidad/matriculacion/{folioCRM}', [PeticionesController::class, 'viabilidadMatriculacion'])->name('viabilidad.matricula');
