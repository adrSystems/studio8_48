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

Route::group(['middleware' => ['guest']], function (){
  //Login registro
  Route::match(['GET','POST'],'/registro','Cliente\CuentaController@registrar');
  Route::match(['GET','POST'],'/login','Cliente\CuentaController@login');
  Route::get('/registro/verificar/{codigo}','Cliente\CuentaController@confirmar');
  Route::get('/social/{provider?}', 'Cliente\CuentaController@getSocialAuth');
  Route::get('/social/callback/{provider?}', 'Cliente\CuentaController@getSocialAuthCallback');
});

Route::group(['middleware' => ['auth', 'cliente']], function () {
  //compras
  Route::post('/productos/add-to-cart', 'Admin\CompraController@addToCart');
  Route::post('/productos/remove-from-cart', 'Admin\CompraController@removeFromCart');
  Route::post('/productos/update-cart-html-items', 'Admin\CompraController@getCartHtmlItems');
  Route::post('/productos/update-cart-products-items', 'Admin\CompraController@getCartProductsHtmlItems');
  Route::post('/productos/descartar-cart', 'Admin\CompraController@descartarCart');
  Route::post('/productos/confirmarCompra', 'Admin\CompraController@confirmarCompra');
});

Route::group(['middleware' => ['auth','admin-recepcionista']], function () {
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
  Route::post('/admin/inventario/producto/editar','Admin\InventarioController@editarProducto');
  Route::post('/admin/inventario/productos/descontinuarById','Admin\InventarioController@descontinuarById');
  Route::post('/admin/inventario/productos/restaurarById','Admin\InventarioController@restaurarById');
  Route::post('/admin/inventario/productos/surtir','Admin\InventarioController@surtir');
  Route::post('/admin/inventario/productos/check-changes','Admin\InventarioController@checkChanges');
  Route::post('/admin/inventario/productos/search','Admin\InventarioController@searchProducts');

  //servicios
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
    return view ('admin.servicio.edit',['servicio'=>$servicio]);
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

  //citas
  Route::post('/getAppointmentDetails','Admin\CitaController@getAppointmentDetails');

  //compras
  Route::post('/admin/compras/get-by-id','Admin\CompraController@getById');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
  //portafolio
  Route::get('/admin/portafolio/gestion/{id?}',function($id = null){
    if($id == null) return view('admin.portafolio.gestion');
    if(!$servicio = \App\Servicio::find($id)) return redirect('/admin/portafolio/gestion');
    else{
      return view('admin.portafolio.gestion', ['servicio' => $servicio]);
    }
  });
  Route::match(['GET','POST'],'/admin/portafolio/nuevo','PortafolioController@subirContenido');
  Route::post('/admin/portafolio/borrar-imagen','PortafolioController@eliminarImagen');
  Route::get('/admin/portafolio/borrar-video/{id}','PortafolioController@eliminarVideo');

  //tips
  Route::get('/admin/tips/gestion',function(){
    return view('admin.tips.gestion');
  });
  Route::post('/admin/tips/borrar','TipsController@eliminar');
  Route::match(['GET','POST'],'/admin/tips/modificar/{id?}','TipsController@modificar');
  Route::match(['GET','POST'],'/admin/tips/subir','TipsController@subir');

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

  ////promociones-admin//
  Route::get('admin/promociones',function(){
    return view ('admin.promociones');
  });
  Route::match(['GET','POST'],'/promocion/agregar','Admin\PromocionController@agregar');
  Route::get('/promocion/editar/{id?}',function($id = null){
    $promocion = \App\Promocion::find($id);
    if(!$id)
    return redirect ('/admin/promociones');
    if(!$promocion)
    return redirect ('/admin/promociones');
    return view ('admin.promociones.edit',['promocion'=>$promocion]);
  });
  Route::match(['GET','POST'],'/promocion/editar','Admin\PromocionController@editar');
  Route::get('/promocion/eliminar/{id?}',function($id= null){
    $promocion = \App\Promocion::find($id);
    if(!$id)
    return redirect ('/admin/promociones');
    if(!$promocion)
    return redirect ('/admin/promociones');
    $promocion->delete();
    return redirect ('/admin/promociones');
  });
  Route::get('/admin/concursos',function(){
    return view ('admin.concursos');
  });
  Route::match(['GET','POST'],'/concurso/agregar','Admin\ConcursoController@agregar');
  Route::get('/concurso/editar/{id?}',function($id=null){
    $concurso = \App\Concurso::find($id);
    if(!$id)
    return redirect ('/admin/concursos');
    if(!$concurso)
    return redirect ('/admin/concursos');
    return view ('admin.concursos.edit',['concurso'=>$concurso]);
  });
  Route::match(['GET','POST'],'/concurso/editar','Admin\ConcursoController@editar');
  Route::get('/concurso/eliminar/{id?}',function($id=null){
    $concurso = \App\Concurso::find($id);
    if(!$id)
    return redirect ('/admin/concursos');
    if(!$concurso)
    return redirect ('/admin/concursos');
    $concurso->delete();
    return redirect ('/admin/concursos');
  });
  //
});

