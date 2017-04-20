@extends('layouts.master')
@section('title')
Tips
@endsection
@section('css')
<style media="screen">

body{
  background: url('{{asset("img/covers/5.jpg")}}') center/ cover;
}
</style>
@endsection
@section('body')
<br><br><br><br>
<div class="container">

  <div class="row">
    @foreach(App\Tip::get() as $tip)
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
<br><br><br><br><br><br><br><br><br>
@endsection
@section('js')
@endsection
