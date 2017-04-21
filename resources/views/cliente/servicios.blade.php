@extends('layouts.master')
@section('title')
Catalogo de servicios
@endsection
@section('css')
<style media="screen">
  body{
    background-image: url("{{asset('img/walls/4.jpg')}}");
    background-repeat: repeat;
    background-attachment: fixed;
  }
  .catalogo{
    margin-top: 70px;
  }
  .servicio{
    margin-top: 10px;
    height: 400px;
    background-color: white;
    border-radius: 4px;
    padding: 10px;
  }
  .servicio:hover{
    border: 4px solid #1F1F1F;
  }
  .image{
    width: 100%;
    height: 60%;
    border-radius: 2px;
  }
  .descripcion{
    text-align: center;
  }
  .footer{
    margin-top: 50px;
  }
  .modal-body{
    display: inline-block;
    width: 100%;
  }
</style>
@endsection
@section('body')
<div class="container">
  <div class="catalogo">
    @if(App\servicio::get())
    @foreach(App\Servicio::get() as $servicio)
      <div class="col-sm-6 col-md-3">
        <div class="servicio">
          <img class="image" src="{{asset('storage/'.$servicio->icono)}}" alt="...">
          <div class="descripcion">
            <h3>{{$servicio->nombre}}</h3>
            <p><a href="#" data-toggle="modal" data-target="#detalle{{$servicio->id}}" class="btn btn-default" role="button">Ver más</a></p>
          </div>
        </div>
      </div>
      <div class="modal fade" id="detalle{{$servicio->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" name="button"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">{{$servicio->nombre}}</h4>
            </div>
            <div class="modal-body">
              <div class="col-xs-5 col-md-5" style="paddign: 10px;">
                <img src="{{asset('storage/'.$servicio->icono)}}" alt="" style="width: 100%;">
              </div>
              <div class="col-xs-offset-1 col-md-offset-1 col-xs-6 col-md-6" style="color: #1F1F1F; text-align: center; border: 2px solid #1f1f1f; padding: 20px;">
                <p>Duración</p>
                <p style="font-size: 22px;"><i class="material-icons" style="margin-top: 10px;">timer</i>{{$servicio->tiempo}}</p>
                <p>Precio</p>
                <p style="font-size: 22px;"><b><span>$</span>{{$servicio->precio}} <span style="font-size: 10px;">MX</span></p></b>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" name="button">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    @endforeach
    @else
    <div class="alert alert-success">
      Por el momento no se encuentra ningún servicio disponible.
    </div>
    @endif
  </div>
</div>
@endsection
@section('js')
@endsection
