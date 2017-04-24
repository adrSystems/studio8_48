@extends('layouts.master')

@section('title')
Gestion Imagenes
@endsection

@section('css')
<style media="screen">
  body{
    background-color: #333;
  }
  th{
    font-size: 20px;
  }
  .menu-container{
    border-radius: 3px;
    border: 1px solid rgba(0, 0, 0, .2);
    box-shadow: 0 1px 3px rgba(0, 0, 0, .1);
    overflow: hidden;
    margin-bottom: 15px;
  }
  .menu-container>.header{
    background-color: #111;
    padding: 20px;
  }
  .menu-container>.header>h4{
    color: #fff;
    margin: 0;
    text-align: center;
  }
  .menu-container>.body>a>.menu-item1{
    padding: 5px;
    text-align: center;
    float: left;
    width: 100%;
    color: #ddd;
  }
  .menu-container>.body>a>.menu-item1-active{
    font-weight: 900;
    color: #fff;
  }
  .menu-container>.body>a>.menu-item1:hover{
    background-color: rgba(255, 255, 255, .02);
    color: #fff;
  }
  .imagen-item{
    width: 100%;
    float: left;
    cursor: pointer;
    opacity: 0;
    -webkit-transition: opacity .7s;
  }
  .imagen-item>.img-container{
    width: 100%;
    position: relative;
    float: left;
    overflow: hidden;
  }
  .imagen-item>.img-container>.shadow{
    width: 100%;
    position: absolute;
    height: 100%;
    background-color: transparent;
    top: 0;
    left: 0;
    -webkit-transition: box-shadow .4s, background-color .4s;
  }
  .imagen-item>.img-container:hover .shadow{
    background-color: rgba(0, 0, 100, 0.1);
    box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.8);
  }
  .imagen-item>.img-container:hover img{
    -webkit-transform: scale(1.1);
  }
  .imagen-item>.img-container>img{
    width: 100%;
    -webkit-transition: -webkit-transform .4s;
  }
  .imagen-item>.img-container>.delete-btn{
    position: absolute;
    bottom: 0px;
    right: 0px;
    padding: 3px;
    color: #eee;
    text-shadow: 0 0 10px rgba(0, 0, 0, .8);
  }
  .imagen-item>.img-container>.delete-btn:hover{
    color: #fff;
  }
  .edit-link{
    position: absolute;
    bottom: 0px;
    left: 0px;
    text-decoration: none;
    height: 30px;
    width: 30px;
    padding: 3px;
    color: #eee;
    text-shadow: 0 0 10px rgba(0, 0, 0, .8);
  }
  .edit-link:link{
    text-decoration: none;
  }
  .edit-link:visited{
    color: #eee;
  }
  .edit-link:hover{
    color: #fff;
  }
  .imagen-item>.img-container>.edit-btn{
    position: relative;
    float: left;

  }
  .imagen-item>.img-container>.edit-btn:hover{
    color: #fff;
  }
  .imagen-item>.img-container>.servicio{
    position: absolute;
    top: 3px;
    left: 3px;
    background-color: dodgerblue;
    border-radius: 3px;
    color: #fff;
    padding: 0 3px 0 3px;
  }
  .card2{
    background-color: #fff;
    border-radius: 3px;
    float: left;
    width: 100%;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .2);
  }
  .dark-modal-back{
    position: fixed;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    z-index: 4;
    box-shadow: inset 0 0 100px rgba(0, 0, 0, .9);
    display: none;
    padding: 50px;
    overflow: auto;
  }
  .dark-modal-back::-webkit-scrollbar{
    display: none;
  }
  .dark-modal-back>i{
    font-size: 32px;
    color: #eee;
    position: absolute;
    top: 13px;
    right: 7px;
    cursor: pointer;
  }
  .dark-modal-back>.img-container{
    padding: 0;
    background-repeat: no-repeat;
    background-size: contain;
    background-position: center;
  }
  .dark-modal-back>.img-container>img{
    width: 100%;
  }
  p.empty-msg{
    margin: 0;
    padding: 20px;
    text-align: center;
    color: #888;
  }
  .info>textarea{
    width: 100%;
    resize: none;
    height: auto;
    border: none;
    background-color: transparent;
    outline: none;
    display: table;
    margin-bottom: 45px;
  }
