@extends('layouts.master')
@section('title')
Editar promociones
@endsection
@section('css')
<style media="screen">
  body{
    background-image: url("{{asset('/img/walls/admin.jpg')}}");
  }
  .promo{
    width: 200px;
    margin-left: 20px;
  }
  .panel{
    border: 0px;
  }
  .panel-heading{
    background-color: #1F1F1F;
    font-family: 'Lobster Two';
    color: white;
    height: 100px;
    text-align: left;
    margin: 0;
  }
  .panel-title{
    font-size: 20px;
    margin-top: 30px;
  }
  .panel-body{
    background-color: rgba(255, 255, 255, 0.1);
  }
</style>
@endsection
@section('body')
<div class="container">
  <div class="col-md-12">
    <div class="col-xs-offset-3 col-xs-6" style="margin-top: 100px;">
      @if(Session::has('error'))
          <div class="alert alert-warning" role="alert">
              <h4>{{session('error')['titulo']}}</h4>
              <p>{{session('error')['cuerpo']}}</p>
          </div>
      @endif
      <div class="panel">
        <div class="panel-heading">
          <h3 class="panel-title">Editar promocion</h3>
        </div>
        <div class="panel-body">
          <form class="horizontal" action="/promocion/editar" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$promocion->id}}">
            <div class="form-group">
              <div class="imagen">
                <span>Imagen actual: </span>
                <img class="promo" src="{{asset('storage/'.$promocion->cover)}}" alt="">
              </div>
              <span>Cambiar imagen de la promocion</span>
              <input type="file" name="cover" value="" class="form-control">
            </div>
            <div class="form-group">
              <span>Cambiar fecha de inicio</span>
              <input type="date" name="fecha_inicio" value="{{$promocion->fecha_inicio}}" class="form-control">
            </div>
            <div class="form-group">
              <span>Cambiar fecha de fin</span>
              <input type="date" name="fecha_termino" value="{{$promocion->fecha_termino}}" class="form-control">
            </div>
            <div class="form-group">
              <span>Descuento</span>
              <input type="text" name="descuento" value="{{$promocion->descuento}}" class="form-control">
            </div>
            <div class="form-group">
              <span>Servicio</span>
              <select class="form-control" name="servicio">
                <option value="{{$promocion->servicio_id}}">Seleccione a que servicio aplica promoción</option>
                @foreach(\App\Servicio::get() as $servicio)
                  <option value="{{$servicio->id}}">{{$servicio->nombre}}</option>
                @endforeach
              </select>
            </div>
            <div class="pull-right">
              <button type="submit" name="button" class="btn btn-info">Editar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
@section('js')
@endsection
