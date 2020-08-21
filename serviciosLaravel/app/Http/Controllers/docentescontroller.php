<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\docentes;

use Validator;


class docentescontroller extends Controller
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
            'docente' => docentes::all(),
            'HttpResponse' => [
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true,
                'mensajeConsulta' => 'Docentes consultados...'
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



        $docentes = new docentes();
        

        $docentes->id = $request->id;
        $docentes->nombre = $request->nombre;
        $docentes->apellido = $request->apellido;


    

        //echo($docentes);

        $docentes->save();

        return response()->json(
            [
                'docente' => $docentes,
                'HttpResponse' => [
                    'tittle' => 'Correcto',
                    'message' => 'Nueva docente creado!',
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
          $docentes = docentes::find($id); //el find coje el primarykey
          // $categoria = categories::where('shortname', $pepito)->get();
           //$pedidos = Pedido::where('idUsuario', $id)->orderBy('fechahoraPedido', 'desc')->get();
           if (!$docentes) {
               return response()->json([
                   'HttpResponse' => [
                       'tittle' => 'Error',
                       'message' => 'No se encontro al Docente!',
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
   
   
           $docentes->id = $request->id;
           $docentes->nombre = $request->nombre;
           $docentes->apellido = $request->apellido;
    
   
        
           
   
           $docentes->save();
   
           return response()->json(
               [
                   'docente' => $docentes,
                   'HttpResponse' => [
                       'tittle' => 'Correcto',
                       'message' => 'Docente actualizado!',
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
          $docentes = docentes::find($id);

          if (!$docentes) {
              return response()->json([
                  'HttpResponse' => [
                      'tittle' => 'Error',
                      'message' => 'No se encontro el Docente!',
                      'status' => 400,
                      'statusText' => 'error',
                      'ok' => true
                  ]
              ]);
          }
  
          try {
              $docentes->delete();
  
              return response()->json([
                  'HttpResponse' => [
                      'tittle' => 'Correcto',
                      'message' => 'Docente eliminado!',
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
