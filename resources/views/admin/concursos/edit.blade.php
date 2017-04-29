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
  .footer{
    margin-top: 80px;
  }
</style>
@endsection
@section('body')
<div class="container">
  <div class="col-md-12">
    <div class="col-xs-offset-3 col-xs-6" style="margin-top: 100px;">
      @if(Session::has('error'))
      @foreach(Session::get('error') as $error)
          <div class="alert alert-warning" role="alert">
            {{$error}}
          </div>
      @endforeach
      @endif
      <a href="/admin/concursos" class="btn btn-back pull-right"><i class="material-icons" style="float: left;">arrow_back</i>Volver a concursos</a>
      <div class="panel">
        <div class="panel-heading">
          <h3 class="panel-title">Editar concurso</h3>
        </div>
        <div class="panel-body">
          <form class="horizontal" action="/concurso/editar" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$concurso->id}}">
            <div class="form-group">
              <div class="imagen">
                <span>Imagen actual: </span>
                <img class="promo" src="{{asset($concurso->imagen)}}" alt="">
              </div>
              <span>Cambiar imagen de la promocion</span>
              <input type="file" name="imagen" value="" class="form-control">
            </div>
            <div class="form-group">
              <span>Cambiar fecha de inicio</span>
              <input type="date" name="fecha_inicio" value="{{$concurso->fecha_inicio}}" class="form-control">
            </div>
            <div class="form-group">
              <span>Cambiar fecha de fin</span>
              <input type="date" name="fecha_fin" value="{{$concurso->fecha_termino}}" class="form-control">
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
