<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Compra;
use App\Pago;
use App\Producto;
use App\Categoria;
use App\Subcategoria;
use Carbon\Carbon;

class CompraController extends Controller
{
    public function getById(Request $request)
    {
      $compra = Compra::with('productos','cliente','pagos')->find($request->id);
      $compra->monto = $compra->monto();
      $compra->fecha = Carbon::createFromFormat('Y-m-d H:i:s', $compra->fecha_hora)->format('d/m/Y');
      $compra->hora = Carbon::createFromFormat('Y-m-d H:i:s', $compra->fecha_hora)->format('g:i a');

      foreach ($compra->productos as $p) {
        $p->fotografia = asset('storage/'.$p->fotografia);
      }

      foreach ($compra->pagos as $p) {
        $p->fecha = Carbon::createFromFormat('Y-m-d H:i:s', $p->fecha_hora)->format('d/m/Y');
        $p->hora = Carbon::createFromFormat('Y-m-d H:i:s', $p->fecha_hora)->format('g:i a');
      }

      $compra->pagado = $compra->pagos()->sum('cantidad');
      $compra->clientHasCredit = $compra->cliente->credito == '1';

      return $compra;
    }

    public function abonar(Request $request)
    {
      $compra = Compra::find($request->id);
      if(!$compra || !$request->cantidad || $request->cantidad < 1)
        return ['result' => '0'];
      if(!$compra->cliente->credito)
        return ['result' => '0'];
      if($compra->pagos()->sum('cantidad') + $request->cantidad > $compra->monto())
        return ['result' => '1'];
      $pago = new Pago;
      $pago->cantidad = $request->cantidad;
      $pago->fecha_hora = Carbon::now()->format('Y-m-d H:i:s');
      $pago->pagable_id = $compra->id;
      $pago->pagable_type = Compra::class;
      $pago->save();

      $pago->fecha = Carbon::createFromFormat('Y-m-d H:i:s',$pago->fecha_hora)->format('d/m/Y');
      $pago->hora = Carbon::createFromFormat('Y-m-d H:i:s',$pago->fecha_hora)->format('g:i a');

      $compra->pagado = $compra->pagos()->sum('cantidad');
      $compra->monto = $compra->monto();

      return [
        'result' => '2',
        'pago' => $pago,
        'compra' => $compra
      ];
    }

    public function filterProducts(Request $request)
    {
      $productos = Producto::with('subcategoria')->where('venta_publico','1')->get();

      if($request->marca)
      {
        foreach ($productos as $i => $p) {
          if($p->subcategoria->categoria->marca->id != $request->marca)
            unset($productos[$i]);
        }
      }
      if($request->cat)
      {
        $cat = Categoria::find($request->cat);
        foreach ($productos as $i => $p) {
          if(strtolower($p->subcategoria->categoria->nombre) != strtolower($cat->nombre))
            unset($productos[$i]);
        }
      }
      if($request->subcat)
      {
        $sub = Subcategoria::find($request->subcat);
        foreach ($productos as $i => $p) {
          if(strtolower($p->subcategoria->nombre) != strtolower($sub->nombre))
            unset($productos[$i]);
        }
      }
      return view('productos.productos-filtrados', ['productos' => $productos]);
    }

    public function addToCart(Request $request)
    {
      $producto = Producto::find($request->id);

      if($request->session()->exists('cart')){
        $found = false;
        $productos = session('cart')['productos'];
        foreach ($productos as $i => $p) {
          if($p['id'] == $producto->id)
          {
            $found = true;
            $p['cantidad'] = $p['cantidad'] + 1;
            if($p['cantidad'] > $producto->existencia())
            return [
              'result' => false,
              'msg' => ['title' => 'Ups!', 'body' => 'No hay suficientes unidades en exitencia.']
            ];
            $productos[$i] = $p;
            $monto = 0;
            foreach ($productos as $key => $p2) {
              $monto += $p2['cantidad'] * $p2['precio_venta'];
            }
            $request->session()->put('cart', ['monto' => $monto, 'productos' => $productos]);
          }
        }
        if(!$found)
        {
          if($producto->existencia() < 1)
            return [
              'result' => false,
              'msg' => ['title' => 'Ups!', 'body' => 'No hay suficientes unidades en exitencia.']
            ];
          $request->session()->push('cart.productos', [
            'nombre' => $producto->nombre,
            'codigo' => $producto->codigo,
            'id' => $producto->id,
            'precio_venta' => $producto->precio_venta,
            'cantidad' => 1,
            'foto' => asset('storage/'.$producto->fotografia)
          ]);
          $monto = 0;
          $productosWithPushed = session('cart')['productos'];
          foreach ($productosWithPushed as $key => $p2) {
            $monto += $p2['cantidad'] * $p2['precio_venta'];
          }
          $request->session()->put('cart', ['monto' => $monto, 'productos' => $productosWithPushed]);
        }
      }
      else{
        if($producto->existencia() < 1)
          return [
            'result' => false,
            'msg' => ['title' => 'Ups!', 'body' => 'No hay suficientes unidades en exitencia.']
          ];
        $request->session()->put('cart', [
          'monto' => $producto->precio_venta,
          'productos' => [
            [
              'nombre' => $producto->nombre,
              'codigo' => $producto->codigo,
              'id' => $producto->id,
              'cantidad' => 1,
              'precio_venta' => $producto->precio_venta,
              'foto' => asset('storage/'.$producto->fotografia)
            ]
          ]
        ]);
      }
      return [
        'result' => true,
        'cart' => session('cart')
      ];
    }

