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
  if(\App\Empleado::count() < 1){
    if(\App\Rol::count() < 1){
      $rol = new \App\Rol;
      $rol->nombre = "administrador";
      $rol->save();
      $rol = new \App\Rol;
      $rol->nombre = "estilista";
      $rol->save();
      $rol = new \App\Rol;
      $rol->nombre = "marketing";
      $rol->save();
      $rol = new \App\Rol;
      $rol->nombre = "recepcionista";
      $rol->save();
    }
    return view('admin.primer-uso');
  }
  return view('welcome');
});

//first use sign up
Route::post('/signup-admin','Admin\EmpleadosController@addAdminOnFirstUse');
//

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

//////////////////////////////ADMIN///////////////////////////////////////////

//personal
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

//clientes
Route::get('/admin/clientes','Admin\ClienteController@getDetailsForMainView');
Route::match(['GET','POST'], '/clientes/agregar', 'Admin\ClienteController@add');
Route::post('/admin/clientes/filter','Admin\ClienteController@filter');
Route::get('/admin/clientes/info/{id?}','Admin\ClienteController@getDetailsForPersonalInfoView');
Route::get('/admin/clientes/edit/{id?}', function ($id = null){
  if(!$id) return redirect('/admin/clientes');
  if(!$cliente = \App\Cliente::find($id)) return redirect('/admin/clientes');
  return view('admin.clientes.edit');
});
//

//////////////////////////////////////////////////////////////////////////
