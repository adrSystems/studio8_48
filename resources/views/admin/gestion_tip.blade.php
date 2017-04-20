@extends('layouts.master')
@section('title')
Gestionar Tips
@endsection
@section('css')
<style media="screen">
  body{
    background: url('{{asset("img/covers/4.jpg")}}');

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
        @if(Session::has('msg2'))
              <div class="alert alert-success" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                  {{Session::get('msg2')}}
                </div>
              @endif
  <table class="table table-inverse">
    <thead>
      <tr>
        <th>Titulo</th>
        <th>Portada</th>
        <th>Fecha de creacion</th>
        <th>Accion</th>
      </tr>
    </thead>
    <tbody>
    @foreach(App\Tip::get() as $tip)
      <tr>
        <td>{{$tip->titulo}}</td>
        <td><a href="/tip/{{$tip->id}}"><img src="storage/{{$tip->src}}" alt="" height="100px" width="80px"></a></td>
        <td>{{$tip->created_at}}</td>
        <td><a href="/modificartip/{{$tip->id}}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
        <br><br><a href="/borrartip/{{$tip->id}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div><br><br><br><br><br><br>
@endsection
@section('js')
