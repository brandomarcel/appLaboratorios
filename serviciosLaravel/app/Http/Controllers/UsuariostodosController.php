<?php

namespace App\Http\Controllers;

use App\usuariostodos;
use Illuminate\Http\Request;
use Validator;


class UsuariostodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tipo)
    {
        

    }


    public function consultaxTipo($tipo)
    {
        $usuariostodos = usuariostodos::where('usuarios.tipo', '=',  $tipo)
        ->select('usuarios.*')
        ->get();


        if (!$usuariostodos) {
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
            'usuariostodos' => $usuariostodos,
            'HttpResponse' => [
                
                'message' => 'Estudiante consultado...',
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
    public function guardaEstudiante(Request $request)
    {
          //en el request yo recivo el nombre apellido etc.. depedne de lo que necesite
          $validation = Validator::make(
            $request->all(),
            [
                'id' => 'required',//sea requerido 
                'nombre' => 'required|string',//sea requerido y string
                'apellido' => 'required|string',//sea requerido y string
                'tipo' => 'required',//sea requerido y string
               
                
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



        $usuariostodos = new usuariostodos();
        

        $usuariostodos->id = $request->id;
        $usuariostodos->nombre = $request->nombre;
        $usuariostodos->apellido = $request->apellido;
        $usuariostodos->tipo = $request->tipo;


    

        //echo($estudiantes);

        $usuariostodos->save();

        return response()->json(
            [
                'usuariostodos' => $usuariostodos,
                'HttpResponse' => [
                    'tittle' => 'Correcto',
                    'message' => 'Nueva estudiante creado!',
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
     * @param  \App\usuariostodos  $usuariostodos
     * @return \Illuminate\Http\Response
     */
    public function show(usuariostodos $usuariostodos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\usuariostodos  $usuariostodos
     * @return \Illuminate\Http\Response
     */
    public function edit(usuariostodos $usuariostodos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\usuariostodos  $usuariostodos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          //
          $usuariostodos = usuariostodos::find($id); //el find coje el primarykey
          // $categoria = categories::where('shortname', $pepito)->get();
           //$pedidos = Pedido::where('idUsuario', $id)->orderBy('fechahoraPedido', 'desc')->get();
           if (!$usuariostodos) {
               return response()->json([
                   'HttpResponse' => [
                       'tittle' => 'Error',
                       'message' => 'No se encontro usuariostodos!',
                       'status' => 400,
                       'statusText' => 'error',
                       'ok' => true
                   ]
               ]);
           }
   
   
           $validation = Validator::make(
               $request->all(),
               [
                   'id' => 'required',//sea requerido 
                   'nombre' => 'required|string',//sea requerido y string
                   'apellido' => 'required|string',//sea requerido y string
               
               ]
           );
           if ($validation->fails()) {
               return response()->json(
                   [
                       'HttpResponse' => [
                           'tittle' => 'Error',
                           'message' => 'No hay parametros correctos!',
                           'status' => 400,
                           'statusText' => 'error',
                           'ok' => true
                       ]
                   ]
               );
           }
   
   
           $usuariostodos->id = $request->id;
           $usuariostodos->nombre = $request->nombre;
           $usuariostodos->apellido = $request->apellido;
    
   
        
           
   
           $usuariostodos->save();
   
           return response()->json(
               [
                   'usuariostodos' => $usuariostodos,
                   'HttpResponse' => [
                       'tittle' => 'Correcto',
                       'message' => 'usuariostodos actualizado!',
                       'status' => 200,
                       'statusText' => 'success',
                       'ok' => true
                   ],
               ],
               201
           );
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\usuariostodos  $usuariostodos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //
         $usuariostodos = usuariostodos::find($id);

         if (!$usuariostodos) {
             return response()->json([
                 'HttpResponse' => [
                     'tittle' => 'Error',
                     'message' => 'No se encontro el Estudiante!',
                     'status' => 400,
                     'statusText' => 'error',
                     'ok' => true
                 ]
             ]);
         }
 
         try {
             $usuariostodos->delete();
 
             return response()->json([
                 'HttpResponse' => [
                     'tittle' => 'Correcto',
                     'message' => 'Estudiante eliminado!',
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