Route::group(['middleware' => ['auth', 'recepcionista']], function () {
  //citas
  Route::post('/getDateServicesInfo','Admin\CitaController@getDateServicesInfo');
  Route::post('/changeStylistFromAppointment','Admin\CitaController@changeStylistFromAppointment');
  Route::post('/admin/pay','Admin\CitaController@payByAdmin');
  Route::post('/admin/liquidar-cita','Admin\CitaController@liquidar');
  Route::post('/admin/start-appointment','Admin\CitaController@iniciar');
  Route::post('/admin/end-appointment','Admin\CitaController@end');
  Route::post('/admin/cancel-appointment','Admin\CitaController@cancel');
  Route::post('/admin/update-appointment-datetime','Admin\CitaController@updateDatetime');
  Route::post('/admin/getClientAppointmentsTable','Admin\CitaController@getAppointmentsTableByClient');
  Route::match(['GET','POST'],'/admin/citas/agregar/{id?}','Admin\CitaController@add');
  Route::post('/admin/citas/confirmar','Admin\CitaController@confirmar');

  //compras
  Route::post('/admin/compras/abonar','Admin\CompraController@abonar');
  Route::post('/admin/compras/liquidar','Admin\CompraController@liquidar');
  Route::get('/admin/ventas/agregar/{cliente}', function ($clienteId=null){
    if(!$clienteId) return redirect('/admin/clientes');
    if(!$cliente = \App\Cliente::find($clienteId)) return redirect('/admin/clientes');
    return view('admin.clientes.venta',['cliente' => $cliente]);
  });
  Route::post('/admin/ventas/agregar', 'Admin\ClienteController@registrarVenta');
});

Route::group(['middleware' => ['auth']], function () {
  //cuenta
  Route::match(["GET","POST"],'/modificarnombre',"Cliente\ClienteController@modificarNombre");
  Route::match(["GET","POST"],'/modificarapellido',"Cliente\ClienteController@modificarApellido");
  Route::match(["GET","POST"],'/modificarfechanacimiento',"Cliente\ClienteController@modificarFechanacimiento");
  Route::match(["GET","POST"],'/modificartelefono',"Cliente\ClienteController@modificarTelefono");
  Route::match(["GET","POST"],'/cambiarcontrasena',"Cliente\ClienteController@modificarContrasena");
  Route::match(["GET","POST"],'/subirfoto',"Cliente\ClienteController@subirFoto");
  Route::get('/micuenta', function(){
    return view('user.micuenta');
  });
  Route::get('/micuenta/{id?}', 'Cliente\ClienteController@getDetailsCliente');
  Route::get('/micuentaE/{id?}', 'Cliente\ClienteController@getDetailsEmpleado');
  Route::match(['GET','POST'],'/enviarMensaje','Cliente\ClienteController@enviarMensaje');
  Route::get('/admin/forum','Admin\ForumController@getAll');
  Route::get('/forum/{id?}','Admin\ForumController@getMensajes');
  Route::match(['GET','POST'],'/admin/enviarMensaje','Admin\ForumController@enviarMensaje');
  Route::post('/cancelarCita','Cliente\ClienteController@cancelarCita');

  //logout
  Route::get('/logout','Cliente\CuentaController@logout');
});

