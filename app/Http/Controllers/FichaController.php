<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;

class FichaController extends Controller
{

    public function index()
    {
        return view('inicio');
    }

    public function getInfoFichaProspecto($folio_crm, $promotor)
    {
        $infoProspecto = app(PeticionesController::class)->getFichaProspecto($folio_crm);

        if ($infoProspecto['folioCRM'] == 0) {
            //print(' no existe prospecto <br>'); //retornar 1
            return 1;
        } else {
            //print('existe el prospecto falta validar el promotor <br>'); 
            $validacionPromotor = app(PeticionesController::class)->optenerDatosPromotor($promotor);

            if ($validacionPromotor['claveUsuario'] != 0) {
                //print('existe promotor <br>');
                $infoPromotor = $validacionPromotor;
                $cadenaFecha = $infoPromotor['fechaActual'];
                $fecha = date('Y-m-d', strtotime($cadenaFecha));
                $fechaFormateada = SELF::formatearFecha($fecha);

                $infoFinal = array(
                    "infoProspecto" => $infoProspecto,
                    "infoPromotor" => $infoPromotor,
                    "fechaFormateada" => $fechaFormateada
                );

                return response()->json($infoFinal);
            } else {
                //print('no existe promotor'); //retornar 2
                return 2;
            }
        }
    }

    public function guardarDatosProspecto(Request $request)
    {


        $valores = array(
            "folioCRM" => $_REQUEST['folio_crm'],
            "claveCampana" => $_REQUEST['claveCampana'],
            "clavePlantel" => $_REQUEST['clavePlantel'],
            "claveNivel" => $_REQUEST['claveNivel'],
            "claveCarrera" =>  $_REQUEST['claveCarrera'],
            "claveHorario" => $_REQUEST['claveHorario'],
            "nombre" => $_REQUEST['nombre_form'],
            "apPaterno" => $_REQUEST['apellidos_form'],
            "apMaterno" => $_REQUEST['apellido_mat_form'],
            "telefono1" => $_REQUEST['telefono_uno'],
            "telefono2" => $_REQUEST['telefono_dos'],
            "celular1" => $_REQUEST['celular_uno'],
            "celular2" => $_REQUEST['celular_dos'],
            "email" => $_REQUEST['email_form'],
        );

        $envio = app(PeticionesController::class)->guardarDatosGeneralesProspecto($valores);

        if ($envio === true) {
            echo true;
        } else {
            echo false;
        }
    }
    public function searcCrm()
    {
        $tipo_search = $_REQUEST['type'];
        $text_search = $_REQUEST['search'];
        $plantel_search = $_REQUEST['plantel'];

        //print($tipo_search);

        $valores = array(
            "tipoBusqueda" => $tipo_search,
            "textoBuscar" => $text_search,
            "clavePlantel" => $plantel_search,
        );

        $busqueda = app(PeticionesController::class)->getBusqueda($valores);
        //dd($busqueda);
        $resulList = array();

        if (isset($busqueda['ProspectoCallCenter']['folioCRM'])) { // comprovacion de una sola pocision en la lista de retorno
            //echo 'es uno';

            $resultado = array(
                "folioCRM" => $busqueda['ProspectoCallCenter']['folioCRM'],
                "nombreCompleto" => $busqueda['ProspectoCallCenter']['nombreCompleto'],
                "telefono1" => $busqueda['ProspectoCallCenter']['telefono1'],
                "telefono2" => $busqueda['ProspectoCallCenter']['telefono2'],
                "celular1" => $busqueda['ProspectoCallCenter']['celular1'],
                "celular2" => $busqueda['ProspectoCallCenter']['celular2'],
                "email" => $busqueda['ProspectoCallCenter']['email'],
            );

            array_push($resulList, $resultado);
        } else {
            //comprobar respuest
            if (($busqueda == null) || $busqueda === NULL) {
                //no hay resultados que mostrar
                $resulList = array();
            } else if (is_array($busqueda)) {
                //evalua si es un array
                if (sizeof($busqueda) > 0) {
                    //trae resultados
                    $resulList = $busqueda['ProspectoCallCenter'];
                } else {
                    // no trae nada
                    $resulList = array();
                }
            } else {
                $resulList = array();
            }
        }

        //dd($resulList);
        return Response::json($resulList);
    }

