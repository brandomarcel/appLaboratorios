<?php

namespace App\Http\Controllers;

use App\horariosasignados;
use App\dia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HorariosasignadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function horasOcupadas($dia, $laboratorio)
    {


       
        $horasOcupadas = horariosasignados::join('materia','materia.id','=','horariosasignados.idMateria')
        ->join('usuarios','usuarios.id','=','materia.idDocente')
        ->join('detallehorariosasignados','detallehorariosasignados.idHorariosasginados','=','horariosasignados.id')
        ->join('horadia','horadia.id','=','detallehorariosasignados.idHoradia')
        ->join('hora','hora.id','=','horadia.idHora')
        ->join('dia','dia.id','=','horadia.idDia')

        ->select('usuarios.nombre as nomDocente','materia.nombre as nomMateria','hora.horaInicio','hora.horaFin')
               
        ->where('dia.id','=',$dia)
        ->where('horariosasignados.idLaboratorio','=',$laboratorio)        
        ->get();
        


        if (!$horasOcupadas) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo ',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'horarasOcupadas' => $horasOcupadas,
            'HttpResponse' => [
                
                'message' => 'consultados...',
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true
            ]
        ]);

    }

    public function horaslibres($dia)
    {

       
        $horaslibres = dia::join('horadia','horadia.idDia','=','dia.id')
        ->join('hora','hora.id','=','horadia.idHora')
        

        ->select('hora.horaInicio','hora.horaFin')
               
        ->where('horadia.idDia','=',$dia)
             
        ->get();
        


        if (!$horaslibres) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo ',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'horaslibres' => $horaslibres,
            'HttpResponse' => [
                
                'message' => 'consultados...',
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true
            ]
        ]);

    }

    public function devuelvediaxMateria($materia)
    {
       
       
       

        $diaxMateria = horariosasignados::join('detallehorariosasignados','detallehorariosasignados.idHorariosasginados','=','horariosasignados.id')
        ->join('horadia','horadia.id','=','detallehorariosasignados.idHoradia')
        ->join('dia','dia.id','=','horadia.idDia')
        
   

        ->select('dia.dia')
               
        ->where('horariosasignados.idMateria','=',$materia)
        ->groupby('dia.dia')
        ->orderby('dia.dia','DESC')
           
        ->get();
        


        if (!$diaxMateria) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo ',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'diaxmateria' => $diaxMateria,
            'HttpResponse' => [
                
                'message' => 'consultados...',
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true
            ]
        ]);

    }

    public function devuelvedatosfalta($materia,$dia)
    {
       

        $xdiaxMateriadatos = horariosasignados::join('detallehorariosasignados','detallehorariosasignados.idHorariosasginados','=','horariosasignados.id')
        ->join('horadia','horadia.id','=','detallehorariosasignados.idHoradia')
        ->join('dia','dia.id','=','horadia.idDia')
        ->join('laboratorio','laboratorio.id','=','horariosasignados.idLaboratorio')
        ->join('hora','hora.id','=','horadia.idHora')
          
      
      
        ->select('laboratorio.nombre as labNombre','laboratorio.id as labId','laboratorio.ubicacion as labUbicacion','laboratorio.capacidad as labCapacidad')   
        ->selectraw('MIN(hora.horaInicio) as horaInicio')
        
        ->selectraw('MAX(hora.horaFin) as horaFin')     
               
        ->where('horariosasignados.idMateria','=',$materia)
        ->where('dia.dia','=',$dia)
        ->groupby('laboratorio.nombre')
        ->groupby('dia.dia')
        ->groupby('laboratorio.ubicacion')
        ->groupby('laboratorio.capacidad')
        ->groupby('laboratorio.id')
        
        
           
        ->get();
        
        if (!$xdiaxMateriadatos) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo ',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'xdiaxmateriadatos' => $xdiaxMateriadatos,
            'HttpResponse' => [
                
                'message' => 'consultados. devuelvedatosfalta..',
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true
            ]
        ]);

    }


  

    

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\horariosasignados  $horariosasignados
     * @return \Illuminate\Http\Response
     */
    public function show(horariosasignados $horariosasignados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\horariosasignados  $horariosasignados
     * @return \Illuminate\Http\Response
     */
    public function edit(horariosasignados $horariosasignados)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\horariosasignados  $horariosasignados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, horariosasignados $horariosasignados)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\horariosasignados  $horariosasignados
     * @return \Illuminate\Http\Response
     */
    public function destroy(horariosasignados $horariosasignados)
    {
        //
    }
}
