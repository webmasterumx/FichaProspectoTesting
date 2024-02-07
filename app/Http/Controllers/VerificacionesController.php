<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerificacionesController extends Controller
{
    public $clave_campana;
    public $clave_plantel;
    public $clave_nivel;
    public $clave_carrera;
    public $origen;

    public function __construct($ficha_prospecto)
    {
        $this->clave_campana = $ficha_prospecto['claveCampana'];
        $this->clave_plantel = $ficha_prospecto['clavePlantel'];
        $this->clave_nivel = $ficha_prospecto['claveNivel'];
        $this->clave_carrera = $ficha_prospecto['claveCarrera'];
        $this->origen = $ficha_prospecto['origen'];
    }

    public function getEstado($clave)
    {
        if (($clave === NULL) ||  ($clave == 0)) {
            return false;
        } else {
            return true;
        }
    }


    public function getNiveles()
    {

        $verificacion  = SELF::getEstado($this->clave_plantel);

        if ($verificacion) {
            $nivelesList = app(PeticionesController::class)->getNiveles($this->clave_plantel);
        } else {
            $nivelesList = array();
        }

        return $nivelesList;
    }

    public function getCarreras()
    {

        $verificacion_campana = SELF::getEstado($this->clave_campana);
        $verificacion_plantel = SELF::getEstado($this->clave_plantel);
        $verificacion_nivel = SELF::getEstado($this->clave_nivel);

        if (($verificacion_campana) && ($verificacion_plantel) && ($verificacion_nivel)) //evalua si las tres claves estan disponibles
        {
            $carrerasList = app(PeticionesController::class)->getCarreras($this->clave_campana, $this->clave_plantel, $this->clave_nivel);
        } else {
            $carrerasList = array();
        }

        return $carrerasList;
    }

    public function getHorarios()
    {

        $verificacion_campana = SELF::getEstado($this->clave_campana);
        $verificacion_plantel = SELF::getEstado($this->clave_plantel);
        $verificacion_nivel = SELF::getEstado($this->clave_nivel);
        $verificacion_carrera = SELF::getEstado($this->clave_carrera);

        if (($verificacion_campana) && ($verificacion_plantel) && ($verificacion_nivel) && ($verificacion_carrera)) //evalua si las tres claves estan disponibles
        {
            $horariosList = app(PeticionesController::class)->getHorarios($this->clave_campana, $this->clave_plantel, $this->clave_nivel, $this->clave_carrera);
        } else {
            $horariosList = array();
        }

        return $horariosList;
    }
}
