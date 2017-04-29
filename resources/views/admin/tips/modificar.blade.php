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
  .card2{
    background-color: #fff;
    border-radius: 3px;
    float: left;
    width: 100%;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .2);
  }
  textarea{
    resize: none;
    height: 100px;
  }
  .last-cover-container{
    overflow: hidden;
    border-radius: 6px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .2);
  }
  .last-cover-container>img{
    width: 100%;
  }
  .restore-btn{
    margin-top: 15px;
    cursor: pointer;
  }
  .restore-btn:hover{
    color: dodgerblue;
  }
</style>
@endsection

@section('body')
<div class="dark-modal-back">
    <i class="material-icons">close</i>
    <div class="img-container col-xs-12 col-md-6 col-md-offset-3">
    </div>
</div>

<form class="" action="/admin/portafolio/borrar-imagen" method="post">
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
        <h3 class="clear-text1">Modificar Tip</h3>
        <h4 class="clear-text3">Cambia la información a del tip en cuestión.</h4>
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
              <div class="menu-item1">Volver a gestión</div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-9">
        <div class="card2">
          <input type="hidden" name="title" value="{{$tip->titulo}}">
          <input type="hidden" name="contenido" value="{{$tip->contenido}}">
          <form class="" action="/admin/tips/modificar" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id" value="{{$tip->id}}">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
              <p class="dark-text1 title2 text-center">Información del tip</p>
            </div>
            <div class="col-xs-12 col-md-6 col-md-offset-3">
              <p class="dark-text2 subtitle3 pull-left">Título</p>
              <i class="material-icons pull-right restore-btn" id="title">restore</i>
            </div>
            <div class="col-xs-12 col-md-6 col-md-offset-3">
              <input type="text" name="title" value="{{$tip->titulo}}" class="textbox4" style="width:100%">
            </div>
            <div class="col-xs-12 col-md-6 col-md-offset-3">
              <p class="dark-text2 subtitle3">Cover actual</p>
            </div>
            <div class="col-xs-12 col-md-6 col-md-offset-3">
              <div class="last-cover-container">
                <img src="{{asset($tip->src)}}" alt="" class="last-cover">
              </div>
            </div>
            <div class="col-xs-12 col-md-6 col-md-offset-3">
              <p class="dark-text2 subtitle3">Seleccionar nuevo cover</p>
            </div>
            <div class="col-xs-12 col-md-6 col-md-offset-3">
              <div class="img-file-selector">
                <p>Haz click o arrastra un archivo...</p>
                <input type="file" name="imagen" value="" accept="image/jpeg,.png,.gif">
              </div>
            </div>
            <div class="col-xs-12 col-md-6 col-md-offset-3">
              <p class="dark-text2 subtitle3 pull-left">Contenido/Comentarios</p>
              <i class="material-icons pull-right restore-btn" id="contenido">restore</i>
            </div>
            <div class="col-xs-12 col-md-6 col-md-offset-3">
              <textarea name="contenido" class="textbox4" style="width:100%">@if($tip->contenido){{$tip->contenido}}@endif</textarea>
            </div>
            <div class="col-xs-12">
            @if($msg = Session::get('msg'))
			      <div class="col-xs-12">
 							 <div class="alert alert-{{$msg['type']}} col-xs-12 col-md-6 col-md-offset-3" role="alert">
   			         <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
   			         <span style="font-weight:600">{{$msg['title']}}</span>
   			         <span>{{$msg['body']}}</span>
   			       </div>
			      </div>
			      @endif
            </div>
            <div class="col-xs-12" style="margin-top:15px;margin-bottom:30px">
              <button type="submit" name="button" class="mybtn1 center">Guardar cambios</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $('.imagen-item>.img-container').height($('.imagen-item>.img-container').width())

  $('.last-cover-container').height($('.last-cover-container').width())

  $(document).ready(function () {

    $(window).resize(function () {
      $('.last-cover-container').height($('.last-cover-container').width())
    })

    $('.restore-btn[id=title]').click(function () {
      $('input[type=text][name=title]').val($('input[type=hidden][name=title]').val())
    })

    $('.restore-btn[id=contenido]').click(function () {
      $('textarea[name=contenido]').val($('input[type=hidden][name=contenido]').val())
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
