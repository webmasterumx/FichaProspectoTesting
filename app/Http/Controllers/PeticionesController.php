<?php

namespace App\Http\Controllers;

use Artisaninweb\SoapWrapper\SoapWrapper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use SoapClient;

class PeticionesController extends Controller
{

    public $base_url = "https://api-testing.unimexver.edu.mx/api/";

    public function getFichaProspecto($folio_crm)
    {
        $response = Http::post($this->base_url . 'ficha/prospecto', [
            'folioCRM' => $folio_crm,
        ]);

        return $response->json();
    }

    public function validarPromotor($promotor)
    {

        $response = Http::post($this->base_url . 'validar/promotor', [
            'promotor' => $promotor,
        ]);

        return $response->json();
    }

    public function optenerDatosPromotor($identificador)
    {

        $response = Http::post($this->base_url . 'obtener/datos/usuario', [
            'promotor' => $identificador,
        ]);

        return $response->json();
    }

    public function guardarDatosGeneralesProspecto($valores)
    {

        $response = Http::post($this->base_url . 'guardar/datos/generales', $valores);

        return $response->json();
    }

    public function getPlanteles()
    {
        $response = Http::get($this->base_url . 'oferta/planteles');

        return $response->json();
    }

    public function getNiveles($clavePlantel)
    {

        $response = Http::post($this->base_url . 'oferta/niveles', [
            'clavePlantel' => $clavePlantel,
        ]);

        return $response->json();
    }

    public function getCarreras($claveCampana, $clavePlantel, $claveNivel)
    {
        $response = Http::post($this->base_url . 'obtener/carrera', [
            "claveCampana" => $claveCampana,
            "clavePlantel" => $clavePlantel,
            "claveNivel" => $claveNivel
        ]);

        return $response->json();
    }

    public function getHorarios($claveCampana, $clavePlantel, $claveNivel, $claveCarrera)
    {
        $response = Http::post($this->base_url . 'obtener/horario', [
            "claveCampana" => $claveCampana,
            "clavePlantel" => $clavePlantel,
            "claveNivel" => $claveNivel,
            "claveCarrera" => $claveCarrera
        ]);

        return $response->json();
    }

    public function getCampanas($claveCampana)
    {
        $response = Http::post($this->base_url . 'obtener/campanas/activas', [
            "claveCampana" => $claveCampana
        ]);

        return $response->json();
    }

    public function getConversacionesWhatsapp($folio_crm)
    {
        $response = Http::post($this->base_url . 'obtener/conversaciones/whatsapp', [
            "FolioCRM" => $folio_crm
        ]);

        return $response->json();
    }

    public function getCatalogoEstatusDetalle()
    {
        $response = Http::get($this->base_url . 'obtener/catalogo/estus/detalle');

        return $response->json();
    }

    public function getCatalogoHorarioContacto()
    {
        $response = Http::get($this->base_url . 'obtener/catalogo/horario/contacto');

        return $response->json();
    }

    public function getCatalogoTipoContacto($id)
    {
        $response = Http::post($this->base_url . 'obtener/catalogo/tipo/contacto', [
            "idcombo" => $id
        ]);

        return $response->json();
    }

    public function guardarBitacora($valores)
    {

        $response = Http::post($this->base_url . 'registrar/bitacora', $valores);

        return $response->json();
    }

    public function obtenerReferidosProspecto($folioCRM)
    {
        $response = Http::post($this->base_url . 'obtener/referidos', [
            "folioCRM" => $folioCRM
        ]);

        return $response->json();
    }

    public function guardarReferidoPeticion($valores)
    {

        $response = Http::post($this->base_url . 'registrar/referido/prospecto', $valores);

        return $response->json();
    }

    public function getBusqueda($valores)
    {
        $response = Http::post($this->base_url . 'buscador/prospecto', $valores);

        return $response->json();
    }

    public function getMenu($valor)
    {
        $response = Http::post($this->base_url . 'obtener/menu', [
            "parentMenuId" => $valor
        ]);

        return $response->json();
    }

    public function getOrigenes()
    {
        $response = Http::get($this->base_url . 'obtener/catalogo/origenes');

        return $response->json();
    }

    public function viabilidadMatriculacion($folio_crm)
    {
        $response = Http::post($this->base_url . 'validar/viabilidad/matriculacion', [
            "folioCRM" => $folio_crm
        ]);

        return $response->json();
    }

    public function getListadoCallCenter($promotor)
    {
        $response = Http::post($this->base_url . 'get/listado/callcenter', [
            "claveUsuario" => $promotor
        ]);

        return $response->json();
    }
}
