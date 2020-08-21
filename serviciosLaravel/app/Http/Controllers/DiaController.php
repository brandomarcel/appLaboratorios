<?php

namespace App\Http\Controllers;

use App\dia;
use Illuminate\Http\Request;

class DiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            [
                'dia' => dia::all(),
                'HttpResponse' => [
                    'status' => 200,
                    'statusText' => 'OK',
                    'ok' => true,
                    'mensajeConsulta' => 'Dias consultados...'
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\dia  $dia
     * @return \Illuminate\Http\Response
     */
    public function show(dia $dia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\dia  $dia
     * @return \Illuminate\Http\Response
     */
    public function edit(dia $dia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\dia  $dia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, dia $dia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\dia  $dia
     * @return \Illuminate\Http\Response
     */
    public function destroy(dia $dia)
    {
        //
    }
}
