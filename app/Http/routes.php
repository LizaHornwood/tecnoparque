<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {    
//     return view('index');
// });

Route::get('/', 'FrontController@index');
Route::get('principal', 'FrontController@principal');
Route::get('log', 'FrontController@log');

Route::get('asistencia/{idDetEventoPersona}', ['as' => 'asistencia.index', 'uses' => 'DetEventoPersonaController@index']);

// Route::get('header',function(){
// 	return view('prueba');
// });
Route::post("reporteAsistenciaFuera", array(
    "as"=>"reporteAsistenciaFuera",
    "uses"=>"ReporteController@reporteAsistenciaFuera"
));

Route::post("reporteAsistenciaDentro", array(
    "as"=>"reporteAsistenciaDentro",
    "uses"=>"ReporteController@reporteAsistenciaDentro"
));

Route::post("reporteAsistenciaCompleta", array(
    "as"=>"reporteAsistenciaCompleta",
    "uses"=>"ReporteController@reporteAsistenciaCompleta"
));

Route::post("reporteGestores", array(
    "as"=>"reporteGestores",
    "uses"=>"ReporteController@reporteGestores"
));

Route::post("reporteGestoresCompleto", array(
    "as"=>"reporteGestoresCompleto",
    "uses"=>"ReporteController@reporteGestoresCompleto"
));

Route::post("reporteIngresos", array(
    "as"=>"reporteIngresos",
    "uses"=>"ReporteController@reporteIngresos"
));

//controladores RESTful

Route::resource('login','LoginController'); 
Route::get('logout','LoginController@logout');
Route::resource('usuario', 'UsuarioController');
Route::resource('servicio', 'ServicioController');
Route::resource('evento', 'EventoController');
Route::resource('tipoDocumento', 'TipoDocumentoController');
Route::resource('tipoPersona', 'TipoPersonaController');
Route::resource('lugar','LugarController');

Route::resource('persona', 'PersonaController');

Route::resource('asistencia', 'DetEventoPersonaController', ['except' => ['index']]);

Route::resource('ingreso', 'IngresoController');

Route::resource('ciudad', 'CiudadController');
Route::resource('nivelAcademico', 'NivelAcademicoController');
Route::resource('talento', 'TalentoController');
Route::resource('recurso', 'RecursoController');
Route::resource('infraestructura', 'InfraestructuraController');
Route::resource('detInfraestructuraPersona', 'DetInfraestructuraPersonaController');
Route::resource('tipoProyecto', 'TipoProyectoController');
Route::resource('estadoProyecto', 'EstadoProyectoController');
Route::resource('fechaEntrenamiento', 'FechaEntrenamientoController');
Route::resource('tipoGestor', 'TipoGestorController');
Route::resource('lineaTecnologica', 'LineaTecnologicaController');
Route::resource('gestor', 'GestorController');
Route::resource('areaConocimiento', 'AreaConocimientoController');
Route::resource('clasificacion', 'ClasificacionController');
Route::resource('proyecto', 'ProyectoController');
Route::resource('entrenamiento', 'EntrenamientoController');
Route::resource('detPersonaProyecto', 'DetPersonaProyController');
Route::resource('reporte', 'ReporteController');





  