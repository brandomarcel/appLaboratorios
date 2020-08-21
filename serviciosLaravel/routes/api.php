<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//aqui se especifica si es get post o put LABORATORISTAS
Route::get('devuelveUsuarios','usuarioscontroller@index');
Route::get('devuelveUsuariosxId/{idUsuario}','usuarioscontroller@consultaxId');
Route::post('guardaUsuarios','usuarioscontroller@store');

Route::put('actualizaUsuarios/{id}','usuarioscontroller@update');

Route::delete('eliminaUsuarios/{id}','usuarioscontroller@destroy');


//aqui se especifica si es get post o put ESTUDIANTES

Route::get('devuelveEstudiantes','estudiantescontroller@index');



Route::post('guardaEstudiantes','estudiantescontroller@store');

Route::put('actualizaEstudiantes/{id}','estudiantescontroller@update');

Route::delete('eliminaEstudiantes/{id}','estudiantescontroller@destroy');

//aqui se especifica si es get post o put Docentes

Route::get('devuelveDocentes','docentescontroller@index');

Route::post('guardaDocentes','docentescontroller@store');

Route::put('actualizaDocentes/{id}','docentescontroller@update');

Route::delete('eliminaDocentes/{id}','docentescontroller@destroy');

//aqui se especifica si es get post o put Invitados

Route::get('devuelveInvitados','invitadoscontroller@index');

Route::post('guardaDocentes','docentescontroller@store');

Route::put('actualizaDocentes/{id}','docentescontroller@update');

Route::delete('eliminaDocentes/{id}','docentescontroller@destroy');


//aqui se especifica si es get post o put Laboratorios
Route::get('devuelveLaboratorios','laboratorioscontroller@index');

Route::get('devuelveLaboratoriosjoin','laboratorioscontroller@indexJoin');

Route::get('devuelveLaboratoriosdisponibilidad','laboratorioscontroller@consultaxDisponibilidad');

Route::get('laboratorioOcupado','laboratorioscontroller@consultaOcupado');

Route::get('devuelveLaboratoriosxId/{idLaboratorio}','laboratorioscontroller@consultaxLaboratorio');

Route::post('guardaLaboratorios','laboratorioscontroller@store');

Route::put('actualizaLaboratorios/{id}','laboratorioscontroller@update');

Route::put('actualizaLaboratoriosInsertar/{id}','laboratorioscontroller@updateLaboratorio');

Route::delete('eliminaLaboratorios/{id}','laboratorioscontroller@destroy');

//aqui se especifica si es get post o put Tipo de Laboratorios
Route::get('devuelvetipoLaboratorios','tipolaboratorioscontroller@index');



//aqui se especifica si es get post o put MATERIAS
Route::get('devuelveMaterias','materiascontroller@index');

Route::get('devuelveMateriasxDocente/{idDocente}','materiascontroller@consultaxDocente');

Route::get('devuelveMateriasxMateria/{idMateria}','materiascontroller@consultaxMateria');

Route::post('guardaMaterias','materiascontroller@store');

Route::put('actualizaMaterias/{id}','materiascontroller@update');

Route::delete('eliminaMaterias/{id}','materiascontroller@destroy');

//Get Niveles en nivelescontroller
Route::get('devuelveNiveles','nivelescontroller@index');
//post de Registro


Route::get('devuelveRegistros','registroscontroller@index');
Route::get('devuelveUltimoReg','registroscontroller@consultaUltimo');

Route::get('devuelveRegistroxidreg/{idReg}','registroscontroller@consultaxRegistro');

Route::post('guardaRegistro','registroscontroller@store');

Route::get('devuelveMaquinasxidLab/{idLaboratorio}','registroscontroller@consultaDetalleregistro');

Route::post('guardaDetalleregistro','registroscontroller@storeDetalleregistro');

Route::put('actualizaEstado/{idReg}','registroscontroller@updateEstado');


//aqui se especifica si es get post o put HOrarios

Route::get('devuelveHorariosxidMateria/{idMateria}','HorariosController@consultaxMateriaHora');

Route::get('devuelveHorariosxDia/{idHora}','HorariosController@consultaxHora');

Route::get('devuelvedatosxDiaxLab/{dia}/{laboratorio}','HorariosController@consultaxDia');

Route::get('devuelvedatosxDiaxLabVaciasInicio/{dia}/{laboratorio}','HorariosController@horasVaciasInicio');
Route::get('devuelvedatosxDiaxLabVaciasFin/{dia}/{laboratorio}','HorariosController@horasVaciasFin');




//USUARIOSTODOS-Estudiante

Route::get('devuelveUsuariostodos/{tipo}','UsuariostodosController@consultaxTipo');

Route::post('guardaUsuariostodos','UsuariostodosController@guardaEstudiante');

Route::put('actualizaUsuariostodos/{id}','UsuariostodosController@update');

Route::delete('eliminaUsuariostodos/{id}','UsuariostodosController@destroy');


//DIA

Route::get('devuelveDias','DiaController@index');


//HORASASIGNADAS

Route::get('devuelveHorasOcupadas/{dia}/{laboratorio}','HorariosasignadosController@horasOcupadas');
Route::get('devuelveHorasLibres/{dia}','HorariosasignadosController@horaslibres');

Route::get('devuelvedia/{materia}','HorariosasignadosController@devuelvediaxMateria');


Route::get('devuelvedatosfalta/{materia}/{dia}','HorariosasignadosController@devuelvedatosfalta');
