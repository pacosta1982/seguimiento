<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Mensajes
Route::group(['prefix' => 'messages'], function () {
  Route::get('/', ['as' => 'messages.index', 'uses' => 'MessagesController@index']);
  Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
  Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
  Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
  Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});

Route::get('qr-code', function () 
{
  return QRCode::url('www.senvitat.com')->setSize(10)->png();    
});

Route::get('generate', 'HomeController@generateDocx');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('dashboard', 'DashBoardController');
Route::resource('tasks', 'TasksController');


Route::resource('projects', 'ProjectController');
Route::resource('proyrubro', 'PlanRubroProyController');

//Generarviviendas
Route::get('projects/{id}/generarviviendas', 'ProjectController@generarviviendas');

//Route::resource('informes', 'ProjectController');

Route::get('projects/ajax/{state_id?}/cities', 'ProjectController@cities');
Route::get('projects/ajax/{city_id?}/neighborhood', 'ProjectController@neighborhoods');

//Ajax rubros
Route::get('proyrubro/ajax/{state_id?}/cities', 'PlanRubroProyController@rubros'); 

Route::get('projects/{id}/files', 'ProjectController@files');

//Informes
Route::get('projects/{id}/informes', 'ReportController@index');
Route::get('projects/{id}/informes/create', 'ReportController@create');
Route::post('savereport', 'ReportController@store');
Route::get('projects/{id}/informes/{idvisita}', 'ReportController@show');

//Viviendas
Route::get('projects/{id}/informes/{idvisita}/{idvivienda}', 'ViviendaController@index');
Route::post('save_vivienda', 'ViviendaController@store')->name('save_vivienda');


//Fotos
Route::get('image-gallery', 'ImageGalleryController@index');
Route::post('image-gallery', 'ImageGalleryController@upload');
Route::delete('image-gallery/{id}', 'ImageGalleryController@destroy');


Route::post('file/upload', 'ProjectController@storeFile');
Route::post('upload_file_proyecto', 'FileController@upload')->name('upload_file_proyecto');

Route::get('/generate_pdf/{id?}/{file?}', 'FileController@generate_pdf');
Route::get ('github', 'FileController@github');

Route::get('/chartPdf', 'ChartController@index');


Route::get('/import', 'ImportController@import');



Route::get('/importestates', 'ImportController@importestates');
Route::get('/importstatus', 'ImportController@importstatus');