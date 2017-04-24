@extends('layouts.master')
@section('title')
Promociones y concursos
@endsection
@section('css')
<style media="screen">
  body{
    background: #fff;
  }
</style>
@endsection
@section('body')
  <div class="main-container">
    <div class="container">
      <div class="col-md-12">
        <div class="contenido">
          <div class="col-xs-12 col-md-5">
            <h3 class="dark-text1">¡Promociones!</h3>
            <h4 class="dark-text3">Aprovecha los descuentos que tenemos para ti.</h4>
            @if(\App\Promocion::count() > 0)
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
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
                  @if($promocion->id!=1)
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
            @else
            <div class="mensaje">
              <p>Por el momento no hay ninguna promoción disponible.</p>
              <p>¡Gracias por visitarnos!</p>
              <p><i class="material-icons">mood</i></p>
            </div>
            @endif
          </div>

        <div class="col-xs-12 col-md-offset-2 col-xs-5 col-md-5">
          <h3 class="dark-text1">¡Concursos!</h3>
          <h4 class="dark-text3">Participa en nuestros concursos y podrás ganar increibles premios.</h4>
          @if(\App\Concurso::count() > 0)
          <div id="carousel-example-generic2" class="carousel slide" data-ride="carousel">
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
          @if($concurso->id!=1)
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
        @else
        <div class="mensaje">
          <p>Por el momento no hay ningun concurso disponible.</p>
          <p>¡Gracias por visitarnos!</p>
          <p><i class="material-icons">mood</i></p>
        </div>
        @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
@endsection
