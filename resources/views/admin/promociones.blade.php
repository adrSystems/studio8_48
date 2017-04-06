@extends('layouts.master')
@section('title')
Promociones
@endsection
@section('css')
<style media="screen">
  body{
    background-image: url("{{asset('/img/walls/admin.jpg')}}");
  }
  .gestion-promociones{
    margin-top: 100px;
  }
  .promociones{
    background: rgba(255, 255, 255, 0.8);
    border-radius: 4px;
    color: #1F1F1F;
    height: 460px;
    overflow-y: scroll;
  }
  .promociones::-webkit-scrollbar {
    width: 0.5em;
  }
  .promociones::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  }

  .promociones::-webkit-scrollbar-thumb {
    background-color: darkgrey;
    outline: 1px solid slategrey;
  }
  .promocion{
    height: 170px;
    display: inline-block;
  }
  .panel{
    border: 0px;
  }
  .panel-heading{
    background-color: darkgray;
    color: #3F3F3F;
    font-weight: bold;
    height: 100px;
    font-family: 'Lobster Two';
  }
  .panel-title{
    margin-top: 25px;
    font-size: 20px;
  }
  .icono{
    float: left;
  }
  .promocion{
    border-radius: 2px;
    padding: 5px 10px;
    padding: 15px;
  }
  .promocion:hover{
    background-color: rgba(255, 255, 255, 0.6);
  }
  .promo{
    width: 100%;
  }
  .modal-body{
    padding: 10px 20px;
    margin-bottom: 20px;
  }
  .dropdown{
    margin-top: -5px;
    margin-left: -25px;
  }
  .btn-default{
    border: 0px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 100%;
  }
  .btn-default.active.focus,
  .btn-default.active:focus,
  .btn-default.active:hover,
  .btn-default:active.focus,
  .btn-default:active:focus,
  .btn-default:active:hover,
  .open>.btn-default.dropdown-toggle.focus,
  .open>.btn-default.dropdown-toggle:focus,
  .open>.btn-default.dropdown-toggle:hover{
      background-color: rgba(255, 255, 255, 0.1);
      border-color: inherit;
  }
  .open{
    background-color: rgba(255, 255, 255, 0);
  }
  .dropdown-menu{
    margin-left: -108px;
  }
  .title-promociones{
    border-left: 5px solid #ed5;
    border-radius: 4px;
    font-family: 'Lobster Two';
    color: white;
    letter-spacing: 1px;
  }
</style>
@endsection
@section('body')
<div class="container">
  <div class="col-md-12">
    <div class="gestion-promociones">
      @if(Session::has('error'))

          <div class="alert alert-danger" role="alert" style="text-align: center;">
              <h4>{{session('error')['titulo']}}</h4>
              <p><b>{{session('error')['cuerpo']}}</b></p>
          </div>

      @endif
      <div class="col-xs-6">
        <h3 class="title-promociones">Promociones existentes</h3>
        <div class="promociones">
          @foreach(\App\Promocion::get() as $promocion)
          <div class="promocion">
            <div class="col-xs-3" style="padding: 2px 5px;">
              <img class="promo" src="{{asset('storage/'.$promocion->cover)}}" alt="">
            </div>
            <div class="col-xs-8">
              <p>Fecha inicio: <i class="material-icons icono">date_range</i>{{$promocion->fecha_inicio}}</p>
              <p>Fecha termino: <i class="material-icons icono">date_range</i>{{$promocion->fecha_termino}}</p>
              @if($promocion->fecha_termino < Carbon\Carbon::now())
              <p style=""><i class="material-icons icono">delete</i> Terminado</p>
              @elseif($promocion->fecha_termino >= Carbon\Carbon::now())
              <p style=""><i class="material-icons icono">done</i> Disponible</p>
              @endif
              <p>Descuento: {{$promocion->descuento}}</p>
              <p>{{$promocion->servicio->nombre}}</p>
            </div>
            <div class="col-xs-1">
              <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  <i class="material-icons" style="margin-top: 4px;">more_vert</i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                  <li><a href="/promocion/editar/{{$promocion->id}}"><i class="material-icons">edit</i>Editar</a></li>
                  <li><a href="/promocion/eliminar/{{$promocion->id}}"><i class="material-icons">delete_sweep</i>Eliminar</a></li>
                </ul>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="col-xs-offset-1 col-xs-5">
        <div class="panel" style="margin-top: 60px;">
          <div class="panel-heading">
            <h3 class="panel-title">Agregar una promoción</h3>
          </div>
          <div class="panel-body">
            <form class="horizontal" action="/promocion/agregar" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="form-group">
                <span>Image de promocion</span>
                <input type="file" name="cover" value="" class="form-control">
              </div>
              <div class="form-group">
                <span>Fecha inicio</span>
                <input type="date" name="fecha_inicio" value="{{Carbon\Carbon::now()->toDateString()}}" class="form-control">
              </div>
              <div class="form-group">
                <span>Fecha fin</span>
                <input type="date" name="fecha_fin" value="{{Carbon\Carbon::now()->toDateString()}}" class="form-control">
              </div>
              <div class="form-group">
                <span>Servicio</span>
                <select class="form-control" name="servicio">
                  <option value="null">Seleccione a que servicio aplica promoción</option>
                  @foreach(\App\Servicio::get() as $servicio)
                    <option value="{{$servicio->id}}">{{$servicio->nombre}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <span>Descuento:</span>
                <input type="text" name="descuento" value="" class="form-control">
              </div>
              <div class="pull-right">
                <button type="submit" name="button" class="form-control"><i class="material-icons icono">save</i>Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
@endsection
