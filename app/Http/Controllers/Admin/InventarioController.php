<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Marca;
use App\Subcategoria;
use App\Surticion;
use App\Categoria;
use App\Producto;
use Validator;
use Carbon\Carbon;

class InventarioController extends Controller
{
    public function agregarMarca(Request $request)
    {
      if(!$request->nombreMarca)
        return back()->with('options', [
          'msg' => ['title' => 'Ups!', 'body' => 'Complete el campo nombre la marca.'],
          'activeItem' => 'marcas-card'
        ]);

      if(Marca::where('nombre', $request->nombreMarca)->first())
      return back()->with('options', [
        'msg' => ['title' => 'Ups!', 'body' => 'La marca de productos ya está registrada en el sistema.'],
        'activeItem' => 'marcas-card'
      ])->withInput();

      if(!$request->logo)
        return back()->with('options', [
          'msg' => ['title' => 'Ups!', 'body' => 'Debe subir una imagen que servirá de logo para la marca.'],
          'activeItem' => 'marcas-card'
        ])->withInput();

      if(!$request->categorias)
        return back()->with('options', [
          'msg' => ['title' => 'Ups!', 'body' => 'Debes seleccionar al menos una categoria.'],
          'activeItem' => 'marcas-card'
        ])->withInput();

      $marca = new Marca;
      $marca->nombre = $request->nombreMarca;
      $marca->logo = $request->logo->store('img/marcas','public');
      $marca->save();

      foreach ($request->categorias as $catinput) {
        $catJSON = json_decode($catinput);
        $cat = new Categoria;
        $cat->nombre = $catJSON->nombre;
        $cat->marca_id = $marca->id;
        $cat->save();
        foreach ($catJSON->subcategorias as $sub) {
          $subcategoria = new Subcategoria;
          $subcategoria->nombre = $sub;
          $subcategoria->categoria_id = $cat->id;
          $subcategoria->save();
        }
      }

      return back()->with('options', [
        'msg' => ['title' => 'Ok!', 'body' => 'Marca registrada con exito. Ahora puede añadir categorias de productos para la marca.'],
        'activeItem' => 'marcas-card'
      ]);
    }

    public function deleteMarca(Request $request)
    {
      if(!$request->marcaId)
        return back()->with('options', [
          'msg' => ['title' => 'Ups!', 'body' => 'Ha ocurrido un error. Intentelo de nuevo.'],
          'activeItem' => 'marcas-card'
        ]);

      $marca = Marca::find($request->marcaId);

      if($marca->categorias()->count() < 1)
        $marca->forceDelete();

      foreach ($marca->categorias as $categoria) {
        foreach ($categoria->subcategorias as $sub) {
          foreach ($sub->productos as $producto) {
            $producto->delete();
          }
        }
      }
      $marca->delete();


      return back()->with('options', [
        'msg' => ['title' => 'Ok!', 'body' => 'La marca ahora está descontinuada al igual que sus productos.'],
        'activeItem' => 'marcas-card'
      ]);
    }

    public function restoreMarca(Request $request)
    {
      if(!$request->marcaToRestore)
        return back()->with('options', [
          'msg' => ['title' => 'Ups!', 'body' => 'Ha ocurrido un error. Intentelo de nuevo.'],
          'activeItem' => 'marcas-card'
        ]);

      $marca = Marca::onlyTrashed()->where('id',$request->marcaToRestore)->first();
      foreach ($marca->categorias as $categoria) {
        foreach ($categoria->subcategorias as $sub) {
          foreach ($sub->productos()->onlyTrashed()->get() as $producto) {
            $producto->restore();
          }
        }
      }
      $marca->restore();


      return back()->with('options', [
        'msg' => ['title' => 'Ok!', 'body' => 'La marca ahora esta siendo manejada al igual que sus productos.'],
        'activeItem' => 'marcas-card'
      ]);
    }

    public function editarMarca(Request $request)
    {
      if(!$request->categorias)
        return back()->with('options', [
          'msg' => ['title' => 'Ups!', 'body' => 'Proporcione al menos una categoria.'],
          'activeItem' => 'marcas-card'
        ]);

      if(Marca::where('nombre', $request->newMarcaName)->first())
      return back()->with('options', [
        'msg' => ['title' => 'Ups!', 'body' => 'El nombre que proporcionó ya existe.'],
        'activeItem' => 'marcas-card'
      ])->withInput();

      $marca = Marca::find($request->marcaToEdit);
      if($request->nuevoLogo) $marca->logo = $request->nuevoLogo->store('img/marcas','public');
      if($request->newMarcaName) $marca->nombre = $request->newMarcaName;

      $marca->save();

      $marca->categorias()->detach();
      $marca->categorias()->attach($request->categorias);

      return back()->with('options', [
        'msg' => ['title' => 'Ok!', 'body' => 'Marca modificada con exito.'],
        'activeItem' => 'marcas-card'
      ]);
    }

