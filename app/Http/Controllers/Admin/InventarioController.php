<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Marca;

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

      $marca = new Marca;
      $marca->nombre = $request->nombreMarca;
      $marca->logo = $request->logo->store('img/marcas','public');
      $marca->save();

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
          foreach ($sub->productos as $producto) {
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
      if(!$request->nuevoLogo and !$request->newMarcaName)
        return back()->with('options', [
          'msg' => ['title' => 'Ups!', 'body' => 'Proporcione al menos un cambio.'],
          'activeItem' => 'marcas-card'
        ]);

      if(Marca::where('nombre', $request->newMarcaName)->first())
      return back()->with('options', [
        'msg' => ['title' => 'Ups!', 'body' => 'El nombre que proporcionó ya existe.'],
        'activeItem' => 'marcas-card'
      ])->withInput();

      $marca = Marca::find($request->marcaId);
      if($request->nuevoLogo) $marca->logo = $request->nuevoLogo->store('img/marcas','public');
      if($request->newMarcaName) $marca->nombre = $request->newMarcaName;

      $marca->save();

      return back()->with('options', [
        'msg' => ['title' => 'Ok!', 'body' => 'Marca modificada con exito.'],
        'activeItem' => 'marcas-card'
      ]);
    }
}
