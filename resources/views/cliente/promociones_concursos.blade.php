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
  .image{
    border-radius: 4px;
    border: 3px solid white;
    width: inherit;
    height: 50px;
    transition: 2.5s ease;
 	-webkit-transition: 1.5s ease;
 	-o-transition: 1.5s ease;
  }
  .image:hover{
    -webkit-transform : rotate(15deg);
	   -moz-transform : rotate(15deg); /* Firefox */
	    -webkit-transform : rotate(15deg);
      -o-transform : rotate(15deg); /* Opera */
  }
  .carousel-inner>.item>a>img,
  .carousel-inner>.item>img{
    display: block;
    max-width: 100%;
    height: auto;
    max-height: 1000%;
    line-height: 1;
    background-color: white;
  }
  .concurso{
    margin-top: 250px;
  }
  .carousel-caption{
    color: #ed5;
    font-size: 26px;
    margin-top: 100px;
  }
  .carousel{
    width: 800px;
    margin-left: 150px;
  }
  .carousel-inner{
    height: 670px;
    background-color: rgba(255, 255, 255, 0.6);
  }
  .item{
    width: 100%;
    height: 10%;
  }
  #capa2{

    z-index: 0;
    margin-left: 75%;
  }
  #capa1{

    z-index: 1;
  }
  .btn-success{
    width: 200px;
    height: 80px;
    font-size: 22px;
    padding: 20px;
    font-family: 'Lobster Two';
    border-radius: 4px;
  }
  .content-carrusel{
    position: absolute;
    z-index: 10;
    margin-top: -10px;
    text-align: center;
    font-family: 'Lobster Two';
    border: 1px solid #ed5;
    background-color: #1F1F1F;
    padding: 5px 10px;
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
          <img src="{{asset('storage/'.App\Promocion::first()->cover)}}" alt="..." class="image center-block">
          <div class="carousel-caption">
            @if(App\Promocion::first()->fecha_termino < Carbon\Carbon::now())
            <p class="content-carrusel" style="">Terminado</p>
            @elseif(App\Promocion::first()->fecha_termino >= Carbon\Carbon::now())
            <p class="content-carrusel" style="">Disponible</p>
            @endif
          </div>
        </div>
        @foreach(App\Promocion::get() as $promocion)
        @if($promocion->id != 2)

        <div class="item">
          <img src="{{asset('storage/'.$promocion->cover)}}" alt="..." class="image center-block">
          <div class="carousel-caption">
            @if($promocion->fecha_termino < Carbon\Carbon::now())
            <p class="content-carrusel" style="">Terminado</p>
            @elseif($promocion->fecha_termino >= Carbon\Carbon::now())
            <p class="content-carrusel" style="">Disponible</p>
            @endif
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
          <img src="{{asset('storage/'.App\Concurso::first()->imagen)}}" alt="..." class="image img-responsive center-block">
          <div class="carousel-caption">
             @if(App\Concurso::first()->fecha_termino < Carbon\Carbon::now())
             <p class="content-carrusel" style="">Terminado</p>
             @elseif(App\Concurso::first()->fecha_termino >= Carbon\Carbon::now())
             <p class="content-carrusel" style="">Disponible</p>
             @endif
          </div>
        </div>
        @foreach(App\Concurso::get() as $concurso)
        @if($concurso->id != 2)
        <div class="item">
          <img src="{{asset('storage/'.$concurso->imagen)}}" alt="..." class="image img-responsive center-block">
          <div class="carousel-caption">
            @if($concurso->fecha_termino < Carbon\Carbon::now())
            <p class="content-carrusel" style="">Terminado</p>
            @elseif($concurso->fecha_termino >= Carbon\Carbon::now())
            <p class="content-carrusel" style="">Disponible</p>
            @endif
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
