<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promocion;
use Storage;

class PromocionController extends Controller
{
    public function agregar(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('admin.promociones');
      }
      $file = $request->file('cover');
      $temp = $file->store('CoversPromocion','public');
      $promocion = new Promocion;
      $promocion->cover = $temp;
      $promocion->fecha_inicio = $request->fecha_inicio;
      $promocion->fecha_termino = $request->fecha_fin;
      $promocion->descuento = $request->descuento;
      $promocion->servicio_id = $request->servicio;
      $promocion->save();
      return redirect ('/admin/promociones');
    }
    public function editar(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('admin.promociones');
      }
      $promocion = Promocion::find($request->id);
      if($request->file('cover'))
      {
        $file = $request->file('cover');
        $temp = $file->store('CoversPromocion','public');
        $promocion->cover = $temp;
      }
      $promocion->fecha_termino = $request->fecha_termino;
      $promocion->descuento = $request->descuento;
      $promocion->servicio_id = $request->servicio;
      $promocion->update();
      return redirect ('/admin/promociones');
    }
}
