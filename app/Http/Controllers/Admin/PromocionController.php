<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promocion;
use Validator;
use Storage;

class PromocionController extends Controller
{
    public function agregar(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('admin.promociones');
      }
      $rules=[
        'cover'=>'required|mimes:jpeg,bmp,png',
        'fecha_inicio'=>'required|date|after:yesterday',
        'fecha_fin'=>'required|date|after:fecha_inicio',
        'servicio'=>'required',
        'descuento'=>'numeric|between:0,1000'
      ];
      $messages=[
        'cover.required'=>'La imagen de la promoción es requerida.',
        'cover.mimes'=>'Debe subir una imagen con los siguientes formatos: jpeg,bmp,png,jpg.',
        'fecha_inicio.after'=>'La fecha inicio debe ser hoy o despues de este día.',
        'fecha_fin.after'=>'La fecha fin deber ser despues de la fecha de inicio.',
        'servicio.required'=>'Debe seleccionar un servicio para la promoción.',
        'descuento.numeric'=>'En el campo de Descuento solo se pueden ingresar números.',
        'descuento.between'=>'En el campo de Descuento no puede ingresar numeros negativos.'
      ];
      $validacion=Validator::make($request->all(),$rules,$messages);
      if($validacion->fails()){
        return back()->with('error',$validacion->messages()->all())->withInput();
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
      $rules=[
        'cover'=>'mimes:jpeg,bmp,png',
        'fecha_inicio'=>'required|date',
        'fecha_fin'=>'date|after:fecha_inicio',
        'servicio'=>'required',
        'descuento'=>'numeric|between:0,1000'
      ];
      $messages=[
        'cover.mimes'=>'Debe subir una imagen con los siguientes formatos: jpeg,bmp,png,jpg.',
        'fecha_inicio.date'=>'Es incorrecto el formato de fecha inicio.',
        'fecha_fin.after'=>'La fecha fin deber ser despues de la fecha de inicio.',
        'servicio.required'=>'Debe seleccionar un servicio para la promoción.',
        'descuento.numeric'=>'En el campo de Descuento solo se pueden ingresar números.',
        'descuento.between'=>'En el campo de Descuento no puede ingresar numeros negativos.'
      ];
      $validacion=Validator::make($request->all(),$rules,$messages);
      if($validacion->fails()){
        return back()->with('error',$validacion->messages()->all())->withInput();
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