    public function removeFromCart(Request $request)
    {
      $productos = session('cart')['productos'];
      if($productos)
      {
        foreach ($productos as $i => $p) {
          if($p['id'] == $request->id)
          {
            $p['cantidad'] = $p['cantidad'] - 1;
            $productos[$i]['cantidad'] = $p['cantidad'];
            $monto = 0;
            if($p['cantidad'] == 0){
              unset($productos[$i]);
              foreach ($productos as $p2) {
                $monto += $p2['cantidad'] * $p2['precio_venta'];
              }
              if(count($productos) < 1)
              $request->session()->forget('cart');
              else {
                $request->session()->put('cart', ['monto' => $monto, 'productos' => $productos]);
              }
            }
            else
            {
              foreach ($productos as $p2) {
                $monto += $p2['cantidad'] * $p2['precio_venta'];
              }
              $productos[$i]['cantidad'] = $p['cantidad'];
              $request->session()->put('cart', ['monto' => $monto, 'productos' => $productos]);

            }
            return ['totalCount' => count($productos), 'count' => $p['cantidad'], 'monto' => $monto];
          }
        }
      }
    }

    public function getCartHtmlItems(Request $request)
    {
      return view('productos.cart-items');
    }

    public function getCartProductsHtmlItems(Request $request)
    {
      return view('productos.cart-products-items');
    }

    public function descartarCart(Request $request)
    {
      $request->session()->forget('cart');
    }

    public function confirmarCompra(Request $request)
    {
      if(!\Auth::check())
        return back()->with('msg', ['title' => 'Error', 'body' => 'Ha ocurrido un error. Intentelo de nuevo.']);
      if(\Auth::check() and \Auth::user()->cuentable_type == \App\Empleado::class)
        return back()->with('msg', ['title' => 'Error', 'body' => 'Ha ocurrido un error. Intentelo de nuevo.']);
      if(!session('cart'))
        return back()->with('msg', ['title' => 'Error', 'body' => 'Ha ocurrido un error. Intentelo de nuevo.']);

      $productos = session('cart')['productos'];
      foreach ($productos as $i => $p) {
        if(Producto::find($p['id'])->existencia() <  $p['cantidad'])
        {
          $monto = 0;
          foreach ($productos as $x => $p2) {
            $pModel = Producto::find($p2['id'])->existencia();
            if($pModel <  $p2['cantidad'])
            {
              $productos[$x]['cantidad'] = $pModel;
              $monto += $productos[$x]['cantidad'] * $productos[$x]['precio_venta'];
            }
          }
          $request->session()->put('cart', ['monto' => $monto, 'productos' => $productos]);
          return back()->with('msg', ['title' => 'Error', 'body' => 'Se han agotado existencias mientras realizaba la compra...']);
        }
      }
      $compra = new Compra;
      $compra->cliente_id = \Auth::user()->cuentable->id;
      $compra->fecha_hora = Carbon::now()->format('Y-m-d H:i:s');
      $compra->save();
      foreach ($productos as $i => $p) {
        $compra->productos()->attach($p['id'], ['cantidad' => $p['cantidad'], 'precio_venta' => $p['precio_venta']]);
      }
      $request->session()->forget('cart');
      return back()->with('msg', ['title' => 'OK', 'body' => 'Venta registrada con exito. Puede recoger sus productos en nuestras instalaciones.']);
    }

    public function liquidar(Request $request)
    {
      $compra = Compra::find($request->id);
      if(!$compra)
        return ['result' => false];
      if($compra->pagos()->sum('cantidad') >= $compra->monto())
        return ['result' => false];
      $pago = new Pago;
      $pago->cantidad = $compra->monto();
      $pago->fecha_hora = Carbon::now()->format('Y-m-d H:i:s');
      $pago->pagable_id = $compra->id;
      $pago->pagable_type = Compra::class;
      $pago->save();

      $pago->fecha = Carbon::createFromFormat('Y-m-d H:i:s',$pago->fecha_hora)->format('d/m/Y');
      $pago->hora = Carbon::createFromFormat('Y-m-d H:i:s',$pago->fecha_hora)->format('g:i a');

      $compra->pagado = $compra->pagos()->sum('cantidad');
      $compra->monto = $compra->monto();

      return [
        'result' => true,
        'pago' => $pago,
        'compra' => $compra
      ];
    }
}
