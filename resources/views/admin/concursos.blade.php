@extends('layouts.master')
@section('title')
Promociones
@endsection
@section('css')
<style media="screen">
  body{
    background-image: url("{{asset('/img/walls/admin.jpg')}}");
  }
  .gestion-concursos{
    margin-top: 100px;
  }
  .concursos{
    background-color: white;
    border-radius: 4px;
    color: #1F1F1F;
    height: 460px;
    padding: 10px 20px;
    overflow-y: scroll;
  }
  .concursos::-webkit-scrollbar {
    width: 0.5em;
  }
  .concursos::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  }

  .concursos::-webkit-scrollbar-thumb {
    background-color: darkgrey;
    outline: 1px solid slategrey;
  }
  .concurso{
    border: 1px solid darkgray;
    border-radius: 2px;
    height: 100px;
    padding: 5px 10px;
  }
  .panel{
    border: 0px;
  }
  .panel-heading{
    background-color: darkgray;
    color: gray;
    font-family: 'Lobster Two';
  }
  .icono{
    float: left;
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
  }
  .dropdown-menu{
    margin-left: -100px;
  }
  .footer{
    margin-top: 100px;
  }
</style>
@endsection
@section('body')
<div class="container">
  <div class="col-md-12">
    <div class="gestion-concursos">
      <div class="col-xs-5">
        <div class="concursos">
          @foreach(\App\Concurso::get() as $concurso)
          <div class="concurso">
            <div class="col-xs-3" style="padding: 5px 10px;">
              <img class="promo" src="{{asset('storage/'.$concurso->imagen)}}" alt="">
            </div>
            <div class="col-xs-8">
              <p>Fecha inicio: <i class="material-icons icono">date_range</i>{{$concurso->fecha_inicio}}</p>
              <p>Fecha termino: <i class="material-icons icono">date_range</i>{{$concurso->fecha_termino}}</p>
            </div>
            <div class="col-xs-1">
              <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  <i class="material-icons">more_vert</i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                  <li><a href="/concurso/editar/{{$concurso->id}}"><i class="material-icons icono">edit</i>Editar</a></li>
                  <li><a href="/concurso/eliminar/{{$concurso->id}}"><i class="material-icons icono">delete_sweep</i>Eliminar</a></li>
                </ul>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="col-xs-offset-1 col-xs-6">
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title">Agregar un concurso</h3>
          </div>
          <div class="panel-body">
            <form class="horizontal" action="/concurso/agregar" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="form-group">
                <span>Image de promocion</span>
                <input type="file" name="imagen" value="" class="form-control">
              </div>
              <div class="form-group">
                <span>Fecha inicio</span>
                <input type="date" name="fecha_inicio" value="{{Carbon\Carbon::now()->toDateString()}}" class="form-control">
              </div>
              <div class="form-group">
                <span>Fecha fin</span>
                <input type="date" name="fecha_fin" value="{{Carbon\Carbon::now()->toDateString()}}" class="form-control">
              </div>
              <div class="pull-right">
                <button type="submit" name="button" class="form-control"><i class="material-icons">save</i>Guardar</button>
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
