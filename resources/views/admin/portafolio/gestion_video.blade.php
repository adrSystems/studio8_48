@extends('layouts.master')
@section('title')
Gestion Videos
@endsection
@section('css')
<style media="screen">
  body{
    background: url('{{asset("img/covers/1.jpg")}}');

  }
  th{
    font-size: 20px;
  }
  body{
    color: white;
  }
  .container{
    background-color: rgba(0, 0, 0, 0.5);
  }
</style>
@endsection
@section('body')
<br><br><br><br>
<div class="container">
  @if(Session::has('msg'))
           <div class="alert alert-danger" role="alert">
             <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
             <span class="sr-only">Error:</span>
               {{Session::get('msg')}}
              </div>
              @endif
  <table class="table table-inverse">
    <thead>
      <tr>
        <th>Video</th>
        <th>Descripcion</th>
        <th>Fecha de creacion</th>
        <th>Accion</th>
      </tr>
    </thead>
    <tbody>
    @foreach(App\Imagen::where("link","!=","null")->get() as $imagen)
      <tr>
        <td><a href="">{{$imagen->link}}</a></td>
        <td>{{$imagen->descripcion_video}}</td>
        <td>{{$imagen->created_at}}</td>
        <td><a href="/borrar_video/{{$imagen->id}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div><br><br><br><br><br><br>
@endsection
@section('js')