    public function categoriaEsRepetida(Request $request)
    {
      $found;
      if(Categoria::where('nombre',$request->nombre)->first()) $found = true;
      else $found = false;
      return ['result' => $found];
    }

    public function subcategoriaEsRepetida(Request $request)
    {
      $cat = Categoria::find($request->id);
      $found;
      if($cat->subcategorias()->where('nombre',$request->nombre)->first()) $found = true;
      else $found = false;
      return ['result' => $found];
    }

    public function agregarCategoria(Request $request)
    {
      if(Marca::where('nombre',$request->nombre)->first())
        return ['result' => false];

      $categoria = new Categoria;
      $categoria->nombre = $request->nombre;
      $categoria->save();

      foreach ($request->subcategorias as $subName) {
        if(!Subcategoria::where('nombre',$subName)->where('categoria_id',$categoria->id)->first())
        {
          $sub = new Subcategoria;
          $sub->nombre = $subName;
          $sub->categoria_id = $categoria->id;
          $sub->save();
        }
      }

      return [
        'result' => true,
        'cat' => $categoria
      ];
    }

    public function getCategories(Request $request)
    {
      return Marca::find($request->id)->categorias;
    }

    public function cambiarNombreCategoria(Request $request)
    {
      if(!$request->id || !$request->nombre)
        return ['result' => false];

      $cat = Categoria::find($request->id);
      $cat->nombre = $request->nombre;
      $cat->save();

      return ['result' => true];
    }

    public function cambiarNombreSubcategoria(Request $request)
    {
      if(!$request->id || !$request->nombre)
        return ['result' => false];

      $sub = Subcategoria::find($request->id);
      $sub->nombre = $request->nombre;
      $sub->save();

      return ['result' => true];
    }

    public function getSubcategories(Request $request)
    {
      $subcategorias  = Categoria::find($request->id)->subcategorias()->withTrashed()->get();
      foreach ($subcategorias as $key => $sub) {
        $sub->productos = $sub->productos()->withTrashed()->get();
        $sub->trashed = $sub->trashed();
      }
      return $subcategorias;
    }

    public function getTablaCategorias(Request $request)
    {
      return view('admin.tabla-categorias', ['categorias' => $request->categorias]);
    }

    public function eliminarSubcategoria(Request $request)
    {
      $sub = Subcategoria::find($request->id);

      if($sub->productos()->withTrashed()->count() < 1)
        $sub->forceDelete();
      else {
        foreach ($sub->productos as $producto) {
          $producto->delete();
        }
        $sub->delete();
      }
      return ['result' => true];
    }

    public function agregarSubcategoria(Request $request)
    {
      $cat = Categoria::find($request->id);

      if($cat->subcategorias()->where('nombre',$request->nombre)->first())
        return [
          'result' => false,
          'msg' => [
            'title' => 'Ups!',
            'body' => 'Ya existe una subcategoria con ese nombre en la categoria',
          ]
        ];

      $sub = new Subcategoria;
      $sub->nombre = $request->nombre;
      $sub->categoria_id = $cat->id;
      $sub->save();

      return [
        'result' => true,
        'sub' => $sub
      ];

    }

    public function restaurarSubcategoria(Request $request)
    {
      $sub = Subcategoria::onlyTrashed()->find($request->id);

      foreach ($sub->productos()->onlyTrashed()->get() as $producto) {
        $producto->restore();
      }
      $sub->restore();

      return ['result' => true];
    }

    public function getMarcas(Request $request)
    {
      return Marca::get();
    }

    public function productoEsRepetido(Request $request)
    {
      $marca = Marca::find($request->marcaId);
      $subcategoria = $marca->categorias()->find($request->categoriaId)->subcategorias()->find($request->subcategoriaId);

      if($subcategoria->productos()->where('nombre',$request->nombre)
      ->where('contenido', $request->contenido['cantidad'])->where('u_medida',$request->contenido['unidad'])->first())
        return ['result' => true];

      return ['result' => false];
    }

