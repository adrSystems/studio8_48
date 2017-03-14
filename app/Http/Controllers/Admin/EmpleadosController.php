<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use \App\Empleado;
use \App\User;
use \App\Rol;

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
        'email' => 'required|email'
        ])->fails()){
          return back()->with('msg', ['title' => 'Error!', 'body' => 'Debes proporcionar todos los datos'])->withInput();
      }
      $esEstilista = in_array(Rol::where('nombre','estilista')->first()->id, $request->roles);
      if($esEstilista and (!$request->foto || !$request->about || !$request->servicios)){
        return back()->with('msg', [
          'title' => 'Error!',
          'body' => 'Los estilistas deben tener una fotografía, los servicios que aplican e información personal para mostrar en la sección: Nosotros'])
        ->withInput();
      }
      if(User::where('email',$request->email)->count() > 0){
        return back()->with('msg', [
          'title' => 'Error!',
          'body' => 'El correo ya está asociado a una cuenta.'])
        ->withInput();
      }
      $empleado = new Empleado;
      $empleado->nombre = $request->name;
      $empleado->apellido = $request->lastName;
      $empleado->fecha_nacimiento = $request->year."-".$request->month."-".$request->day;
      if($esEstilista){
        $empleado->info = $request->about;
        $empleado->fotografia = $request->foto->store('img/profile_photos','public');
      }
      $empleado->save();
      $empleado->roles()->attach($request->roles);
      if($esEstilista){
        $empleado->servicios()->attach($request->servicios);
      }
      $cuenta = new User;
      $cuenta->email = $request->email;
      $cuenta->password = str_random(10);
      $cuenta->active = 1;
      $cuenta->fb = 0;
      $cuenta->cuentable_id = $empleado->id;
      $cuenta->cuentable_type = Empleado::class;
      $cuenta->save();

      return back()->with('msg', [
        'title' => 'Listo!',
        'body' => 'Empleado registrado satisfactoriamente.']);
    }

    public function getEmpleadoById(Request $request)
    {
      $emp = Empleado::find($request->id);
      if($emp->fotografia){
        $emp->fotografia = asset('storage/'.$emp->fotografia);
      }
      $emp->roles = $emp->roles;
      $emp->servicios = $emp->servicios;
      $emp->email = $emp->cuenta->email;
      return $emp;
    }
}
