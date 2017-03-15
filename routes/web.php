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

Route::get('/', function () {



    //$cuenta = App\User::find(1);
    //Auth::login($cuenta);

    return view('welcome');
});

Route::get('/logout',function (){
  Auth::logout();
  return redirect('/');
});
Route::match(["GET","POST"],'/enviarmensajeC',"Cliente\ClienteController@enviarMensaje");
Route::match(["GET","POST"],'/modificarcuenta',"Cliente\ClienteController@modificarCuenta");
Route::match(["GET","POST"],'/subirfoto',"Cliente\ClienteController@subirfoto");
Route::get('/micuenta', function(){
  return view('user.micuenta');
});
