<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\materias;

use Validator;

class materiascontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materias = materias::join('docente','docente.id','=','materia.idDocente')
        ->join('nivel','nivel.id','=','materia.idNivel')
        ->join('carrera','carrera.id','=','nivel.idCarrera')
        ->join('periodo','periodo.id','=','carrera.idPeriodo')
        ->select('materia.*','docente.nombre as NomDocente','nivel.idCarrera as idCarrera','nivel.nombre as nomNivel','carrera.nombre as carNombre','periodo.nombre as perNombre')
        ->get();


        if (!$materias) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo el Materia',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'materia' => $materias,
            'HttpResponse' => [
                
                'message' => 'Materias consultados...',
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true
            ]
        ]);
    }

    public function consultaxDocente($idDocente)
    {
        $materias = materias::join('usuarios','usuarios.id','=','materia.idDocente')
        ->join('nivel','nivel.id','=','materia.idNivel')
        ->join('carrera','carrera.id','=','nivel.idCarrera')
        ->join('periodo','periodo.id','=','carrera.idPeriodo')
        ->where('usuarios.id','=',$idDocente)
        ->select('materia.*','nivel.nombre as nomNivel','carrera.nombre as carNombre','periodo.nombre as perNombre')
        ->get();


        if (!$materias) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo el Materia',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'materia' => $materias,
            'HttpResponse' => [
                
                'message' => 'Materias consultadas...',
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true
            ]
        ]);
    }

    public function consultaxMateria($idMateria)
    {
        $materias = materias::join('usuarios','usuarios.id','=','materia.idDocente')
        ->join('nivel','nivel.id','=','materia.idNivel')
        ->join('carrera','carrera.id','=','nivel.idCarrera')
        ->join('periodo','periodo.id','=','carrera.idPeriodo')
        ->where('materia.id','=',$idMateria)
        ->select('materia.*','nivel.nombre as nomNivel','carrera.nombre as carNombre','periodo.nombre as perNombre')
        ->get();


        if (!$materias) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo el Materia',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'materia' => $materias,
            'HttpResponse' => [
                
                'message' => 'Materias consultadas...',
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materias = materias::find($id);

        if (!$materias) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se encontro la materia!',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }

        try {
            $materias->delete();

            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Correcto',
                    'message' => 'Materia eliminada!',
                    'status' => 200,
                    'statusText' => 'success',
                    'ok' => true
                ],
            ]);
        } catch (Exception $e) {

            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'Algo salio mal, intende nuevamente!',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);


    }

    }
}
