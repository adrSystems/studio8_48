@extends('layouts.master')
@section('css')
<style media="screen">
body{
  color:white;
    background: url('{{asset("img/covers/5.jpg")}}') center/ cover;
}
  .container{
    width: 100%;
    background-color: rgba(0, 0, 0, 0.5);
  }
#cont{
  font-size: 27px;
}
</style>
@endsection
@section('body')
<br><br>
<div class="container">
  <div class="col-xs-12 col-md-12">
    <h1 align="center">{{$tips->titulo}}</h1><br>
    <img style="display:block;margin:0 auto 0 auto;width:200px;height:250px" src="{{asset('storage/'.$tips->src)}}"><br><br>
    <p id="cont" align="center">{{$tips->contenido}}</p>
  </div>

</div><br><br>
@endsection
