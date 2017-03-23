<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use \App\Empleado;
use \App\User;
use \App\Rol;
use Carbon\Carbon;
use App\Mail\Empleado\AccountCreated;
use Mail;
use Hash;

class EmpleadosController extends Controller
{

    public function addAdminOnFirstUse(Request $request)
    {
      $admin = new Empleado;
      $admin->nombre = $request->name;
      $admin->apellido = $request->lastName;
      $admin->fecha_nacimiento = $request->birthday;
      $esEstilista = in_array(Rol::where('nombre','estilista')->first()->id, $request->roles);
      if($esEstilista){
        $admin->info = $request->about;
        $admin->fotografia = $request->foto->store('img/profile_photos','public');
      }
      $admin->fecha_registro = date("Y-m-d");
      $admin->save();
      $admin->roles()->attach($request->roles);

      $cuenta = new User;
      $cuenta->email = $request->email;
      $cuenta->password = Hash::make($request->password);
      $cuenta->active = 1;
      $cuenta->fb = 0;
      $cuenta->cuentable_id = $admin->id;
      $cuenta->cuentable_type = Empleado::class;
      $cuenta->save();

      return redirect('/login');
    }

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
      $empleado->fecha_registro = date("Y-m-d");
      $empleado->save();
      $empleado->roles()->attach($request->roles);
      if($esEstilista){
        $empleado->servicios()->attach($request->servicios);
      }
      $cuenta = new User;
      $cuenta->email = $request->email;
      $password = str_random(10);
      $cuenta->password = Hash::make($password);
      $cuenta->active = 1;
      $cuenta->fb = 0;
      $cuenta->cuentable_id = $empleado->id;
      $cuenta->cuentable_type = Empleado::class;
      $cuenta->save();

      Mail::to($cuenta->email)->send(new AccountCreated($empleado,$cuenta,$password));

      return back()->with('msg', [
        'title' => 'Listo!',
        'body' => 'Empleado registrado satisfactoriamente. Se ha enviado al correo del empleado la contraseña con la cual accederá al sistema.']);
    }

    public function edit(Request $request)
    {
      if(!$request->roles){
        return back()->with('msg', [
          'title' => 'Error!',
          'body' => 'El empleado debe tener almenos un rol.']);
      }
      $emp = Empleado::find($request->empId);
      if($request->name){
        $emp->nombre =$request->name;
      }
      if($request->lastName){
        $emp->apellido = $request->lastName;
      }
      $emailMsg = "";
      if($request->email){
        $emp->cuenta->email = $request->email;
        $emp->cuenta->save();
        Mail::to($request->email)->send(new AccountCreated($emp, $emp->cuenta));
        $emailMsg = "Se ha enviado la contraseña al nuevo correo del empleado. (".$request->email.")";
      }
      if($request->day and $request->year){
        $emp->fecha_nacimiento = $request->year."-".$request->month."-".$request->day;
      }
      $emp->roles()->detach();
      $emp->roles()->attach($request->roles);
      $emp->servicios()->detach();
      $emp->servicios()->attach($request->servicios);
      if($request->about){
        $emp->info = $request->about;
      }
      if($request->foto){
        $emp->fotografia = $request->foto->store('img/profile_photos','public');
      }

      $emp->save();

      return back()->with('msg', [
        'title' => 'Listo!',
        'body' => 'Empleado modificado con exito. '.$emailMsg]);

    }

    public function kick(Request $request, $id)
    {
      if(self::getAdminCount() < 2){
        return back()->with('msg', [
          'title' => 'Error!',
          'body' => 'No se puede despedir al empleado puesto que es el ultimo administrador.']);
      }
      $emp = Empleado::find($id);
      $emp->cuenta->active = 0;
      $emp->cuenta->save();
      $emp->delete();
      return back()->with('msg', [
        'title' => 'Listo!',
        'body' => 'El empleado '.$emp->nombre." ".$emp->apellido.' ahora está inactivo.']);
    }

    public function restore(Request $request, $id)
    {
      $emp = Empleado::onlyTrashed()->where('id',$id)->first();
      $emp->cuenta->active = 1;
      $emp->cuenta->save();
      $emp->restore();
      return back()->with('msg', [
        'title' => 'Listo!',
        'body' => 'El empleado '.$emp->nombre." ".$emp->apellido.' ahora está activo.']);
    }

    public function getEmpleadoById(Request $request)
    {
      $emp = Empleado::withTrashed()->where('id',$request->id)->first();
      if($emp->fotografia){
        $emp->fotografia = asset('storage/'.$emp->fotografia);
      }
      $emp->roles = $emp->roles;
      $emp->edad = Carbon::createFromFormat('Y-m-d', $emp->fecha_nacimiento)->diffInYears(Carbon::now());
      $emp->servicios = $emp->servicios;
      $emp->email = $emp->cuenta->email;
      return $emp;
    }

    public function getAdminCount()
    {
      $adminCount = 0;
      foreach (Empleado::get() as $key => $empleado) {
        foreach ($empleado->roles as $key => $rol) {
          if($rol->nombre == 'administrador') $adminCount++;
        }
      }
      return $adminCount;
    }

    public function emailIsRepeted(Request $request)
    {
      $emp = Empleado::find($request->id);
      foreach(Empleado::withTrashed()->where('id','!=',$emp->id)->get() as $otherEmpleado){
        if($otherEmpleado->cuenta->email == $request->email)
          return ['result' => true];
      }
      return ['result' => false];
    }
}
