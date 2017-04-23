@extends('layouts.master')
@section('title')
Tips
@endsection
@section('css')
<style media="screen">
body{
  background-color: #fff;
  background: url('{{asset("img/walls/5.jpg")}}');
  background-repeat: no-repeat;
  background-size: cover;
}
.card2{
  background-color: #fff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
  border-radius: 5px;
  padding: 50px;
  color: #333;
  text-align: center;
}
</style>
@endsection
@section('body')
<div class="main-container">
  <div class="container">
    <div class="row">
      @if(count($tips = App\Tip::get()) < 1)
      <div class="col-xs-12">
        <div class="card2 col-xs-12 col-md-6 col-md-offset-3">
          <h3 style="margin:0">Por el momento no se encontró contenido...</h3>
          <h4>Pronto estará disponible. Estate atento...</h4>
        </div>
      </div>
      @endif
      @foreach($tips as $tip)
      <div class="col-md-4" style="width:212px;">
        <div class="panel panel-default" >
          <div class="panel-thumbnail"><a href="/tip/{{$tip->id}}"><img src="storage/{{$tip->src}}" height="160px" width="180px"></a></div>
          <div class="panel-body">
            <h4 align="center">{{$tip->titulo}}</h4>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
@section('js')
@endsection
