@extends('layouts.master')
@section('title')
Promociones y concursos
@endsection
@section('css')
<style media="screen">
  .contenido{
    margin-top: 80px;
  }
  .carousel{
    height: 500px;
  }
  .item{
    margin: 0 auto;
    width: 60%;
  }
  .footer{
    margin-top: 200px;

  }
  .title{
    border-left: 5px solid #ed5;
    border-right: 5px solid #ed5;
    font-family: 'Lobster Two';
    border-radius: 4px;
    text-align: center;
  }
  .concurso{
    margin-top: 250px;
  }
  .carousel-caption{
    color: #ed5;
  }
</style>
@endsection
@section('body')
  <div class="container">
    <div class="col-md-12">
      <div class="contenido">
        <h3 class="title">¡Promociones!</h3>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          @foreach(App\Promocion::get()->where('deleted_at','!','null') as $promocion)
          <li data-target="#carousel-example-generic" data-slide-to="{{$promocion->id}}"></li>
          @endforeach
        </ol> -->

  <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="{{asset('storage/'.App\Promocion::first()->cover)}}" alt="...">
          <div class="carousel-caption">
            <h3></h3>
          </div>
        </div>
        @foreach(App\Promocion::get() as $promocion)
        @if($promocion->id != 2)
        <div class="item">
          <img src="{{asset('storage/'.$promocion->cover)}}" alt="..." class="img-responsive center-block">
          <div class="carousel-caption">
            
          </div>
        </div>
        @endif
        @endforeach
    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
      </div>
      <div class="concurso">
        <h3 class="title">¡Concursos!</h3>
        <div id="carousel-example-generic2" class="carousel slide" data-ride="carousel">
  <!-- Indicators
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          @foreach(App\Promocion::get()->where('deleted_at','!','null') as $promocion)
          <li data-target="#carousel-example-generic" data-slide-to="{{$promocion->id}}"></li>
          @endforeach
        </ol> -->

  <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="{{asset('storage/'.App\Concurso::first()->imagen)}}" alt="...">
          <div class="carousel-caption">
            ...
          </div>
        </div>
        @foreach(App\Concurso::get() as $concurso)
        @if($concurso->id != 2)
        <div class="item">
          <img src="{{asset('storage/'.$concurso->imagen)}}" alt="..." class="img-responsive center-block">
          <div class="carousel-caption">
            <h3>...</h3>
            <p>...</p>
          </div>
        </div>
        @endif
        @endforeach
    <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic2" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic2" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
        </div>
      </div>
      </div>
    </div>
  </div>
@endsection
@section('js')
@endsection