</style>
@endsection

@section('body')
@foreach(\App\Tip::get() as $tip)
<div class="dark-modal-back" id="{{$tip->id}}">
    <i class="material-icons">close</i>
    <div class="img-container col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-2 col-lg-offset-5">
      <img src="{{asset('storage/'.$tip->src)}}" alt="">
    </div>
    <div class="info col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
      <h3 class="text-center clear-text1">{{$tip->titulo}}</h3>
      <textarea class="text-center clear-text3" disabled="true">{{$tip->contenido}}</textarea>
    </div>
</div>
@endforeach

<form class="" action="/admin/tips/borrar" method="post">
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <input type="hidden" name="id" value="">
</form>

<div class="msg-container" id="eliminar-item-msg-dialog">
  <div class="msg-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <h3></h3>
    </div>
    <div class="body">
    </div>
    <div class="msg-footer">
      <button type="button" name="button" id="delete-item-btn">Eliminar</button>
      <button type="button" name="button" id="close-btn">Cerrar</button>
    </div>
  </div>
</div>

<div class="main-container">
    <div class="container">
      <div class="col-xs-12" style="margin-bottom:15px">
        <h3 class="clear-text1">Tips</h3>
        <h4 class="clear-text3">Añade y gestiona el contenido que se mostrará a los clientes.</h4>
      </div>
      <div class="col-xs-12 col-md-3">
        <div class="menu-container">
          <div class="header">
            <h4>Opciones</h4>
          </div>
          <div class="body">
            <a href="/admin/tips/subir">
              <div class="menu-item1">Nuevo elemento</div>
            </a>
            <a href="/admin/tips/gestion">
              <div class="menu-item1 menu-item1-active">Gestionar contenido</div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-9">
        <div class="card2">
          @if(count($tips = \App\Tip::get()) < 1)
          <p class="empty-msg">No se encontraron tips... El contenido pronto estará disponible!</p>
          @else
          @foreach($tips as $tip)
          <div class="col-xs-12 col-sm-6 col-md-4" style="padding:15px">
            <div class="imagen-item">
              <div class="img-container">
                <img src="{{asset('storage/'.$tip->src)}}" alt="">
                <span class="servicio">{{$tip->titulo}}</span>
                <div class="shadow" id="{{$tip->id}}"></div>
                <i class="material-icons delete-btn" id="{{$tip->id}}">delete</i>
                <a href="/admin/tips/modificar/{{$tip->id}}" class="edit-link">
                  <i class="material-icons edit-btn">edit</i>
                </a>
              </div>
            </div>
          </div>
          @endforeach
          @endif
        </div>
      </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $('.imagen-item>.img-container').height($('.imagen-item>.img-container').width())

  $(document).ready(function () {

    $('.imagen-item').css('opacity','1')

    $('#delete-item-btn').click(function () {
      $('form').submit()
    })

    $('.delete-btn').click(function () {
      $('form').children('input[name=id]').val($(this).attr('id'));
      showMsgDialog('Confirmar acción', ['¿Está seguro de que desea eliminar el elemento?'], '#eliminar-item-msg-dialog')
    })

    $('.imagen-item>.img-container>.shadow').click(function () {
      $('.dark-modal-back[id='+$(this).attr('id')+"]").fadeIn(200)
    })

    $('.dark-modal-back>i').click(function () {
      $(this).parent().fadeOut(200);
    })

    $(window).resize(function () {
      $('.imagen-item>.img-container').height($('.imagen-item>.img-container').width())
    })

    function showMsgDialog(title, body, id) {
      $(id).show(0);
      $(id+'>.msg-card').css('opacity',1);
      $(id+'>.msg-card').css('margin-top','100px');
      $(id+'>.msg-card').css('-webkit-transform','scale(1)');
      $(id+'>.msg-card>.header>h3').text(title);
      $(id+'>.msg-card>.body').children().remove();
      $.each(body, function (i, paragraph) {
        $(id+'>.msg-card>.body').append('<p>'+paragraph);
      });
    }

    $('.msg-footer>button').click(function () {
      $('.msg-card').css('-webkit-transform','scale(.7)');
      $('.msg-card').parent().fadeOut(400, function () {
        $(this).hide();
      });
    });

  })
</script>
@endsection
