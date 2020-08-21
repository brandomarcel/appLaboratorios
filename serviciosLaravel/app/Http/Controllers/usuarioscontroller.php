<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\usuarios;

use Validator;


class usuarioscontroller extends Controller
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
            'usuario' => usuarios::all(),
            'HttpResponse' => [
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true,
                'mensajeConsulta' => 'usuarios consultados...'
            ]
        ],
        201
    );




    }




    public function consultaxId($idUsuario)
    {
        $usuarios = usuarios::where('usuario.id','=',$idUsuario)
        ->select('usuario.*')
        ->get();


        if (!$usuarios) {
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
            'usuario' => $usuarios,
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
    public function store(Request $request)//una funcion que resive una solicitud que es la request
    {
        //en el request yo recivo el nombre apellido etc.. depedne de lo que necesite
        $validation = Validator::make(
            $request->all(),
            [
                'id' => 'required',//sea requerido 
                'nombre' => 'required|string',//sea requerido y string
                'apellido' => 'required|string',//sea requerido y string
                'email' => 'required|string',//sea requerido y string
                'telefono' => 'required|string',//sea requerido y string
                'direccion' => 'required|string',//sea requerido y string
                'password' => 'required|string',//sea requerido y string
                'tipoUsuario' => 'required',
                
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



        $usuarios = new usuarios();
        

        $usuarios->id = $request->id;
        $usuarios->nombre = $request->nombre;
        $usuarios->apellido = $request->apellido;
        $usuarios->email = $request->email;
        $usuarios->telefono = $request->telefono;
        $usuarios->direccion = $request->direccion;
        $usuarios->password = $request->password;
        $usuarios->tipoUsuario = $request->tipoUsuario;

    

        //echo($usuarios);

        $usuarios->save();

        return response()->json(
            [
                'usuarios' => $usuarios,
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
               $usuarios = usuarios::find($id); //el find coje el primarykey
               // $categoria = categories::where('shortname', $pepito)->get();
                //$pedidos = Pedido::where('idUsuario', $id)->orderBy('fechahoraPedido', 'desc')->get();
                if (!$usuarios) {
                    return response()->json([
                        'HttpResponse' => [
                            'tittle' => 'Error',
                            'message' => 'No se encontro al usuario!',
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
                        'email' => 'required|string',//sea requerido y string
                        'telefono' => 'required|string',//sea requerido y string
                        'direccion' => 'required|string',//sea requerido y string
                        'password' => 'required|string',//sea requerido y string
                        'tipoUsuario' => 'required',
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
        
        
                $usuarios->id = $request->id;
                $usuarios->nombre = $request->nombre;
                $usuarios->apellido = $request->apellido;
                $usuarios->email = $request->email;
                $usuarios->telefono = $request->telefono;
                $usuarios->direccion = $request->direccion;
                $usuarios->password = $request->password;
                $usuarios->tipoUsuario = $request->tipoUsuario;
        
             
                
        
                $usuarios->save();
        
                return response()->json(
                    [
                        'usuarios' => $usuarios,
                        'HttpResponse' => [
                            'tittle' => 'Correcto',
                            'message' => 'Usuario actualizado!',
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
          $usuarios = usuarios::find($id);

          if (!$usuarios) {
              return response()->json([
                  'HttpResponse' => [
                      'tittle' => 'Error',
                      'message' => 'No se encontro el Usuario!',
                      'status' => 400,
                      'statusText' => 'error',
                      'ok' => true
                  ]
              ]);
          }
  
          try {
              $usuarios->delete();
  
              return response()->json([
                  'HttpResponse' => [
                      'tittle' => 'Correcto',
                      'message' => 'Usuario eliminado!',
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