Route::get('/promociones_concursos', function(){
  $promociones = \App\Promocion::whereDate('fecha_inicio','<=', date('Y-m-d'))
  ->whereDate('fecha_termino','>=', date('Y-m-d'))
  ->get();
  $concursos = \App\Concurso::whereDate('fecha_inicio','<=', date('Y-m-d'))
  ->whereDate('fecha_termino','>=', date('Y-m-d'))
  ->get();
  $months = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
  foreach ($promociones as $id => $p) {
    $startDate = strtotime($p->fecha_inicio);
    $endDate = strtotime($p->fecha_termino);
    $p->vigencia = 'Del '
      .date('d \d\e ', $startDate)
      .$months[date('w', $startDate)]
      .date(' \d\e\l Y', $startDate)
      ." al "
      .date('d \d\e ', $endDate)
      .$months[date('w', $endDate)]
      .date(' \d\e\l Y', $endDate);
  }
  foreach ($concursos as $id => $c) {
    $startDate = strtotime($c->fecha_inicio);
    $endDate = strtotime($c->fecha_termino);
    $c->vigencia = 'Del '
      .date('d \d\e ', $startDate)
      .$months[date('w', $startDate)]
      .date(' \d\e\l Y', $startDate)
      ." al "
      .date('d \d\e ', $endDate)
      .$months[date('w', $endDate)]
      .date(' \d\e\l Y', $endDate);
  }
  return view ('cliente.promociones_concursos', ['promociones' => $promociones, 'concursos' => $concursos]);
});

Route::get('/tips',function(){
  return view('cliente.tips');
});

Route::get('/portafolio/{id?}',function($id = null){
  if($id == null) return view('portafolio');
  if(!$servicio = \App\Servicio::find($id)) return redirect('/portafolio');
  else{
    return view('portafolio', ['servicio' => $servicio]);
  }
});

route::get('/nosotros',function(){
    return view('cliente.nosotros');
});

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

//Ayuda
Route::get('/help',function (){
  return view('welcome');
});

//compras
Route::get('/productos',function () {
  $categorias = [];
  foreach(\App\Categoria::get() as $cat)
  {
    $found = false;
    foreach ($categorias as $c) {
      if(strtolower($cat->nombre) == strtolower($c->nombre))
      $found = true;
    }
    if(!$found) $categorias[] = $cat;
  }
  $subcategorias = [];
  foreach(\App\Subcategoria::get() as $sub)
  {
    $found = false;
    foreach ($subcategorias as $s) {
      if(strtolower($sub->nombre) == strtolower($s->nombre))
      $found = true;
    }
    if(!$found) $subcategorias[] = $sub;
  }
  return view('productos.catalogo', ['categorias' => $categorias, 'subcategorias' => $subcategorias]);
});
Route::post('/productos/catalogo/filtrar','Admin\CompraController@filterProducts');

//productos
Route::post('/admin/inventario/productos/get-by-id','Admin\InventarioController@getProductById');

//servicios
Route::get('/servicios',function(){
  return view ('cliente.servicios');
});

//storage link
Route::get('/admin/do/storage-link', function () {
  Artisan::call('storage:link');
  return 'success';
});

Route::get('/android/login/attempt/{email}/{pass}','Cliente\CuentaController@androidLoginAttempt');
Route::get('/android/user/get-by-id/{id}','Cliente\CuentaController@getAccountById');
Route::get('/android/user/get-appointments/{id}','Cliente\ClienteController@getAppointments');
Route::get('/android/services/get-all', 'Cliente\CitaController@getServices');
Route::get('/android/stylists/get-all', 'Cliente\CitaController@getStylists');
Route::get('/android/appointment/new/{appointment}', 'Cliente\CitaController@program');
