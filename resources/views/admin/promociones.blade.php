@extends('layouts.master')
@section('title')
@endsection
@section('css')
<style media="screen">
  body{
    background-image: url("{{asset('/img/walls/admin.jpg')}}");
  }
</style>
@endsection
@section('body')
<div class="container">
  <div class="col-md-12">
    <div class="gestion-promociones">
      <div class="col-xs-5">
        <div class="promociones">
          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
@endsection
