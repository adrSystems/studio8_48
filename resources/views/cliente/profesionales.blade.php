@extends('layouts.master')

@section('title')
Profesionales
@endsection

@section('css')
<style type="text/css">
  html, body{
    height: 100%;
  }
  body{
    color:#c5b358;
    background-color: #efe;
    font-family: 'Lato';
    background: url('{{asset("img/walls/2.jpg")}}') center / cover;
    background-repeat: no-repeat;
  }
  h4{
    color:#c5b358;
    font-family: 'Lato';
  }
  .img-container{
    overflow: hidden;
    width: 100%;
  }
  .img-container-circle{
    border-radius: 100%;
  }
  .img-container:hover img{
    -webkit-transform: scale(1.1);
  }
  .img-container>img{
    width: 100%;
    -webkit-transition: -webkit-transform .5s;
  }
  .btn1{
    cursor: pointer;
    border: 1px solid dodgerblue;
    border-radius: 4px;
    padding: 5px;
    color: dodgerblue;
    text-decoration: none;
    -webkit-transition: background-color .5s, color .5s, padding .2s;
  }
  .btn1:hover{
    background-color: dodgerblue;
    color: #fff;
    padding-left: 10px;
    padding-right: 10px;
  }
  .card2{
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    float: left;
  }
  .card2>.info{
    padding: 15px;
    float: left;
    width: 100%;
  }
  .card2>.info>.title{
    margin: 0;
    text-align: center;
    margin-bottom: 10px;
    color: #111;
  }
  #information-container{
    color: #333;
  }
</style>
@endsection

@section('body')
<div class="main-container">
  <div class="container">
  <h1 style="font-weight:900;color:#198;text-align:center">Profesionales</h1>
  <div class="col-xs-12">
  @foreach(App\Empleado::with('roles')->get() as $empleado)
  @if($empleado->roles()->where('nombre','estilista')->first())
  <div class="col-xs-12 col-md-3">
    <div class="card2 col-xs-12" style="padding:0">
      <div class="img-container">
        <img src="storage/{{$empleado->fotografia}}">
      </div>
      <div class="info">
        <h4 class="title">{{$empleado->nombre}}</h4>
        @foreach($empleado->roles as $rol)
        <p align="center" style="color:#555">{{ucfirst($rol->nombre)}}</p>
        @endforeach
        <span data-toggle="modal" data-target="#id_modal{{$empleado->id}}" class="btn1 center est-info-toggle">Ver mas información</span>
        <div class="modal fade" id="id_modal{{$empleado->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLongTitle">{{$empleado->nombre}} {{$empleado->apellido}}</h4>
              </div>
              <div class="modal-body col-xs-12">
                <div class="col-xs-12 col-md-6">
                <div class="img-container img-container-circle">
                  <img src="storage/{{$empleado->fotografia}}">
                </div>
                </div>
                <div class="col-xs-12 col-md-6" id="information-container">
                  <h4>Informacion</h4>
                  <p>{{$empleado->info}}</p>
                  <h5>Fecha de nacimiento: {{$empleado->fecha_nacimiento}}</h5>
                  <h5>Puesto:</h5>
                  @foreach($empleado->roles as $rol)
                  <h5>{{ucfirst($rol->nombre)}}</h5>
                  @endforeach
                </div>
              </div>
              <div class="modal-footer">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
  @endforeach
  </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

  $.each($('.img-container') ,function (i, e) {
    $(e).height($(e).width());
  })

  $(document).ready(function () {

    $('.est-info-toggle').click(function () {
      setTimeout(function () {
        $.each($('.img-container') ,function (i, e) {
          $(e).height($(e).width());
        })
      }, 200)
    })

    $(window).resize(function () {
      $.each($('.img-container') ,function (i, e) {
        if($(e).hasClass('img-container-circle')){
          $(e).height($(e).width());
        }
      })
    })

  })
</script>
@endsection