    public function agregarProducto(Request $request)
    {
      $result = Validator::make($request->all(), [
        'marcaForProduct' => 'required',
        'catForProduct' => 'required',
        'subForProduct' => 'required',
        'productoCover' => 'required',
        'nombreProducto' => 'required',
        'precioCompra' => 'required',
        'seVendeAlPublico' => 'required',
        'contenido' => 'required',
        'uMedida' => 'required',
        'descripcion' => 'required'
      ]);
      if($result->fails() || ($request->seVendeAlPublico == '1' and !$request->precioVenta))
        return back()->with('options', [
          'msg' => ['title' => 'Ups!', 'body' => 'Ha ocurrido un error, intentelo de nuevo.'],
          'activeItem' => 'productos-card'
        ]);

      $marca = Marca::find($request->marcaForProduct);
      $categoria = $marca->categorias()->find($request->catForProduct);
      $subcategoria = $categoria->subcategorias()->find($request->subForProduct);

      if($subcategoria->productos()->where('nombre',$request->nombreProducto)
      ->where('contenido', $request->contenido)->where('u_medida',$request->uMedida)->first())
        return back()->with('options', [
          'msg' => ['title' => 'Ups!', 'body' => 'El producto ya existe en el sistema.'],
          'activeItem' => 'productos-card',
          'activeItem' => 'productos-card',
          'subcategoria' => $producto->subcategoria,
          'marcas' => Marca::get()
        ]);

      if(Categoria::find($request->codigoProducto))
        return back()->with('options', [
          'msg' => ['title' => 'Ups!', 'body' => 'El código ya pertenece a otro producto, intente con otro.'],
          'activeItem' => 'productos-card',
          'activeItem' => 'productos-card',
          'subcategoria' => $producto->subcategoria,
          'marcas' => Marca::get()
        ]);

      $producto = new Producto;
      if($request->codigoProducto)
        $producto->codigo = $request->codigoProducto;
      else
      {
        $codigo = "";
        foreach (str_split(strtoupper($marca->nombre)) as $i => $char) {
          $codigo .= $char;
          if($i == 2) break;
        }
        foreach (str_split(strtoupper($categoria->nombre)) as $i => $char) {
          $codigo .= $char;
          if($i == 2) break;
        }
        foreach (str_split(strtoupper($subcategoria->nombre)) as $i => $char) {
          $codigo .= $char;
          if($i == 2) break;
        }
        foreach (str_split(strtoupper($request->nombreProducto)) as $i => $char) {
          $codigo .= $char;
          if($i == 2) break;
        }
        $codigo .= $marca->id;
        $codigo .= $categoria->id;
        $codigo .= $subcategoria->id;
        $codigo .= $subcategoria->productos()->count() + 1;
        $producto->codigo = $codigo;
      }
      $producto->nombre = $request->nombreProducto;
      $producto->descripcion = $request->descripcion;
      $producto->contenido = $request->contenido;
      $producto->u_medida = $request->uMedida;
      $producto->precio_compra = $request->precioCompra;
      if($request->seVendeAlPublico == '1')
        $producto->precio_venta = $request->precioVenta;
      $producto->venta_publico = $request->seVendeAlPublico;
      $producto->subcategoria_id = $subcategoria->id;
      $producto->fotografia = $request->productoCover->store('img/productos','public');
      $producto->save();

      return back()->with('options', [
        'msg' => ['title' => 'OK!', 'body' => 'El productose registo con exito!'],
        'activeItem' => 'productos-card',
        'activeItem' => 'productos-card',
        'subcategoria' => $producto->subcategoria,
        'marcas' => Marca::get()
      ]);
    }

    public function getProductsTable(Request $request)
    {
      return view('admin.tabla-productos', ['id' => $request->id]);
    }

