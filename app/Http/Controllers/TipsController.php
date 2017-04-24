<?php

namespace App\Http\Controllers;
Use App\Tip;
Use Redirect;
use Storage;

use Illuminate\Http\Request;

class TipsController extends Controller
{
    public function subir(Request $request)
    {
      if($request->method()=='GET'){
    		return view('admin.tips.nuevo');
    	}
        if(!$request->hasfile('imagen'))
          return back()->with('msg', ['title' => 'Ups!', 'type' => 'danger', 'body' => 'Debe seleccionar una imagen!']);
        if(!$request->title)
          return back()->with('msg', ['title' => 'Ups!', 'type' => 'danger', 'body' => 'Complete el título.']);

        $tip = new Tip;
        $tip ->titulo = $request->title;
        $tip->contenido = $request->contenido;
        $tip->src = $request->imagen->store('tips','public');
        $tip->save();

        return back()->with('msg', ['title' => 'OK!', 'type' => 'success', 'body' => 'Tip agregado con exito!']);
    }

    public function eliminar(Request $request)
    {
      $tip = Tip::find($request->id);
      $tip->delete();
      Storage::delete('/public/'.$tip->src);

      return back();
    }

    public function modificar(Request $request, $id = null)
    {
      if($request->method()=='GET'){
    		if(!$id) return redirect('/admin/tips/gestion');
        if(!$tip = Tip::find($id)) return redirect('/admin/tips/gestion');
        return view('admin.tips.modificar', ['tip' => $tip]);
    	}

      if(!$request->title)
        return back()->with('msg', ['title' => 'Ups!', 'type' => 'danger', 'body' => 'Debe especificar el título.']);

      $tip = Tip::find($request->id);
      $tip->titulo = $request->title;

      if($request->contenido and $request->contenido != '')
        $tip->contenido = $request->contenido;
      else if($request->contenido and $request->contenido == '')
        $tip->contenido = null;

      if($request->hasfile('imagen'))
      {
        Storage::delete('/public/'.$tip->src);
        $tip->src = $request->imagen->store('tips','public');
      }
      $tip->update();

      return back()->with('msg', ['title' => 'OK!', 'type' => 'success', 'body' => 'Cambios efectuados con exito!']);
    }

}
