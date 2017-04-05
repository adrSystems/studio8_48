<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Marca;
use App\Subcategoria;
use App\Categoria;
use App\Producto;

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

      $marca->categorias()->attach($request->categorias);

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
      return view('admin.tabla-categorias');
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
      $sub = Subcategoria::find($request->id);

      foreach ($sub->productos()->onlyTrashed()->get() as $producto) {
        $producto->restore();
      }
      $sub->restore();

      return ['result' => true];
    }
}
