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
    margin-top: 80px;
  }
  .panel{
    border: 0px;
    margin-top: 20px;
  }
  .panel-heading{
    background-color: #1F1F1F;
    font-family: 'Lobster Two';
    color: white;
    height: 100px;
    text-align: left;
    margin: 0;
  }
  img{
    width: 25%;
  }
  .icono{
    float: left;
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
  <div class="col-md-12 servicio">
    <div class="col-xs-offset-3 col-xs-6">
      <a href="/admin/servicios" class="btn btn-back pull-right" style="margin-top: 20px;"><i class="material-icons" style="float: left;">arrow_back</i>Volver a servicios</a>
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
              <input type="text" name="nombre" value="{{$servicio->nombre}}" class="form-control" required>
            </div>
            <div class="form-group">
              <span>Costo:</span>
              <input type="number" name="precio" value="{{$servicio->precio}}" class="form-control" required>
            </div>
            <div class="form-group">
              <span>Icono actual:</span><br>
              <img src="{{asset('storage/'.$servicio->icono)}}" alt=""><br>
              <span>Modificar icono:</span>
              <input type="file" name="icono" value="" class="form-control" accept="image/*">
            </div>
            <div class="form-group">
              <span>Tiempo actual <b>{{$servicio->tiempo}}</b></span> <br>
              <span>Tiempo:</span>
              <select class="form-control" name="duracion" required>
                <option value="{{$servicio->tiempo}}">{{$servicio->tiempo}}</option>
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
              <button type="submit" name="button" class="btn"><i class="material-icons icono">save</i>Guardar</button>
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
