<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Cliente;
use App\User;
use Carbon\Carbon;

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

      $cliente = new Cliente;
      $cliente->nombre = $request->name;
      $cliente->apellido = $request->lastName;
      $cliente->fecha_nacimiento = $request->birthday;
      $cliente->telefono = $request->tel;
      $cliente->fecha_registro = date("Y-m-d");
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
          if($compra->pagos()->sum('cantidad') < $compra->productos()->sum('precio_venta')){
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
          if($compra->pagos()->sum('cantidad') < $compra->productos()->sum('precio_venta')){
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

    public function getDetailsForPersonalInfoView(Request $request, $id = null)
    {
      if($id == null)
        return redirect('/admin/clientes');

      if(!$cliente = \App\Cliente::find($id))
        return redirect('/admin/clientes');

      $cliente->edad  = \Carbon\Carbon::createFromFormat('Y-m-d',$cliente->fecha_nacimiento)->diffInYears(\Carbon\Carbon::now());

      //determinar antiguedad
      $antiguedad = Carbon::createFromFormat('Y-m-d', $cliente->fecha_registro)->diffInDays(Carbon::now());

      if($antiguedad < 32)
        $cliente->antiguedad = ['medida' => 'dia(s)', 'tiempo' => $antiguedad];
      elseif($antiguedad < 365)
        $cliente->antiguedad = [
        'medida' => 'mes(es)',
        'tiempo' => Carbon::createFromFormat('Y-m-d', $cliente->fecha_registro)->diffInMonths(Carbon::now())
      ];
      else
        $cliente->antiguedad = [
        'medida' => 'año(s)',
        'tiempo' => Carbon::createFromFormat('Y-m-d', $cliente->fecha_registro)->diffInYears(Carbon::now())
      ];

      //determinar si es deudor
      $deudor = false;
      foreach ($cliente->citas as $cita) {
        $aPagar=0;
        foreach ($cita->servicios() as $servicio) {
          $aPagar  += $servicio->precio - ($servicio->precio * (".".$servicio->pivot->descuento));
        }
        $cita->monto = $aPagar;
        if($cita->pagos()->sum('cantidad') < $aPagar)
        {
          $deudor=true;
          $cita->pagada = false;
        }
        else $cita->pagada = true;
      }
      foreach ($cliente->compras as $compra) {
        if($compra->pagos()->sum('cantidad') < $compra->productos()->sum('precio_venta')){
          $deudor=true;
        }
      }

      $cliente->esDeudor = $deudor;
      $cliente->citas = $cliente->citas;
      $cliente->compras = $cliente->compras;

      //por cada compra determinar monto y si fue pagada

      return view('admin.clientes.info', ['cliente' => $cliente]);
    }

    public function updateCredit(Request $request)
    {
      $cliente = Cliente::find($request->id);
      if($cliente->credito) $cliente->credito = 0;
      else $cliente->credito = 1;
      $cliente->save();
    }

}
