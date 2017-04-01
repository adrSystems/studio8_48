@extends('layouts.master')
@section('title')
@endsection
@section('css')
<style media="screen">
  body{
    background-image: url("{{asset('/img/walls/admin.jpg')}}");
  }
  .gestion-promociones{
    margin-top: 100px;
  }
  .promociones{
    background-color: white;
    border-radius: 4px;
    color: #1F1F1F;
    height: 400px;
  }
  .promocion{
    border: 1px solid darkgray;
    border-radius: 2px;
  }
</style>
@endsection
@section('body')
<div class="container">
  <div class="col-md-12">
    <div class="gestion-promociones">
      <div class="col-xs-5">
        <div class="promociones">
          @foreach(App\Promocion::get() as $promocion)
          <div class="promocion">

          </div>
          @endforeach
        </div>
      </div>
      <div class="col-xs-offset-1 col-xs-6">
        <form class="horizontal" action="/promocion/agregar" method="post">
          <div class="form-group">
            <input type="file" name="cover" value="" class="form-control">
          </div>
          <div class="form-group">
            <input type="date" name="fecha_inicio" value="" class="form-control">
          </div>
          <div class="form-group">

          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
@endsection
