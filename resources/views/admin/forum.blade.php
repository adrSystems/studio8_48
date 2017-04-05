@extends('layouts.master')
@section('title')
Foro Admin
@endsection
@section('css')
<style media="screen">
  .forum{
    margin-top: 100px;
  }
  .nav{
    background-color: #1F1F1F;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    height: 500px;
    overflow-y: scroll;
  }
  .nav::-webkit-scrollbar {
    width: 0.5em;
  }
  .nav::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  }
  .nav::-webkit-scrollbar-thumb {
     outline: 1px solid slategrey;
  }
  .nav li.item a{
    border-radius: 0px;
    color: white;
    background-color: #3F3F3F;
    font-family: 'Lobster Two';
    margin-top: -2px;
    font-size: 16px;
    -webkit-transition: 0.3s ease;
  }
  .nav-pills li.active a,
  .nav-pills li.active a:hover,
  .nav-pills li.active a:focus{
    background-color: #1F1F1F;
    font-family: 'Lobster Two';
    text-align: center;
    font-size: 20px;
  }
  .nav li.title-nav a{
    font-family: 'Lato';
  }
  .nav li.item a:hover{
    color: white;
    background-color: black;
  }
  .panel{
    border: 0px;
  }
  .panel-body{
    height: 400px;
    overflow-y: scroll;
    font-family: 'Lobster Two';
    font-size: 16px;
    background-color: #3F3F3F;
  }
  .panel-body::-webkit-scrollbar {
    width: 0.5em;
  }
  .panel-body::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  }
  .panel-body::-webkit-scrollbar-thumb {
     outline: 1px solid slategrey;
  }
  .panel-heading{
    background-color: #1F1F1F;
    color: white;
  }
  .content-mensaje{
    border-bottom: 2px solid #1F1F1F;
    padding: 5px 10px;
    margin-top: 10px;
    text-align: left;
    color:white;
    letter-spacing: 1px;

  }
  .content-mensaje-admin{
    border-bottom: 2px solid #1F1F1F;
    padding: 5px 10px;
    margin-top: 10px;
    color: #ed5;
    text-align: right;
    letter-spacing: 1px;
    font-weight: 20px;
  }
  .panel-title{
    font-family: 'Lobster Two';
    font-size: 20px;
    letter-spacing: 1px;
  }
  .panel-footer{
    height: 100px;
  }
  .footer{
    margin-top: 50px;
  }
  .button-send{
    border-radius: 50%;
    text-align: center;
    color: #ed5;
    border: 2px solid #ed5;
    background-color: #1F1F1F;
    font-size: 20px;
    margin-top: 9px;
    width: 100%;
  }
</style>
@endsection
@section('body')
<div class="col-md-12 forum">
  @if(Session::has('error'))
  <div class="alert alert-danger" role="alert" style="text-align: center;">
    <h5>{{session('error')['titulo']}}</h5>
    <p><b>{{session('error')['cuerpo']}}</b></p>
  </div>
  @endif
  <div class="col-xs-3">

    <ul class="nav nav-pills nav-stacked">
      <li role="presentation" class="active"><a href="#">Clientes</a></li>
      @foreach(App\Cliente::get() as $cliente)
        <li role="presentation" class="item"><a href="/forum/{{$cliente->id}}">{{$cliente->nombre}} {{$cliente->apellido}}</a></li>
      @endforeach
    </ul>

  </div>
  <div class="col-offset-1 col-xs-8">
    <div class="panel">
        <div class="panel-heading">
          <h3 class="panel-title">
            @foreach($mensaje as $m)
            {{$m->cliente->nombre}} {{$m->cliente->apellido}}
              @break
            @endforeach
          </h3>
        </div>
        <div class="panel-body">
          @foreach($mensaje as $m)
            @if($m->by_cliente==1)
            <div class="content-mensaje">
              <p>{{$m->contenido}}</p>
            </div>
              @else
              <div class="content-mensaje-admin">
                <p>{{$m->contenido}}</p>
              </div>
            @endif
          @endforeach
        </div>
        <div class="panel-footer">
          <form class="horizontal" action="/admin/enviarMensaje" method="post" style="margin-left: 60px; margin-top: -10px;">
            {{csrf_field()}}
            @foreach($mensaje as $m)
            <input type="hidden" name="id" value="{{$m->cliente->id}}">
              @break
            @endforeach
            <div class="form-group">
              <div class="col-xs-10">
                <textarea name="contenido" rows="2" cols="80" class="form-control"></textarea>
              </div>
              <div class="col-offset-1 col-xs-1">
                <button type="submit" name="button" class="button-send" style="border-radius: 100%"><i class="material-icons" style="margin-top: 7px">send</i></button>
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
  $
</script>
@endsection
