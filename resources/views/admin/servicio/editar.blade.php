@extends('layouts.master')
@section('title')
Editar
@endsection
@section('css')
<style media="screen">
  body{
    background-image: url("{{asset('img/walls/admin.jpg')}}");
  }
  .footer{
    margin-top: 40%;
  }
  .servicio{
    margin-top: 100px;
  }
  .panel{
    border: 0px;
    margin-top: 20px;
  }
  .panel-heading{
    background-color: #1F1F1F;
    color: #ed5;
    font-family: 'Lobster Two';
  }
  img{
    width: 25%;
  }
  i{
    float: left;
  }
  .volver{
    margin-top: -20px;
    text-decoration: none;
    color: white;
    background-color: #3F3F3F;
    font-size: 16px;
    padding: 10px;
    border-radius: 2px;
  }
  .volver:hover{
    box-shadow: 5px 5px 2px #888888;
    color: white;
  }
</style>
@endsection
@section('body')
{{$servicio}}
<div class="container">
  <div class="col-md-12 servicio">
    <div class="col-xs-offset-7 col-xs-4">
      <a href="/admin/servicios" class="volver"><i class="material-icons">arrow_back</i>Volver a Servicios</a>
    </div>
    <div class="col-xs-offset-3 col-xs-6">
      <div class="panel">
        <div class="panel-heading">
          <h3 class="panel-title">Editar el servicio: <b>{{$servicio->nombre}}</b></h3>
        </div>
        <div class="panel-body">
          <form class="horizontal" action="/servicio/editar" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$servicio->id}}">
            <div class="form-group">
              <span>Nombre del servicio:</span>
              <input type="text" name="nombre" value="{{$servicio->nombre}}" class="form-control">
            </div>
            <div class="form-group">
              <span>Costo:</span>
              <input type="text" name="precio" value="{{$servicio->precio}}" class="form-control">
            </div>
            <div class="form-group">
              <span>Icono actual:</span><br>
              <img src="{{asset('storage/'.$servicio->icono)}}" alt=""><br>
              <span>Modificar icono:</span>
              <input type="file" name="icono" value="" class="form-control">
            </div>
            <div class="form-group">
              <span>Tiempo actual <b>{{$servicio->tiempo}}</b></span> <br>
              <span>Tiempo:</span>
              <select class="form-control" name="duracion">
                <option value="{{$servicio->tiempo}}">Seleccione la duracion del servico</option>
                <option value="00:30:00">30 min</option>
                <option value="01:00:00">1:00 hr</option>
                <option value="01:30:00">1:30 hrs</option>
                <option value="02:00:00">2:00 hrs</option>
                <option value="02:30:00">2:30 hrs</option>
                <option value="03:00:00">3:00 hrs</option>
                <option value="03:30:00">3:30 hrs</option>
                <option value="04:00:00">4:00 hrs</option>
                <option value="04:30:00">4:30 hrs</option>
                <option value="05:00:00">5:00 hrs</option>
              </select>
            </div>
            <div class="pull-right">
              <button type="submit" name="button" class="btn"><i class="material-icons">save</i>Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    $('.delete').click(function(){
      var $btn = $(this);
      $.ajax({
        url: '/servicio/delete',
        data:{
          _token: "{{csrf_token()}",
          id: $(this).attr('id')
        },
        type: 'POST'
      }).done(function(response){

      });
    });
  });
</script>
@endsection
