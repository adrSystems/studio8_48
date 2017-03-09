@extends('layouts.master')
@section('title')
Mi cuenta
@endsection
@section('css')
<style>
.cuenta{
  margin-top: 100px;

}
.item-nav{
  font-weight: 100;
  font-family: 'Lobster Two';
  color: #ed5;
  font-size: 16px;
  text-align: center;
  background-color: #111;
  border: 2px solid #ed5;
  margin-top: 4px;
}
.item-nav:hover{
  color: black;
}

</style>
@endsection
@section('body')
<div class="col-md-offset-2 col-md-8 cuenta well">
  <div class="col-xs-4 fontnav">
    <ul class="nav nav-pills nav-stacked">
    <li role="presentation"><a class="item-nav" href="#">Perfil</a></li>
    <li role="presentation"><a class="item-nav" href="#">Mensajes</a></li>
  </div>

</ul>

</div>

@endsection
@section('js')
@endsection