    public function formatearFecha($fecha)
    {
        $diaSemana = date('N', strtotime($fecha));
        $numeroMes = date('m', strtotime($fecha));
        $año = date('Y', strtotime($fecha));
        $diaMes = date('d', strtotime($fecha));
        $nombreMes = SELF::nombreMes($numeroMes);
        $nombreDiaSemana = SELF::nombreDiaSemana($diaSemana);

        $fechaFormateada = array(
            "año" => $año,
            "diaMes" => $diaMes,
            "nombreMes" => $nombreMes,
            "nombreDiaSemana" => $nombreDiaSemana
        );

        return $fechaFormateada;
    }

    public function nombreMes($numeroMes)
    {
        $mesesList = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $mesFinal = $numeroMes - 1;

        for ($i = 0; $i < (sizeof($mesesList) - 1); $i++) {
            if ($i == $mesFinal) {
                return $mesesList[$i];
            }
        }
    }

    public function nombreDiaSemana($diaSemana)
    {

        $diasSemanaList = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sabado", "Domingo"];
        $diaFinal = $diaSemana - 1;

        for ($i = 0; $i < (sizeof($diasSemanaList) - 1); $i++) {
            if ($diaFinal == $i) {
                return $diasSemanaList[$i];
            }
        }
    }

    public function guardarBitacora(Request $request)
    {

        if ($_REQUEST['date_bitacora'] == null || $_REQUEST['date_bitacora'] == "")  {
            //echo 'no hay fecha';
            $date = " ";
        }
        else{
            //echo 'si hay fecha';
            $date = $_REQUEST['date_bitacora'];
        }//

        if ($_REQUEST['actividadProxima'] == 0) {
            $contacto = null;
        } else {
            $contacto = $_REQUEST['actividadProxima'];
        }

        if ($_REQUEST['horarioContacto'] == 0) {
            $horario = null;
        } else {
            $horario = $_REQUEST['horarioContacto'];
        }

        $valores = array(
            "folioCRM" => $_REQUEST['folio_crm'],
            "actRealizada" => $_REQUEST['actividadRealizada'],
            "estatusDetalle" => $_REQUEST['estatusDetalle'],
            "tipoContacto" => $contacto,
            "fechaAgenda" => $date,
            "idRangoHr" => $horario,
            "asistioPlantel" => false,
            "actividad" => $_REQUEST['comentariosBitacora'],
            "claveUsuario" => $_REQUEST['promotor'],
        );

        //dd($valores);
        $envio = app(PeticionesController::class)->guardarBitacora($valores);
        
        //dd($envio);

        if ($envio === true) {
            echo true;
        } else {
            echo false;
        }
    }

    public function getReferidos($folio_crm)
    {

        $referidosRespone = app(PeticionesController::class)->obtenerReferidosProspecto($folio_crm);

        if (sizeof($referidosRespone) > 0) {
            if (isset($referidosRespone['ProspectoCallCenter']['folioCRM'])) {
                $referidosList  = array(
                    "folioCRM" => $referidosRespone['ProspectoCallCenter']['folioCRM'],
                    "nombreCompleto" => $referidosRespone['ProspectoCallCenter']['nombreCompleto'],
                    "telefono1" => $referidosRespone['ProspectoCallCenter']['telefono1'],
                    "telefono2" => $referidosRespone['ProspectoCallCenter']['telefono2'],
                    "celular1" => $referidosRespone['ProspectoCallCenter']['celular1'],
                    "celular2" => $referidosRespone['ProspectoCallCenter']['celular2'],
                    "email" => $referidosRespone['ProspectoCallCenter']['email']
                );

                $referidoFinal = array();

                array_push($referidoFinal, $referidosList);

                $referidos = $referidoFinal;
            } else {
                $referidos = $referidosRespone['ProspectoCallCenter'];
            }
        } else {
            $referidos = array();
        }

        return response()->json($referidos);
    }

    public function guardarReferido(Request $request)
    {

        //var_dump($_REQUEST['apellidoPaternoReferido']);
        $valores = array(
            "folioCRM" => $_REQUEST['folioCRM'],
            "nombre" => $_REQUEST['nombreReferido'],
            "apPaterno" => $_REQUEST['apellidoPaternoReferido'],
            "apMaterno" => $_REQUEST['apellidoMaternoReferido'],
            "telefono" => $_REQUEST['telefonoReferido'],
            "email" => $_REQUEST['emailReferido'],
            "claveUsuario" => $_REQUEST['promotor'],
            "tipoTelefono" => $_REQUEST['telefonoReferidoType'],
        );

        $envio = app(PeticionesController::class)->guardarReferidoPeticion($valores);

        if ($envio === true) {
            echo true;
        } else {
            echo false;
        }
    }
}