    public function getProductById(Request $request)
    {
      $producto = Producto::withTrashed()->find($request->id);
      $meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
      $producto->mesEnCuestion = $meses[Carbon::now()->format('m')-1];
      $producto->subcategoria = $producto->subcategoria;
      $producto->subcategoria->categoria = $producto->subcategoria->categoria;
      $producto->subcategoria->categoria->marca = $producto->subcategoria->categoria->marca;
      $surticionesMensuales = $producto->surticiones()->whereYear('fecha_hora', Carbon::now()->format('Y'))
      ->whereMonth('fecha_hora', Carbon::now()->format('m'))->get();
      $paraVenta = 0;
      $paraAplicacion = 0;
      $montoGastado = 0;
      $inversionVentas = 0;
      $expectativaGanancias = 0;
      foreach ($surticionesMensuales as $surticion) {
        $paraVenta += $surticion->cantidad_venta;
        $expectativaGanancias += $surticion->cantidad_venta * $surticion->precio_venta;
        $paraAplicacion += $surticion->cantidad_ap_servicios;
        $montoGastado += ($surticion->cantidad_venta + $surticion->cantidad_ap_servicios) * $surticion->precio_compra;
        $inversionVentas += $surticion->cantidad_venta * $surticion->precio_compra;
      }
      $producto->inversionMensual = $montoGastado;
      $producto->inversionParaVenta = $inversionVentas;
      $producto->paraAplicacion = $paraAplicacion;
      $producto->paraVenta = $paraVenta;
      $producto->expectativaGanancias = $expectativaGanancias;
      $producto->fotografia = asset('storage/'.$producto->fotografia);
      $producto->agregadosEsteMes = $paraVenta + $paraAplicacion;
      $producto->compras = $producto->compras;
      $producto->comprasMensuales =  $producto->compras()->whereYear('fecha_hora', Carbon::now()->format('Y'))
      ->whereMonth('fecha_hora', Carbon::now()->format('m'))->get();
      $gananciaMensual = 0;
      $repeticionEnVentas = 0;
      foreach ($producto->comprasMensuales as $compraMensual) {
        foreach ($compraMensual->productos()->where('id',$producto->id)->get() as $prod) {
          $gananciaMensual += $prod->pivot->precio_venta * $prod->pivot->cantidad;
          $repeticionEnVentas += $prod->pivot->cantidad;
        }
      }
      $producto->gananciaMensual = $gananciaMensual;
      $producto->utilidad = $producto->gananciaMensual - $producto->inversionParaVenta;
      $producto->repeticionEnVentas = $repeticionEnVentas;
      $producto->gananciaMensual = $gananciaMensual;
      $producto->diferencia = $producto->expectativaGanancias - $gananciaMensual;
      //determinar utilizacion en citas
      $utilizacion = 0;
      foreach ($producto->citas()->whereYear('fecha_hora', Carbon::now()->format('Y'))
      ->whereMonth('fecha_hora', Carbon::now()->format('m'))->get() as $cita) {
        $utilizacion += $cita->pivot->cantidad;
      }

      $producto->utilizacion = $utilizacion;
      return $producto;
    }

    public function editarProducto(Request $request)
    {
      $producto = Producto::find($request->productoToEdit);

      $subcategoria = $producto->subcategoria;
      $subcategoria->categoria = $producto->subcategoria->categoria;
      $subcategoria->categoria->marca = $producto->subcategoria->categoria->marca;
      $subcategoria->categoria->marca->subcategorias = $producto->subcategoria->categoria->marca->subcategorias;

      $changes = false;

      if($request->newProductoName)
      {
        if(strtolower($producto->nombre) != strtolower($request->newProductoName)) $changes = true;
        $producto->nombre = $request->newProductoName;
      }
      if($request->nuevaDescripcion)
      {
        if(strtolower($producto->descripcion) != strtolower($request->nuevaDescripcion)) $changes = true;
        $producto->descripcion = $request->nuevaDescripcion;
      }
      if($request->nuevoPrecioCompra)
      {
        if(strtolower($producto->precio_compra) != strtolower($request->nuevoPrecioCompra)) $changes = true;
        $producto->precio_compra = $request->nuevoPrecioCompra;
      }
      if($request->nuevoContenido)
      {
        if(strtolower($producto->contenido) != strtolower($request->nuevoContenido)) $changes = true;
        $producto->contenido = $request->nuevoContenido;
      }
      if($request->nuevaFoto)
      {
        $producto->fotografia = $request->nuevaFoto->store('img/productos','public');
        $changes = true;
      }

      if($request->nuevoSeVendeAlPublico == '1' and $producto->precio_venta == null && !$request->nuevoPrecioVenta)
        return back()->with('options', [
          'msg' => ['title' => 'Ups!', 'body' => 'No puede activar la venta al publico si no especifica el precio de venta.'],
          'activeItem' => 'productos-card',
          'subcategoria' => $producto->subcategoria,
          'marcas' => Marca::get()
        ]);

      if($request->nuevoPrecioVenta)
      {
        if(strtolower($producto->precio_venta) != strtolower($request->nuevoPrecioVenta)) $changes = true;
        $producto->precio_venta = $request->nuevoPrecioVenta;
      }
      if(strtolower($producto->venta_publico) != strtolower($request->nuevoSeVendeAlPublico)){
        $changes = true;
      }
      $producto->venta_publico = $request->nuevoSeVendeAlPublico;
      if($request->nuevaUnidadMedida)
      {
        if(strtolower($producto->u_medida) != strtolower($request->nuevaUnidadMedida)) $changes = true;
        $producto->u_medida = $request->nuevaUnidadMedida;
      }
      $producto->save();

      $producto->subcategoria = $subcategoria;

      if(!$changes)
        return back()->with('options', [
          'msg' => ['title' => 'OK!', 'body' => 'No se realizó ningún cambio.'],
          'activeItem' => 'productos-card',
          'subcategoria' => $producto->subcategoria,
          'marcas' => Marca::get()
        ]);

      return back()->with('options', [
        'msg' => ['title' => 'OK!', 'body' => 'Cambios efectuados con exito!'],
        'activeItem' => 'productos-card',
        'subcategoria' => $producto->subcategoria,
        'marcas' => Marca::get()
      ]);
    }

