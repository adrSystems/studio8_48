<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class EmpleadosController extends Controller
{
    public function add(Request $request)
    {
      if(Validator::make($request->all(), [
        'name' => 'required',
        'lastName' => 'required',
        'day' => 'required|numeric',
        'month' => 'required|numeric',
        'year' => 'required|numeric',
        'roles' => 'required',
        ])->fails()){
          return back()->with('msg', ['title' => 'Error!', 'body' => 'Debes proporcionar todos los datos'])->withInput();
      }
      if(in_array(\App\Rol::where('nombre','estilista')->first()->id, $request->roles)
        and (!$request->foto || !$request->about)){
        return back()->with('msg', [
          'title' => 'Error!',
          'body' => 'Los estilistas deben tener una fotografía e información personal para mostrar en la sección: Nosotros'])
        ->withInput();
      }
      $empleado = new \App\Empleado;
      $empleado->nombre = $request->name;
      $empleado->apellido = $request->lastName;
      $empleado->fecha_nacimiento = $request->year."-".$request->month."-".$request->day;
      //$empleado->save();
      $empleado->roles()->attach($request->roles);
      return $empleado;
    }
}
