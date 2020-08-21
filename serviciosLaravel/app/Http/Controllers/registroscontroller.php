<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\registro;

use App\laboratorios;

use App\detalleRegistro;

use Validator;


class registroscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registro = registro::where('registro.estado','=',1)
        ->select('registro.*')
        ->get();
        


        if (!$registro) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo el Registro',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'registro' => $registro,
            'HttpResponse' => [
                
                'message' => 'Registro x  ID consultados...',
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true
            ]
        ]);
    }


    public function consultaUltimo()
    {
        $registro = registro::where('registro.estado','=',1)
        ->orderBy('registro.id', 'desc')
        ->select('registro.*')
        ->first();
        


        if (!$registro) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo el Registro',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'registro' => $registro,
            'HttpResponse' => [
                
                'message' => 'Registro x  ID consultados...',
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true
            ]
        ]);
    }
    //->orderBy('registro.id', 'desc')
    //->first();

    public function consultaxRegistro($idRegistro)
    {
        $registro = registro::join('usuario','usuario.id','=','registro.idLaboratorista')
        ->join('usuarios','usuarios.id','=','registro.idUsuarios')
        ->join('materia','materia.id','=','registro.idMateria')
        ->join('laboratorio','laboratorio.id','=','registro.idLaboratorio')
        ->where('registro.id','=',$idRegistro)
        ->select('registro.id as idReg','registro.fechaRegistro as fechaRegistro','registro.horaInicio as horaInicio','registro.horaFin as horaFin',
        'registro.Tema as Tema','registro.idLaboratorista as idLaboratorista','usuario.nombre as nombreLaboratorista','usuario.apellido as apellidoLaboratorista',
        'registro.idUsuarios as idUsuarios','usuarios.nombre as nombreUsuarios','usuarios.apellido as apellidoUsuarios','registro.idMateria as idMateria',
        'materia.nombre as nombreMateria','registro.idLaboratorio as idLaboratorio','laboratorio.nombre as nombreLaboratorio')
      ->orderBy('registro.id', 'desc')
        ->get();
        


        if (!$registro) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo el Registro',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'registro' => $registro,
            'HttpResponse' => [
                
                'message' => 'Registro x  ID consultados...',
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true
            ]
        ]);
    }


    public function consultaDetalleregistro($idLaboratorio)
    {
        $detalleregistro = laboratorios::join('detallelaboratorio','detallelaboratorio.idLaboratorio','=','laboratorio.id')
        ->join('equipo','equipo.id','=','detallelaboratorio.idEquipo')
        ->where('laboratorio.id','=',$idLaboratorio)
        ->select('equipo.id as idEquipo','equipo.nombre as equiNombre')
      //->orderBy('registro.id', 'desc')
        ->get();
        


        if (!$detalleregistro) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo el detalleregistro',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'detalleregistro' => $detalleregistro,
            'HttpResponse' => [
                
                'message' => 'detalleregistro x  ID consultados...',
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
         //en el request yo recivo el nombre apellido etc.. depedne de lo que necesite
         $validation = Validator::make(
            $request->all(),
            [
                
                'fechaRegistro' => 'required',//sea requerido y string
                'horaInicio' => 'required',//sea requerido y string
                'horaFin' => 'required',//sea requerido y string
                'Tema' => 'required',//sea requerido y string
                'idLaboratorista' => 'required',//sea requerido y string
                'idUsuarios' => 'required',//sea requerido y string
                'idMateria' => 'required',
                'idLaboratorio' => 'required',
                
                
                
            ]
        );


        if ($validation->fails()) {
            return response()->json(
                [
                    'HttpResponse' => [
                        'tittle' => 'Error',
                        'message' => 'Es obligatorio llenar todos los datos..',
                        'status' => 400,
                        'statusText' => 'error',
                        'ok' => true
                    ]
                ]
            );
        }



        $registro = new registro();
        

        $registro->fechaRegistro = $request->fechaRegistro;
        $registro->horaInicio = $request->horaInicio;
        $registro->horaFin = $request->horaFin;
        $registro->Tema = $request->Tema;
        $registro->idLaboratorista = $request->idLaboratorista;
        $registro->idUsuarios = $request->idUsuarios;
        $registro->idMateria = $request->idMateria;
        $registro->idLaboratorio = $request->idLaboratorio;
        $registro->estado = 1;

    

        //echo($usuarios);

        $registro->save();

        return response()->json(
            [
                'registro' => $registro,
                'HttpResponse' => [
                    'tittle' => 'Correcto',
                    'message' => 'Nuevo Registro Creado!',
                    'status' => 200,
                    'statusText' => 'success',
                    'ok' => true
                ],
            ],
            201
        );



    }


    public function storeDetalleregistro(Request $request)
    {
         //en el request yo recivo el nombre apellido etc.. depedne de lo que necesite
         $validation = Validator::make(
            $request->all(),
            [
                
                'idRegistro' => 'required',//sea requerido y string
                'nombrePc' => 'required',//sea requerido y string
                'idEstudiante' => 'required',//sea requerido y string
                'observacion' => 'required',//sea requerido y string
               
                
            ]
        );


        if ($validation->fails()) {
            return response()->json(
                [
                    'HttpResponse' => [
                        'tittle' => 'Error',
                        'message' => 'Es obligatorio llenar todos los datos..',
                        'status' => 400,
                        'statusText' => 'error',
                        'ok' => true
                    ]
                ]
            );
        }



        $detalleRegistro = new detalleRegistro();
        

        $detalleRegistro->idRegistro = $request->idRegistro;
        $detalleRegistro->nombrePc = $request->nombrePc;
        $detalleRegistro->idEstudiante = $request->idEstudiante;
        $detalleRegistro->observacion = $request->observacion;
        
    

        //echo($usuarios);

        $detalleRegistro->save();

        return response()->json(
            [
                'detalleRegistro' => $detalleRegistro,
                'HttpResponse' => [
                    'tittle' => 'Correcto',
                    'message' => 'Nuevo detalleRegistro Creado!',
                    'status' => 200,
                    'statusText' => 'success',
                    'ok' => true
                ],
            ],
            201
        );



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
    public function updateEstado($idReg)
    {
        $registro = registro::find($idReg);
       
        
            $registro->estado = '0';
            $registro->save();



        if (!$registro) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo el registro',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'updateEstado' => $registro,
            'HttpResponse' => [
                
                'message' => 'updateEstado ACTUALIZADO...',
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