    public function descontinuarById(Request $request)
    {
      $producto = Producto::find($request->id);

      //eliminar si no esta en citas, ni en ventas
      $producto->delete();
      $producto->subcategoria = $producto->subcategoria;

      return [
        'result' => true,
        'producto' => $producto
      ];
    }

    public function restaurarById(Request $request)
    {
      $producto = Producto::onlyTrashed()->find($request->id);
      $producto->restore();
      $producto->subcategoria = $producto->subcategoria;

      return [
        'result' => true,
        'producto' => $producto
      ];
    }

    public function surtir(Request $request)
    {
      $producto = Producto::find($request->id);

      if((!$request->cantidadVenta && !$request->cantidadAplicacion) || ($request->cantidadVenta == 0 && $request->cantidadAplicacion == 0))
      return ['result' => false];

      $surticion = new Surticion;
      $surticion->fecha_hora = Carbon::now()->format('Y-m-d H:i:s');
      $surticion->cantidad_venta = $request->cantidadVenta;
      $surticion->cantidad_ap_servicios = $request->cantidadAplicacion;
      $surticion->producto_id = $producto->id;
      if($request->precioVenta and $request->precioVenta > 0)
      {
        $surticion->precio_venta = $request->precioVenta;
        $producto->precio_venta = $request->precioVenta;
        $producto->save();
      }
      else {
        if($producto->precio_venta) $surticion->precio_venta = $producto->precio_venta;
      }
      if($request->precioCompra and $request->precioCompra > 0)
      {
        $surticion->precio_compra = $request->precioCompra;
        $producto->precio_compra = $request->precioCompra;
        $producto->save();
      }
      else {
        $surticion->precio_compra = $producto->precio_compra;
      }
      $surticion->save();

      return ['result' => true];
    }

    public function checkChanges(Request $request)
    {
      $subcategoria = Subcategoria::find($request->subcategoria);

      if($subcategoria->productos()->where('nombre',$request->nombre)->where('contenido',$request->contenido)
      ->where('u_medida',$request->uMedida)->where('id','!=',$request->productoId)->first())
        return ['result' => true];

      $producto = Producto::find($request->productoId);
      return [
        'result' => false,
        'producto' => $producto
      ];
    }

    public function searchProducts(Request $request)
    {
      $productos = [];
      foreach (Producto::with('subcategoria')->get() as $key => $producto) {
        if(strpos(strtolower($producto->nombre), strtolower($request->word)) !== false
        || strpos(strtolower($producto->codigo), strtolower($request->word)) !== false
        || strpos(strtolower($producto->subcategoria->nombre), strtolower($request->word)) !== false)
        $productos[] = $producto;
      }

      $productosDescontinuados = [];
      foreach (Producto::onlyTrashed()->with('subcategoria')->get() as $key => $producto) {
        if(strpos(strtolower($producto->nombre), strtolower($request->word)) !== false
        || strpos(strtolower($producto->codigo), strtolower($request->word)) !== false
        || strpos(strtolower($producto->subcategoria->nombre), strtolower($request->word)) !== false)
        $productosDescontinuados[] = $producto;
      }

      return view('admin.productos-table-searched', [
        'productos' => $productos,
        'productosDescontinuados' => $productosDescontinuados
      ]);
    }
}
