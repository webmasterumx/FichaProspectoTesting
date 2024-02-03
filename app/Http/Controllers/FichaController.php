<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class FichaController extends Controller
{

    public function index()
    {

        //* optencion de la info prospecto
        if ((isset($_REQUEST['folio_crm']) == true)) {
            $folio_crm = $_REQUEST['folio_crm'];

            $infoProspecto = app(PeticionesController::class)->getFichaProspecto($folio_crm);
            
            $claveCampana = $infoProspecto['claveCampana'];
            $clavePlantel = $infoProspecto['clavePlantel'];
            $claveNivel = $infoProspecto['claveNivel'];
            $claveCarrera = $infoProspecto['claveCarrera'];

            $niveles = app(PeticionesController::class)->getNiveles($clavePlantel);
            $carreras = app(PeticionesController::class)->getCarreras($claveCampana, $clavePlantel, $claveNivel, $claveCarrera);

        } else {
            $niveles = [];
            $carreras = array(
                "Carrera" => array()
            );
        }
        
        //? metodos de llenado de combos de informacion superior de prospecto
        $campañas = app(PeticionesController::class)->getCampanas(0);
        $planteles = app(PeticionesController::class)->getPlanteles();
   
        //dd($carreras);

        $estados = app(PeticionesController::class)->getCatalogoEstatusDetalle();
        $horarios = app(PeticionesController::class)->getCatalogoHorarioContacto();

        $actividadesRealizadas = app(PeticionesController::class)->getCatalogoTipoContacto(1); //! combo lista de actividades realizadas
        $actividadesProximas = app(PeticionesController::class)->getCatalogoTipoContacto(2); //! combo lista de actividades por realizar

        if ((isset($_REQUEST['folio_crm']) == true)) {
            $folio_crm = $_REQUEST['folio_crm'];
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
        } else {
            $referidos = array();
        }

        //dd($referidos);

        return view('inicio', [
            "campañas" => $campañas['EntCampanaDTO'],
            "planteles" => $planteles,
            "niveles" => $niveles,
            "carreras" => $carreras['Carrera'],
            "estados" => $estados['EstatusDetalle'],
            "horarios" => $horarios['RangoContactacion'],
            "actividadesRealizadas" => $actividadesRealizadas['TipoContacto'],
            "actividadesProximas" => $actividadesProximas['TipoContacto'],
            "referidos" => $referidos,
        ]);
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

        if ($request->campana_info === "" || $request->campana_info === null) {
            //print('no hay campaña <br>');
            $campana_info = 1;
        }
        else {
            //print(' si hay campaña <br>');
            $campana_info = $request->campana_info;
        }
        if ($request->plantel_info === "" || $request->plantel_info === null) {
            //print('no hay plantel <br>');
            $plantel_info = 1;
        }
        else {
            //print(' si hay plantel <br>');
            $plantel_info = $request->plantel_info;
        }
        if ($request->nivel_info === "" || $request->nivel_info === null) {
            //print('no hay nivel <br>');
            $nivel_info = 1;
        }
        else {
            //print(' si hay nivel <br>');
            $nivel_info = $request->nivel_info;
        }
        if ($request->carrera_info === "" || $request->carrera_info === null) {
            //print('no hay carrera <br>');
            $carrera_info = 1;
        }
        else {
            print(' si hay carrera <br>');
            $carrera_info = $request->carrera_info;
        }
        if ($request->horario_info === "" || $request->horario_info === null) {
            //print('no hay horario <br>');
            $horario_info = 1;
        }
        else {
            //print(' si hay horario <br>');
            $horario_info = $request->horario_info;
        }


       $valores = array(
            "folioCRM" => $request->folio_crm,
            "claveCampana" => $campana_info,
            "clavePlantel" => $plantel_info,
            "claveNivel" => $nivel_info,
            "claveCarrera" =>  $carrera_info,
            "claveHorario" => $horario_info,
            "nombre" => $request->nombre_form,
            "apPaterno" => $request->apellidos_form,
            "apMaterno" => $request->apellido_mat_form,
            "telefono1" => $request->telefono_uno,
            "telefono2" => $request->telefono_dos,
            "celular1" => $request->celular_uno,
            "celular2" => $request->celular_dos,
            "email" => $request->email_form,
        );

        //dd($valores);

        $envio = app(PeticionesController::class)->guardarDatosGeneralesProspecto($valores);

        //dd($envio);

        return redirect()->back(); 
    }
    public function searcCrm($search_type, $search_text, $search_plantel)
    {
        $tipo_search = $search_type;
        $text_search = $search_text;
        $plantel_search = $search_plantel;

        //print($tipo_search);

        $valores = array(
            "tipoBusqueda" => $tipo_search,
            "textoBuscar" => $text_search,
            "clavePlantel" => $plantel_search,
        );

        $busqueda = app(PeticionesController::class)->getBusqueda($valores);
        $resulList = array();

        if (isset($busqueda['ProspectoCallCenter']['folioCRM'])) {
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
            //echo 'son mas de uno';

            $resulList = $busqueda['ProspectoCallCenter'];
        }

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

        $valores = array(
            "folioCRM" => $request->folio_crm,
            "actRealizada" => $request->actividadRealizada,
            "estatusDetalle" => $request->estatusDetalle,
            "tipoContacto" => $request->actividadProxima,
            "fechaAgenda" => $request->date_bitacora,
            "idRangoHr" => $request->horarioContacto,
            "asistioPlantel" => false,
            "actividad" => $request->comentariosBitacora,
            "claveUsuario" => $request->promotor,
        );

        $envio = app(PeticionesController::class)->guardarBitacora($valores);
        //dd($envio);

        return redirect()->back();
    }

    public function guardarReferido(Request $request)
    {

        $valores = array(
            "folioCRM" => $request->folio_crm,
            "nombre" => $request->nombreReferido,
            "apPaterno" => $request->apellidoPaternoReferido,
            "apMaterno" => $request->apellidoMaternoReferido,
            "telefono" => $request->telefonoReferido,
            "email" => $request->emailReferido,
            "claveUsuario" => $request->promotor,
            "tipoTelefono" => $request->telefonoReferidoType[0],
        );

        $envio = app(PeticionesController::class)->guardarReferidoPeticion($valores);

        //dd($envio);

        return redirect()->back();
    }
}
