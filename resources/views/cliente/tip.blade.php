@extends('layouts.master')
@section('css')
<style media="screen">
body{
  color:white;
    background: url('{{asset("img/covers/3.jpg")}}') center/ cover;
}
  .container{
    width: 100%;
    background-color: rgba(0, 0, 0, 0.5);
  }

</style>
@endsection
@section('body')
<br><br>
<div class="container">
  <div class="col-xs-12 col-md-12">
    <h2 align="center">{{$tips->titulo}}</h2><br>
    <img style="display:block;margin:0 auto 0 auto;width:250px;height:250px" src="{{asset('storage/'.$tips->portada)}}"><br><br>
    <p>{{$tips->cuerpo}}</p>
  </div>

</div><br><br>
@endsection
