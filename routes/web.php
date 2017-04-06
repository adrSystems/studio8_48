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
Route::get('/admin/clientes/info/{id}','Admin\ClienteController@getDetailsForPersonalInfoView');
Route::get('/admin/clientes/edit/{id}', function ($id = null){
  if(!$id) return redirect('/admin/clientes');
  if(!$cliente = \App\Cliente::find($id)) return redirect('/admin/clientes');
  return view('admin.clientes.edit', ['cliente' => $cliente]);
});
Route::post('/clientes/editar','Admin\ClienteController@edit');
Route::post('/admin/clientes/update-credit','Admin\ClienteController@updateCredit');
Route::match(['GET','POST'],'/admin/citas/agregar/{id?}','Admin\CitaController@add');
//

//citas
Route::post('/getDateServicesInfo','Admin\CitaController@getDateServicesInfo');
Route::post('/getAppointmentDetails','Admin\CitaController@getAppointmentDetails');
Route::post('/changeStylistFromAppointment','Admin\CitaController@changeStylistFromAppointment');
Route::post('/admin/pay','Admin\CitaController@payByAdmin');
Route::post('/admin/liquidar-cita','Admin\CitaController@liquidar');
Route::post('/admin/start-appointment','Admin\CitaController@iniciar');
Route::post('/admin/end-appointment','Admin\CitaController@end');
Route::post('/admin/cancel-appointment','Admin\CitaController@cancel');
Route::post('/admin/update-appointment-datetime','Admin\CitaController@updateDatetime');
Route::post('/admin/getClientAppointmentsTable','Admin\CitaController@getAppointmentsTableByClient');

//inventario
Route::get('/admin/inventario', function (){
  return view('admin.inventario');
});
Route::post('/admin/inventario/marcas/agregar','Admin\InventarioController@agregarMarca');
Route::post('/admin/inventario/marcas/delete','Admin\InventarioController@deleteMarca');
Route::post('/admin/inventario/marcas/restore','Admin\InventarioController@restoreMarca');
Route::post('/admin/inventario/marcas/editar','Admin\InventarioController@editarMarca');
Route::post('/admin/inventario/marcas/get','Admin\InventarioController@getMarcas');
Route::post('/admin/inventario/categorias/is-repeated','Admin\InventarioController@categoriaEsRepetida');
Route::post('/admin/inventario/subcategorias/is-repeated','Admin\InventarioController@subcategoriaEsRepetida');
Route::post('/admin/inventario/agregar-categoria','Admin\InventarioController@agregarCategoria');
Route::post('/admin/inventario/marcas/get-categories','Admin\InventarioController@getCategories');
Route::post('/admin/inventario/marcas/get-subcategories','Admin\InventarioController@getSubcategories');
Route::post('/admin/inventario/categorias/cambiar-nombre','Admin\InventarioController@cambiarNombreCategoria');
Route::post('/admin/inventario/subcategorias/cambiar-nombre','Admin\InventarioController@cambiarNombreSubcategoria');
Route::post('/admin/inventario/categorias/get-tabla-categorias','Admin\InventarioController@getTablaCategorias');
Route::post('/admin/inventario/subcategorias/eliminar','Admin\InventarioController@eliminarSubcategoria');
Route::post('/admin/inventario/subcategorias/agregar','Admin\InventarioController@agregarSubcategoria');
Route::post('/admin/inventario/subcategorias/restaurar','Admin\InventarioController@restaurarSubcategoria');
Route::post('/admin/inventario/productos/is-repeated','Admin\InventarioController@productoEsRepetido');
Route::post('/admin/inventario/productos/agregar','Admin\InventarioController@agregarProducto');
Route::post('/admin/inventario/marcas/get-productos-table','Admin\InventarioController@getProductsTable');
Route::post('/admin/inventario/productos/get-by-id','Admin\InventarioController@getProductById');
Route::post('/admin/inventario/producto/editar','Admin\InventarioController@editarProducto');
Route::post('/admin/inventario/productos/descontinuarById','Admin\InventarioController@descontinuarById');
Route::post('/admin/inventario/productos/restaurarById','Admin\InventarioController@restaurarById');

/////////////////////////////

//cuenta
Route::match(["GET","POST"],'/modificarnombre',"Cliente\ClienteController@modificarNombre");
Route::match(["GET","POST"],'/modificarapellido',"Cliente\ClienteController@modificarApellido");
Route::match(["GET","POST"],'/modificarfechanacimiento',"Cliente\ClienteController@modificarFechanacimiento");
Route::match(["GET","POST"],'/modificarcorreo',"Cliente\ClienteController@modificarCorreo");
Route::match(["GET","POST"],'/modificartelefono',"Cliente\ClienteController@modificarTelefono");
Route::match(["GET","POST"],'/cambiarcontrasena',"Cliente\ClienteController@modificarContrasena");
Route::match(["GET","POST"],'/subirfoto',"Cliente\ClienteController@subirFoto");
Route::get('/micuenta', function(){
  $cuenta = App\User::find(3);
  Auth::login($cuenta);
  return view('user.micuenta');
});
////servicios_admin/////////////
Route::get('/admin/servicios',function(){
  return view ('admin.servicios');
});
Route::match(['GET','POST'],'/servicio/agregar','Admin\ServiciosController@agregar');
Route::get('/servicio/editar/{id?}',function($id=null){
  $servicio = \App\Servicio::find($id);
  if(!$id)
  return redirect ('/admin/servicios');
  if(!$servicio = \App\Servicio::find($id))
  return redirect ('/admin/servicios');
  return view ('admin.servicio.editar',['servicio'=>$servicio]);
});
Route::match(['GET','POST'], '/servicio/editar','Admin\ServiciosController@editar');
Route::get('/servicio/eliminar/{id?}',function($id = null){
  $servicio = \App\Servicio::find($id);
  if(!$id)
  return redirect ('/admin/servicios');
  if(!$servicio = \App\Servicio::find($id))
  return redirect ('/admin/servicios');
  $servicio->delete();
  return redirect ('/admin/servicios');
});
////promociones-admin-clientes//
Route::get('admin/promociones',function(){
  return view ('admin.promociones');
});
