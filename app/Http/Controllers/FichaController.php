<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FichaController extends Controller
{

    public function index()
    {
        $planteles = app(PeticionesController::class)->getPlanteles();
       
        return view('inicio', [
            "planteles" => $planteles
        ]);
    }

    public function getInfoFichaProspecto($folio_crm, $promotor)  
    {
        $infoProspecto = app(PeticionesController::class)->getFichaProspecto($folio_crm);

        if($infoProspecto['folioCRM'] == 0){
            //print(' no existe prospecto <br>'); //retornar 1
            return 1;
        }
        else {
            //print('existe el prospecto falta validar el promotor <br>'); 
            $validacionPromotor = app(PeticionesController::class)->validarPromotor($promotor);

            if(intval($validacionPromotor) > 0){
                //print('existe promotor <br>');
                $infoPromotor = app(PeticionesController::class)->optenerDatosPromotor($validacionPromotor);
                $cadenaFecha = $infoPromotor['fechaActual'];
                $fecha = date('Y-m-d', strtotime($cadenaFecha));
                $fechaFormateada = SELF::formatearFecha($fecha);
                
                $infoFinal = array(
                    "infoProspecto" => $infoProspecto,
                    "infoPromotor" => $infoPromotor,
                    "fechaFormateada" => $fechaFormateada
                );

                return response()->json($infoFinal);
            }
            else {
                //print('no existe promotor'); //retornar 2
                return 2;
            }
            
        }
    
        
        
    }

    public function guardarDatosProspecto(Request $request)
    {
        $valores = array(
            "folioCRM" => $request->folio_crm,
            "claveCampana" => 36,
            "clavePlantel" => 4,
            "claveNivel" => 2,
            "claveCarrera" =>  1,
            "claveHorario" => 1,
            "nombre" => $request->nombre_form,
            "apPaterno" => $request->apellidos_form,
            "apMaterno" => $request->apellido_mat_form,
            "telefono1" => $request->telefono_uno,
            "telefono2" => $request->telefono_dos,
            "celular1" => $request->celular_uno,
            "celular2" => $request->celular_dos,
        );

        app(PeticionesController::class)->guardarDatosGeneralesProspecto($valores);

        return redirect()->back();
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
        $mesesList = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];    
        $mesFinal = $numeroMes - 1 ;

        for ($i=0; $i <(sizeof($mesesList)-1); $i++) { 
            if($i == $mesFinal){
                return $mesesList[$i];
            }
        }
    }

    public function nombreDiaSemana($diaSemana) 
    {
       
        $diasSemanaList = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sabado", "Domingo"];
        $diaFinal = $diaSemana - 1;
        
        for ($i=1; $i < (sizeof($diasSemanaList) - 1); $i++) { 
            if($diaFinal == $i){
                return $diasSemanaList[$i];
            }
        }
    }
}
