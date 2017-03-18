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

Route::get('/',function (){
  return view('welcome');
});

//Ayuda
Route::get('/help',function (){
  return view('welcome');
});
//

//Login registro
Route::get('/logout','Cliente\CuentaController@logout');
Route::match(['GET','POST'],'/registro','Cliente\CuentaController@registrar');
Route::match(['GET','POST'],'/login','Cliente\CuentaController@login');
Route::get('/registro/verificar/{codigo}','Cliente\CuentaController@confirmar');
Route::get('/social/{provider?}', 'Cliente\CuentaController@getSocialAuth');
Route::get('/social/callback/{provider?}', 'Cliente\CuentaController@getSocialAuthCallback');
//

//admin
Route::get('/personal',function (){
  return view('admin.personal');
});
Route::post('/add-personal','Admin\EmpleadosController@add');
Route::post('/edit-personal','Admin\EmpleadosController@edit');
Route::get('/kick-personal/{id}','Admin\EmpleadosController@kick');
Route::get("/restore-personal/{id}",'Admin\EmpleadosController@restore');
Route::post('/getAdminCount','Admin\EmpleadosController@getAdminCount');
Route::post('/getEmpleadoById','Admin\EmpleadosController@getEmpleadoById');
Route::post('/emailIsRepeted','Admin\EmpleadosController@emailIsRepeted');
//
