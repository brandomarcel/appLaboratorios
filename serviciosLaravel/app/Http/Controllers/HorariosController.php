<?php

namespace App\Http\Controllers;

use App\horarios;
use Illuminate\Http\Request;

class HorariosController extends Controller
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


    public function consultaxMateriaHora($idMateria)
    {
        $horarios = horarios::join('materia','materia.id','=','horarios.idMateria')
        ->where('horarios.idMateria','=',$idMateria)
        ->select('horarios.*')
        ->get();


        if (!$horarios) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo el Horario',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'horarios' => $horarios,
            'HttpResponse' => [
                
                'message' => 'Dias consultados...',
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true
            ]
        ]);
    }

    public function consultaxDia($dia, $laboratorio)
    {

       
        $horarios = horarios::join('laboratorio','laboratorio.id','=','horarios.idLaboratorio')
        ->join('materia','materia.id','=','horarios.idMateria')
        ->join('usuarios','usuarios.id','=','materia.idDocente')
        ->select('horarios.*','laboratorio.nombre as nomLaboratorio','laboratorio.capacidad as capLaboratorio',
        'laboratorio.ubicacion as ubicLaboratorio','materia.nombre as nomMateria','usuarios.nombre as nomDocente',
        'usuarios.apellido as apeDocente')
        ->where('horarios.dia','=',$dia)
        ->where('horarios.idLaboratorio','=',$laboratorio)        
        ->get();
        


        if (!$horarios) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo el Laboratorio',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'horarios' => $horarios,
            'HttpResponse' => [
                
                'message' => 'Laboratorios consultados...',
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true
            ]
        ]);
    }

    public function consultaxHora($idHora)
    {

        $horarios = horarios::join('laboratorio','laboratorio.id','=','horarios.idLaboratorio')
        ->where('horarios.id','=',$idHora)
        ->select('horarios.*','laboratorio.nombre as nomLaboratorio','laboratorio.capacidad as capLaboratorio',
        'laboratorio.ubicacion as ubicLaboratorio')
        ->get();


        if (!$horarios) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo el Horario',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'horarios' => $horarios,
            'HttpResponse' => [
                
                'message' => 'Horarios consultados...',
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
     * @param  \App\horarios  $horarios
     * @return \Illuminate\Http\Response
     */
    public function show(horarios $horarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\horarios  $horarios
     * @return \Illuminate\Http\Response
     */
    public function edit(horarios $horarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\horarios  $horarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, horarios $horarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\horarios  $horarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(horarios $horarios)
    {
        //
    }
}
