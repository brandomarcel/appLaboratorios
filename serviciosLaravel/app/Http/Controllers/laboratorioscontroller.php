<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\laboratorios;

use Validator;

class laboratorioscontroller extends Controller
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
            'laboratorio' => laboratorios::all(),
            'HttpResponse' => [
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true,
                'mensajeConsulta' => 'Laboratorios consultados...'
            ]
        ],
        201
    );
    }

    public function consultaxDisponibilidad()
    {
        $laboratorios = laboratorios::join('tipolaboratorio','tipolaboratorio.id','=','laboratorio.tipo')
        ->where('disponibilidad','=','DISPONIBLE')
        ->select('laboratorio.id as id','laboratorio.nombre as nombre','tipolaboratorio.id as idlab','tipolaboratorio.nombre as nombrelab',
        'laboratorio.capacidad as capacidad','laboratorio.disponibilidad as disponibilidad','laboratorio.ubicacion as ubicacion')
        ->get();


        if (!$laboratorios) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo el laboratorio',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'laboratorio' => $laboratorios,
            'HttpResponse' => [
                
                'message' => 'Laboratorios consultados...',
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true
            ]
        ]);
    }

    public function consultaOcupado()
    {
        $laboratorios = laboratorios::join('tipolaboratorio','tipolaboratorio.id','=','laboratorio.tipo')
        ->where('disponibilidad','=','OCUPADO')
        ->select('laboratorio.id as id','laboratorio.nombre as nombre','tipolaboratorio.id as idlab','tipolaboratorio.nombre as nombrelab',
        'laboratorio.capacidad as capacidad','laboratorio.disponibilidad as disponibilidad','laboratorio.ubicacion as ubicacion')
        ->get();


        if (!$laboratorios) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo el laboratorio',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'laboratorio' => $laboratorios,
            'HttpResponse' => [
                
                'message' => 'Laboratorios consultados...',
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true
            ]
        ]);
    }



    public function consultaxLaboratorio($idLaboratorio)
    {
       


        $laboratorios = laboratorios::join('tipolaboratorio','tipolaboratorio.id','=','laboratorio.tipo')
        ->where('laboratorio.id','=',$idLaboratorio)
        ->select('laboratorio.id as id','laboratorio.nombre as nombre','tipolaboratorio.id as idlab','tipolaboratorio.nombre as nombrelab',
        'laboratorio.capacidad as capacidad','laboratorio.disponibilidad as disponibilidad','laboratorio.ubicacion as ubicacion')
        ->get();


        if (!$laboratorios) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo el laboratorio',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'laboratorio' => $laboratorios,
            'HttpResponse' => [
                
                'message' => 'Laboratorios consultados...',
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true
            ]
        ]);
    }
    
    


 //metodo con join
    public function indexJoin()
    {
        $laboratorios = laboratorios::join('tipolaboratorio','tipolaboratorio.id','=','laboratorio.tipo')
        ->select('laboratorio.id as id','laboratorio.nombre as nombre','tipolaboratorio.id as idlab','tipolaboratorio.nombre as nombrelab',
        'laboratorio.capacidad as capacidad','laboratorio.disponibilidad as disponibilidad','laboratorio.ubicacion as ubicacion')
        ->get();


        if (!$laboratorios) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo el laboratorio',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'laboratorio' => $laboratorios,
            'HttpResponse' => [
                
                'message' => 'Laboratorios consultados...',
                'status' => 200,
                'statusText' => 'error',
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
                'nombre' => 'required|string',//sea requerido y string
                'tipo' => 'required',//sea requerido y string
                'capacidad' => 'required',//sea requerido y string
                'disponibilidad' => 'required',//sea requerido y string
                'ubicacion' => 'required',//sea requerido y string
               
                
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



        $laboratorios = new laboratorios();
        

        
        $laboratorios->nombre = $request->nombre;
        $laboratorios->tipo = $request->tipo;
        $laboratorios->capacidad = $request->capacidad;
        $laboratorios->disponibilidad = $request->disponibilidad;
        $laboratorios->ubicacion = $request->ubicacion;


    

        //echo($laboratorios);

        $laboratorios->save();

        return response()->json(
            [
                'laboratorio' => $laboratorios,
                'HttpResponse' => [
                    'tittle' => 'Correcto',
                    'message' => 'Nueva laboratorio creado!',
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
        $laboratorios = laboratorios::find($id); //el find coje el primarykey
        // $categoria = categories::where('shortname', $pepito)->get();
         //$pedidos = Pedido::where('idUsuario', $id)->orderBy('fechahoraPedido', 'desc')->get();
         if (!$laboratorios) {
             return response()->json([
                 'HttpResponse' => [
                     'tittle' => 'Error',
                     'message' => 'No se encontro el Laboratorio!',
                     'status' => 400,
                     'statusText' => 'error',
                     'ok' => true
                 ]
             ]);
         }
 
 
         $validation = Validator::make(
             $request->all(),
             [
                'nombre' => 'required|string',//sea requerido y string
                'tipo' => 'required',//sea requerido y string
                'capacidad' => 'required',//sea requerido y string
                'disponibilidad' => 'required',//sea requerido y string
                'ubicacion' => 'required',//sea requerido y string
             
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
 
 

        
         $laboratorios->nombre = $request->nombre;
         $laboratorios->tipo = $request->tipo;
         $laboratorios->capacidad = $request->capacidad;
         $laboratorios->disponibilidad = $request->disponibilidad;
         $laboratorios->ubicacion = $request->ubicacion;
      
         
 
         $laboratorios->save();
 
         return response()->json(
             [
                 'laboratorio' => $laboratorios,
                 'HttpResponse' => [
                     'tittle' => 'Correcto',
                     'message' => 'Laboratorio actualizado!',
                     'status' => 200,
                     'statusText' => 'success',
                     'ok' => true
                 ],
             ],
             201
         );
    }


    public function updateLaboratorio($id)
    {
        $laboratorios = laboratorios::find($id);
       
        if ($laboratorios->disponibilidad == 'DISPONIBLE') {
            $laboratorios->disponibilidad = 'OCUPADO';
            $laboratorios->save();


        }else {
            $laboratorios->disponibilidad = 'DISPONIBLE';
            $laboratorios->save();

        }


        if (!$laboratorios) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo el laboratorio',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'laboratorio' => $laboratorios,
            'HttpResponse' => [
                
                'message' => 'Laboratorios ACTUALIZADO...',
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
          $laboratorios = laboratorios::find($id);

          if (!$laboratorios) {
              return response()->json([
                  'HttpResponse' => [
                      'tittle' => 'Error',
                      'message' => 'No se encontro el Laboratorio!',
                      'status' => 400,
                      'statusText' => 'error',
                      'ok' => true
                  ]
              ]);
          }
  
          try {
              $laboratorios->delete();
  
              return response()->json([
                  'HttpResponse' => [
                      'tittle' => 'Correcto',
                      'message' => 'Laboratorio eliminado!',
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
