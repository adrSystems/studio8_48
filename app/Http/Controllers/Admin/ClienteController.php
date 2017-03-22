<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Cliente;
use App\User;

class ClienteController extends Controller
{
    public function add(Request $request)
    {

      if($request->isMethod('get')){
        return view('admin.clientes.add');
      }

      $result = Validator::make($request->all(), [
        'name' => 'required',
        'lastName' => 'required',
        'birthday' => 'required|date',
        'tel' => 'required'
      ]);

      if($result->fails())
        return back()->with('msg', ['title' => 'Ups!', 'body' => 'Proporcione todos los datos.'])
               ->withInput();

      if(Cliente::where('nombre',$request->name)->where('apellido',$request->lastName)->where('fecha_nacimiento',$request->birthday)->count() > 0)
        return back()->with('msg', ['title' => 'Ups!', 'body' => 'El cliente ya ha sido registrado en el sistema.'])
               ->withInput();

      return $request->all();

      $cliente = new Cliente;
      $cliente->nombre = $request->name;
      $cliente->apellido = $request->lastName;
      $cliente->fecha_nacimiento = $request->birthday;
      $cliente->telefono = $request->tel;
      if($request->credito) $cliente->credito = 1;
      else $cliente->credito = 0;
      $cliente->save();

      return back()->with('msg', ['title' => 'Acción satisfactoria!', 'body' => 'Cliente registrado correctamente.']);
    }

    public function getDetailsForMainView()
    {
      $clientes = [];
      foreach (Cliente::get() as $cliente) {
        $deudor = false;
        foreach ($cliente->citas as $cita) {
          $aPagar=0;
          foreach ($cita->servicios() as $servicio) {
            $aPagar  += $servicio->precio - ($servicio->precio * (".".$servicio->pivot->descuento));
          }
          if($cita->pagos()->sum('cantidad') < $aPagar)
            $deudor=true;
        }
        foreach ($cliente->compras as $compra) {
          if($compra->pagos()->sum('cantidad') < $compra->productos()->sum('precio')){
            $deudor=true;
          }
        }
        $cliente->esDeudor = $deudor;
        $clientes[] = $cliente;
      }

      return view('admin.clientes.main', ['clientes' => $clientes]);
    }

    public function filter(Request $request)
    {
      $clientes=[];
      if($request->searchText == ''){
        $clientes = Cliente::get();
      }
      else{
        $clientes = Cliente::havingRaw('concat(nombre," ",apellido) like "%'
        .$request->searchText.'%" or telefono like "%'.$request->searchText.'%"')->get();
      }

      foreach ($clientes as $cliente) {
        $deudor = false;
        foreach ($cliente->citas as $cita) {
          $aPagar=0;
          foreach ($cita->servicios() as $servicio) {
            $aPagar  += $servicio->precio - ($servicio->precio * (".".$servicio->pivot->descuento));
          }
          if($cita->pagos()->sum('cantidad') < $aPagar)
            $deudor=true;
        }
        foreach ($cliente->compras as $compra) {
          if($compra->pagos()->sum('cantidad') < $compra->productos()->sum('precio')){
            $deudor=true;
          }
        }
        $cliente->esDeudor = $deudor;
        $cliente->citas = $cliente->citas;
        $cliente->compras = $cliente->compras;
      }

      if($request->filterId == 'con-cuenta'){
        foreach ($clientes as $i => $cliente) {
          if(!$cliente->cuenta){
            unset($clientes[$i]);
          }
        }
      }
      else if($request->filterId == 'sin-cuenta'){
        foreach ($clientes as $i => $cliente) {
          if($cliente->cuenta){
            unset($clientes[$i]);
          }
        }
      }
      else if($request->filterId == 'adeudados'){
        foreach ($clientes as $i => $cliente) {
          if(!$cliente->esDeudor){
            unset($clientes[$i]);
          }
        }
      }
      else if($request->filterId == 'al-corriente'){
        foreach ($clientes as $i => $cliente) {
          if($cliente->esDeudor){
            unset($clientes[$i]);
          }
        }
      }
      else if($request->filterId == 'con-credito'){
        foreach ($clientes as $i => $cliente) {
          if(!$cliente->credito){
            unset($clientes[$i]);
          }
        }
      }
      else if($request->filterId == 'sin-credito'){
        foreach ($clientes as $i => $cliente) {
          if($cliente->credito){
            unset($clientes[$i]);
          }
        }
      }
      return $clientes;
    }
}
