@extends('layouts.master')
@section('title')
Gestion Imagenes
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
        <th>Imagen</th>
        <th>Fecha de creacion</th>
        <th>Accion</th>
      </tr>
    </thead>
    <tbody>
    @foreach(App\Imagen::where("src","!=","null")->get() as $imagen)
      <tr>
        <td><a href=""><img src="storage/{{$imagen->src}}" alt="" height="100px" width="80px"></a></td>
        <td>{{$imagen->created_at}}</td>
        <td><a href="/borrar_imagen/{{$imagen->id}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div><br><br><br><br><br><br>
@endsection
@section('js')
