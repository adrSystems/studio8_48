@extends('layouts.master')
@section('title')
Promociones y concursos
@endsection
@section('css')
<style media="screen">
  body{
    background: #fff;
  }
  .mensaje{
    margin-top: 30px;
    color: #aaa;
    border: 1px solid rgba(0, 0, 0, .08);
    border-radius: 3px;
    padding: 5px;
    text-align: center;
    box-shadow: inset 0 0 3px rgba(0, 0, 0, .05);
  }
  .item{
    overflow: visible;
  }
  .item>.info-cont{
    background-color: #333;
    width: 100%;
    border: 1px solid rgba(0, 0, 0, .08);
    border-top: none;
    padding: 5px;
    text-align: center;
  }
  .item>.info-cont>p{
    margin: 0;
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
            @if($promociones->count() > 0)
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner" role="listbox">
                  <div class="item active">
                    <img src="{{asset($promociones->first()->cover)}}" alt="..." class="image center-block">
                    <div class="info-cont">
                      <p class="clear-text2" style="">{{$promociones[0]->vigencia}}</p>
                    </div>
                  </div>
                  @foreach($promociones as $i => $promocion)
                  @if($i > 0)
                  <div class="item">
                    <img src="{{asset($promocion->cover)}}" alt="..." class="image center-block">
                    <div class="info-cont">
                      <p class="clear-text2" style="">{{$promocion->vigencia}}</p>
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
          @if($concursos->count() > 0)
          <div id="carousel-example-generic2" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
            <div class="item active">
              <img src="{{asset($concursos[0]->imagen)}}" alt="..." class="image img-responsive center-block">
              <div class="info-cont">
                <p class="clear-text2" style="">{{$concursos[0]->vigencia}}</p>
              </div>
            </div>
          @foreach($concursos as $i => $concurso)
          @if($i > 0)
          <div class="item">
            <img src="{{asset($concurso->imagen)}}" alt="..." class="image img-responsive center-block">
            <div class="info-cont">
              <p class="clear-text2" style="">{{$concurso->vigencia}}</p>
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
