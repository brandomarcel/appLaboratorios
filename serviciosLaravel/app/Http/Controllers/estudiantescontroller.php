<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\estudiantes;

use Validator;


class estudiantescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    //metodo para que me devuelva todo
    return response()->json(
        [
            'estudiante' => estudiantes::all(),
            'HttpResponse' => [
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true,
                'mensajeConsulta' => 'Estudiantes consultados...'
            ]
        ],
        201
    );



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
                        'message' => 'Es obligatorio llenar todos los datos..',
                        'status' => 400,
                        'statusText' => 'error',
                        'ok' => true
                    ]
                ]
            );
        }



        $estudiantes = new estudiantes();
        

        $estudiantes->id = $request->id;
        $estudiantes->nombre = $request->nombre;
        $estudiantes->apellido = $request->apellido;


    

        //echo($estudiantes);

        $estudiantes->save();

        return response()->json(
            [
                'estudiante' => $estudiantes,
                'HttpResponse' => [
                    'tittle' => 'Correcto',
                    'message' => 'Nueva usuario creado!',
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
    public function update(Request $request, $id)
    {
           //
           $estudiantes = estudiantes::find($id); //el find coje el primarykey
           // $categoria = categories::where('shortname', $pepito)->get();
            //$pedidos = Pedido::where('idUsuario', $id)->orderBy('fechahoraPedido', 'desc')->get();
            if (!$estudiantes) {
                return response()->json([
                    'HttpResponse' => [
                        'tittle' => 'Error',
                        'message' => 'No se encontro al Estudiante!',
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
    
    
            $estudiantes->id = $request->id;
            $estudiantes->nombre = $request->nombre;
            $estudiantes->apellido = $request->apellido;
     
    
         
            
    
            $estudiantes->save();
    
            return response()->json(
                [
                    'estudiante' => $estudiantes,
                    'HttpResponse' => [
                        'tittle' => 'Correcto',
                        'message' => 'Estudiante actualizado!',
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
           //
           $estudiantes = estudiantes::find($id);

           if (!$estudiantes) {
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
               $estudiantes->delete();
   
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
