@extends('layouts.master')

@section('title')
Inventario
@endsection

@section('css')
<style>
  body{
    background-image: url('{{asset("img/walls/5.jpg")}}');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    color: #aaa;
  }
  .footer{
    background-color: rgba(0, 0, 0, 0.5);
    box-shadow: none;
  }
  .main-title{
    color: #eee;
  }
  .side-menu{
    width: 100%;
    display: table;
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-radius: 2px;
    text-align: center;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.4);
    margin-bottom: 10px;
  }
  .side-menu>.header{
    background-color: rgba(255, 255, 255, 0.1);
    color: #fff;
    padding-top: 10px;
    padding-bottom: 10px;
  }
  .side-menu>.body>.item{
    width: 100%;
    float: left;
    padding: 3px;
    color: #ddd;
    cursor: pointer;
    border-bottom: 1px solid rgba(255, 255, 255, .11);
    -webkit-transition: background-color .4s, color .4s, text-shadow .6s;
  }
  .side-menu>.body>.item-active{
    border-left: 2px solid #fff;
    color: #fff;
    text-shadow: 0 0 3px rgba(255, 255, 255, 0.5);
  }
  .side-menu>.body>.item:hover{
    background-color: rgba(255, 255, 255, .05);
  }
  .side-menu>.body>.last-item{
    border-bottom: none;
  }
  .main-card{
    width: 100%;
    position: relative;
    float: left;
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-radius: 2px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
  }
  .main-card>.header{
    background-color: rgba(255, 255, 255, 0.2);
    color: #fff;
    text-shadow: 0 0 15px rgba(0, 0, 0, 0.9), 0 0 1px rgba(0, 0, 0, 0.9);
    padding: 10px;
  }
  .list-container{
    border-radius: 3px;
    background-color: rgba(0, 0, 0, 0.5);
    margin-bottom: 5px;
    border: 1px solid rgba(0, 0, 0, 0.3);
  }
  .list-container>p{
    color:#fff;
    margin-top: 5px;
  }
  .list-container>.list-item{

  }
  .sub-card{
    border-radius: 3px;
    padding: 15px;
    background-color: rgba(0, 0, 0, 0.5);
    float: left;
    position: relative;
    width: 100%;
  }
  label{
    font-weight: 400;
    color: #fff;
  }
  h5,h4,h3{
    color: #fff;
  }
  .textbox2{
    background-color: rgba(255, 255, 255, .8);
    border-radius: 3px;
    width: 100%;
    padding: 5px 10px 5px 10px;
    border: 1px solid transparent;
    color: #444;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
  }
  .btn1{
    background-color: transparent;
    border: 1px solid #fff;
    border-radius: 3px;
    color: #ddd;
    font-size: 18px;
    padding: 4px 18px 7px 18px;
    -webkit-transition: background-color .4s, color .4s, text-shadow .6s;
  }
  .btn-center{
    display: block;
    margin: auto;
  }
  .btn1:hover{
    background-color: rgba(0, 0, 0, .2);
  }
  .img-file-selector{
    padding-top: 10px;
    position: relative;
    border: 1px dashed #bbb;
    border-radius: 2px;
    overflow: hidden;
    text-align: center;
    text-overflow: ellipsis;
  }
  .img-file-selector>p{
    width: 100%;
    white-space: nowrap;
    text-overflow: ellipsis;
    display: block;
    overflow: hidden;
  }
  .img-file-selector>input[type=file]{
    background-color: red;
    position: absolute;
    top: -80%;
    left: 0;
    width: 100%;
    height: 180%;
    cursor: pointer;
    opacity: 0;
  }
  .list-item>.img-container{
    position: relative;
    background-color: #fff;
    overflow: hidden;
    padding: 0;
  }
  .list-item>.img-container:hover .shadow{
    opacity: 1;
    box-shadow: inset 0 0 50px rgba(0, 0, 0, 0.5);
  }
  .list-item>.img-container>.shadow{
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
    background-color: rgba(255, 0, 0, .2);
    -webkit-transition: background-color .4s, box-shadow .8s, opacity .4s;
  }
  .list-item>.img-container>img{
    width: 100%;
  }
  .list-item>.img-container>.info{
    position: absolute;
    z-index: 1;
    top: 0;
    padding: 3px;
    padding-left: 10px;
    padding-right: 10px;
    max-width: 100%;
    color: #fff;
    text-align: center;
    background-color: rgba(255, 0, 0, 0.5);
  }
  .list-item>.img-container>.options{
    position: absolute;
    bottom: -40px;
    width: 50%;
    left: 25%;
    text-align: center;
    background-color: rgba(255, 0, 0, 0.5);
    -webkit-transition: bottom .4s;
  }
  .list-item>.img-container>.options>i{
    position: relative;
    margin: auto;
    margin-top: 4px;
    font-size: 20px;
    cursor: pointer;
    display: inline-block;
    float: none;
    color: rgba(255, 255, 255, 0.7);
    opacity: .2;
    -webkit-transition: margin .5s, opacity .7s;
  }
  .list-item>.img-container>.options>i:hover{
    color: #fff;
  }
  .list-item>.img-container>.options>i.edit{
    margin-right: 10px;
  }
  .list-item>.img-container>.options>i.delete{
    margin-left: 10px;
  }
  .modal-back{
    background-color: rgba(0, 0, 0, 0.4);
    width: 100%;
    height: 100%;
    position: fixed;
    display: none;
    z-index: 2;
    padding:  65px 15px 65px 15px;

  }
  .modal-back>.modal-black-card{
    position: relative;
    background-color: #fff;
    border: 1px solid #555;
    border-radius: 3px;
    padding: 0;
    display: none;
    max-height: 100%;
    overflow: hidden;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5),0 0 10px rgba(0, 0, 0, 0.7);
    -webkit-transform: scale(.7);
    -webkit-transition: -webkit-transform .4s;
  }
  .modal-black-card>.header,.modal-black-card>.modal-footer{
    background-color: rgba(0, 0, 0, .05);
    margin: 0;
    padding: 10px;
  }
  .modal-black-card>.header>.close-btn{
    float: right;
    cursor: pointer;
    font-size: 18px;
    color:#444;
    border-radius: 3px;
  }
  .modal-black-card>.header>.close-btn:hover{
    color: #fff;
    background-color: rgba(0, 0, 0, .2);
  }
  .modal-black-card>.modal-footer{
    width: 100%;
  }
  .modal-black-card>.modal-footer>button{
    border: 1px solid rgba(0, 0, 0, 0.1);
    color: #eee;
    background-color: rgba(255, 0, 0, 0.5);
    text-shadow: 0 0 1px rgba(0, 0, 0, .8);
    border-radius: 3px;
    -webkit-transition: background-color .4s, border .5s;
    padding: 3px 12px 3px 8px;
    box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.3);
  }
  .modal-black-card>.modal-footer>button>i{
    font-size: 14px;
    float: left;
    margin-top: 3.5px;
    margin-right: 3px;
  }
  .modal-black-card>.modal-footer>button:hover{
    background-color: rgba(255, 0, 0, 0.60);
    border: 1px solid rgba(0, 0, 0, 0.3);
  }
  .modal-black-card>.header>h4{
    margin: 0;
    color: goldenrod;
    font-family: 'Lobster Two';
  }
  .modal-black-card>.header{
    border-bottom: 1px solid rgba(0, 0, 0, 0.07);
  }
  .modal-black-card>.body{
    position: relative;
    padding: 10px;
    overflow: auto;
    color: #777;
  }
  .modal-black-card>.body::-webkit-scrollbar{
    width:  15px;
    border-radius: 12px;
  }
  .modal-black-card>.body::-webkit-scrollbar-thumb{
    background: #222;
    border: 4px solid #111;
    border-radius: 12px;
  }
  label.dark{
    color: #999;
  }
  .subcontainer{
    border: 1px solid rgba(255, 255, 255, .1);
  }
  .square-btn{
    background-color: rgba(255, 255, 255, 0.05);
    border: 1px solid #fff;
    width: 25px;
    cursor: pointer;
    height: 25px;
  }
  .square-btn:hover{
    background-color: rgba(255, 255, 255, 0.1);
  }
  .square-btn>i{
    font-size: 23px;
    color: #eee;
  }
  .circle-btn{
    border-radius: 100%;
    height: 20px;
    width: 20px;
    cursor: pointer;
    border: 1.5px solid skyblue;
    -webkit-transition: background-color .4s;
  }
  .circle-btn:hover i{
    color: #fff;
  }
  .circle-btn>i{
    color: skyblue;
    font-size: 18px;
  }
  #add-subcategoria-toggle{
    background-color: transparent;
    float: right;
  }
  #add-subcategoria-toggle:hover{
    background-color: dodgerblue;
  }
</style>
@endsection

@section('body')
<form class=""  action="/admin/inventario/marcas/delete" method="post" id="delete-marca">
  <input type="hidden" name="marcaId" value="">
  <input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
<form class=""  action="/admin/inventario/marcas/restore" method="post" id="restore-marca">
  <input type="hidden" name="marcaToRestore" value="">
  <input type="hidden" name="_token" value="{{csrf_token()}}">
</form>

<div class="modal-back" id="agregar-categoria-modal-back">
  <div class="modal-black-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Nueva categoria</h4>
    </div>
    <div class="body">
      <div class="col-xs-12">
        <label for="" class="dark">Ingrese el nombre</label>
      </div>
      <div class="col-xs-12">
        <input type="text" name="categoriaNombre" value="" class="textbox2" style="width:100%">
      </div>
      <div class="col-xs-12" style="margin-top:10px">
        <label for="" class="dark">Seleccione o agregue subcategorias</label>
        <div class="circle-btn" id="add-subcategoria-toggle">
          <i class="material-icons">add</i>
        </div>
      </div>
      <div class="col-xs-12">
        <div class="subcontainer">
          @if(\App\Subcategoria::count() < 1)
          <div class="alert alert-danger">
            <p>No se encontraron subcategorias en el sistema. Añada subcategorias para continuar.</p>
          </div>
          @else
          @foreach(\App\Subcategoria::get() as $subcategoria)
          <div class="item">
            {{$subcategoria->nombre}}
          </div>
          @endforeach
          @endif
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" name="button" id="agregar-categoria-btn"><i class="material-icons">check</i>Aceptar</button>
      <button type="button" name="button" id="close-btn"><i class="material-icons">block</i>Cerrar</button>
    </div>
  </div>
</div>

<div class="modal-back" id="editar-marca-modal-back">
  <div class="modal-black-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Editar marca</h4>
    </div>
    <div class="body">
      <form class="" action="/admin/inventario/marcas/editar" method="post" enctype="multipart/form-data" id="form-editar-marca">
        <input type="hidden" name="marcaToEdit" value="">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="col-xs-12">
          <div class="col-xs-12 alert alert-warning">
            <p>Complete solamente lo que quiere cambiar</p>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="alert alert-info">
            <p>Marca a modificar: <span id="marca-a-modificar"></span></p>
          </div>
        </div>
        <div class="col-xs-12">
          <label for="" class="dark">Ingrese el nuevo nombre</label>
        </div>
        <div class="col-xs-12">
          <input type="text" name="newMarcaName" value="" class="textbox2" style="width:100%">
        </div>
        <div class="col-xs-12" style="margin-top:10px">
          <label for="" class="dark">Seleccione el nuevo logo</label>
        </div>
        <div class="col-xs-12">
          <div class="img-file-selector col-xs-12">
            <p>Haz click o arrastra un archivo...</p>
            <input type="file" name="nuevoLogo" value="" accept="image/jpeg,.png,.gif">
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" name="button" id="editar-marca"><i class="material-icons">check</i>Aceptar</button>
      <button type="button" name="button" id="close-btn"><i class="material-icons">block</i>Cerrar</button>
    </div>
  </div>
</div>

<div class="msg-container" id="msg-dialog">
  <div class="msg-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <h3></h3>
    </div>
    <div class="body">
    </div>
    <div class="msg-footer">
      <button type="button" name="button" id="delete-marca-btn">Eliminar</button>
      <button type="button" name="button" id="close-btn">Cerrar</button>
    </div>
  </div>
</div>

<div class="main-container">
<div class="col-xs-12">
  <h3 class="main-title">Inventario</h3>
</div>

<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
  <div class="side-menu">
    <div class="header">Menú</div>
    <div class="body">
      <div class="item item-active" for="marcas-card">Marcas</div>
      <div class="item" for="categorias-card">Categorias</div>
      <div class="item" for="subcategorias-card">Subcategorias</div>
      <div class="item" for="productos-card">Productos</div>
    </div>
  </div>
</div>

<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">

  <div class="main-card" for="marcas-card">
    <div class="header">
      <h4>Gestión de marcas</h4>
    </div>
    <div class="body">
      <div class="col-xs-12 col-md-4" style="padding:15px">
        <div class="list-container col-xs-12" style="padding:0">
          @if(\App\Marca::count() == 0)
          <p style="padding:0 10px 0 10px">No se encontraron marcas registradas en el sistema.</p>
          @else
          <h5 style="text-align:center">Activas</h5>
          @foreach(\App\Marca::get() as $marca)
          <div class="list-item col-xs-12 col-sm-12 col-md-12 col-lg-6" style="padding:15px">
            <div class="img-container col-xs-12">
              <div class="shadow"></div>
              <div class="options">
                <i class="edit material-icons edit-marca" id="{{$marca->id}}" marca="{{$marca->nombre}}">edit</i>
                <i class="delete material-icons delete-marca" id="{{$marca->id}}">delete</i>
              </div>
              <img src="{{asset('storage/'.$marca->logo)}}" alt="">
              <div class="info">
                <span class="">{{$marca->nombre}}</span>
              </div>
            </div>
          </div>
          @endforeach
          @endif
        </div>

        <div class="list-container col-xs-12" style="padding:0">
          @if(\App\Marca::onlyTrashed()->count() == 0)
          <p style="padding:0 10px 0 10px">No se encontraron marcas descontinuadas en el sistema.</p>
          @else
          <h5 style="text-align:center">Descontinuadas</h5>
          @foreach(\App\Marca::onlyTrashed()->get() as $marca)
          <div class="list-item col-xs-12 col-sm-6" style="padding:15px">
            <div class="img-container col-xs-12">
              <div class="shadow"></div>
              <div class="options">
                <i class="restore material-icons restore-marca" id="{{$marca->id}}">restore</i>
              </div>
              <img src="{{asset('storage/'.$marca->logo)}}" alt="">
              <div class="info">
                <span class="">{{$marca->nombre}}</span>
              </div>
            </div>
          </div>
          @endforeach
          @endif
        </div>
      </div>
      <div class="col-xs-12 col-md-8" style="padding: 15px;">
        <div class="sub-card">
          <h4 style="text-align:center">Agregar nueva marca</h4>
          <form class="" action="/admin/inventario/marcas/agregar" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="col-xs-12">
              <div class="col-xs-12 col-md-8 col-md-offset-2" style="padding:0">
                <label for="">Nombre</label>
              </div>
              <div class="col-xs-12 col-md-8 col-md-offset-2" style="padding:0">
                <input type="text" name="nombreMarca" value="{{old('nombreMarca')}}" class="textbox2">
              </div>
            </div>
            <div class="col-xs-12" style="margin-top:15px;">
              <div class="col-xs-12 col-md-8 col-md-offset-2" style="padding:0">
                <label for="">Logo</label>
              </div>
              <div class="img-file-selector col-xs-12 col-md-8 col-md-offset-2">
                <p>Haz click o arrastra un archivo...</p>
                <input type="file" name="logo" value="" accept="image/jpeg,.png,.gif">
              </div>
              <div class="col-xs-12 col-md-8 col-md-offset-2">
                <hr>
              </div>
              <div class=" col-xs-12 col-md-8 col-md-offset-2" style="padding:0;margin-top:15px;">
                <label for="" class="pull-left">Categorias que maneja</label>
                <div class="square-btn pull-right" style="margin-bottom:5px" id="add-categoria-btn">
                  <i class="material-icons">add</i>
                </div>
              </div>
              <div class=" col-xs-12 col-md-8 col-md-offset-2 subcontainer" style="padding:0">
              @if(\App\Categoria::count() < 1)
              <p style="margin-top:10px;padding:0 10px 0 10px">No se encontraron categorias, añada una nueva para continuar.</p>
              @else
              @endif
              </div>
              <div class="col-xs-12 col-md-8 col-md-offset-2">
                <hr>
              </div>
            </div>
            <div class="col-xs-12" style="margin-top:35px;margin-bottom:15px;">
              <button type="submit" id="agregar-marca-btn" class="btn1 btn-center">Agregar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="main-card" for="categorias-card" style="display:none">
    <div class="header">
      <h4>Gestión de categorias</h4>
    </div>
    <div class="body">
      <div class="col-xs-12 col-md-4" style="padding:15px">
        <div class="list-container">
          @if(\App\Categoria::count() == 0)
          <p style="padding:0 10px 0 10px">No se encontraron categorias registradas en el sistema.</p>
          @else
          @foreach(\App\Categoria::get() as $categoria)
          <div class="list-item">
            <div class="info">
              <span>{{$categoria->nombre}}</span>
            </div>
          </div>
          @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="main-card" for="subcategorias-card" style="display:none">
    <div class="header">
      <h4>Gestión de subcategorias</h4>
    </div>
    <div class="body">
      <div class="col-xs-12 col-md-4" style="padding:15px">
        <div class="list-container col-xs-12">
          @if(\App\Subcategoria::count() == 0)
          <p style="padding:0 10px 0 10px">No se encontraron subcategorias registradas en el sistema.</p>
          @else
          @foreach(\App\Subcategoria::get() as $subcategoria)
          <div class="list-item">
            <div class="info">
              <span>{{$subcategoria->nombre}}</span>
            </div>
          </div>
          @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="main-card" for="productos-card" style="display:none">
    <div class="header">
      <h4>Gestión de productos</h4>
    </div>
    <div class="body">
      <div class="col-xs-12 col-md-4" style="padding:15px">
        <div class="list-container">
          @if(\App\Producto::count() == 0)
          <p style="padding:0 10px 0 10px">No se encontraron productos registrados en el sistema.</p>
          @else
          @foreach(\App\Producto::get() as $producto)
          <div class="list-item">
            <div class="info">
              <span>{{$producto->nombre}}</span>
            </div>
          </div>
          @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>

</div>
</div>
@endsection

@section('js')
<script type="text/javascript">

if($('.main-container').height() + $('.footer').outerHeight() + 150 <= $(window).height()){
  $('.footer').css({
    position:'absolute',
    bottom:'0'
  });
}
else{
  $('.footer').css({
    position:'relative'
  });
}

$(window).resize(function () {
    if($('.main-container').height() + $('.footer').outerHeight() + 150 <= $(window).height()){
      $('.footer').css({
        position:'absolute',
        bottom:'0'
      });
    }
    else{
      $('.footer').css({
        position:'relative'
      });
    }
})

$(document).ready(function () {

  $('div#add-categoria-btn').click(function () {
    showModal('#agregar-categoria-modal-back')
  })

  $('#editar-marca').click(function () {
    if($('input[name=nuevoLogo]').val() == '' && $('input[name=newMarcaName]').val() == '')
    {
      showMsg('Ups!', ['Debes proporcionar por lo menos un parametro'])
    }
    else
    {
      $('form[id=form-editar-marca]').submit()
    }
  })

  $('#delete-marca-btn').click(function () {
    $('form[id=delete-marca]').submit()
  })

  $('.edit-marca').click(function () {
    $('input[name=marcaToEdit]').val($(this).attr('id'))
    $('span#marca-a-modificar').text($(this).attr('marca'))
    showModal('#editar-marca-modal-back')
  })

  $('.restore-marca').click(function () {
    $('input[type=hidden][name=marcaToRestore]').val($(this).attr('id'))
    $('form[id=restore-marca]').submit()
  })

  $('.delete-marca').click(function () {
    showMsgDialog('Confirmar Acción', [
      '¿Desea descontinuar la marca?',
      'Todos los productos de la marca no podrán ser vendidos ni administrados en inventario hasta que los restaure.'
    ])
    $('input[type=hidden][name=marcaId]').val($(this).attr('id'))
  })

  $('.list-item>.img-container>.shadow').hover(
    function () {
      var $options = $(this).parent().children('.options')
      $options.css('bottom','0')
      $options.children('i').css('opacity','1')
      $options.children('i.edit').css('margin-right','0px')
      $options.children('i.delete').css('margin-left','0px')
    },
    function () {
      if($('.list-item>.img-container>.options:hover').length < 1){
        var $options = $(this).parent().children('.options')
        $options.css('bottom','-40px')
        $options.children('i').css('opacity','.2')
        $options.children('i.edit').css('margin-right','10px')
        $options.children('i.delete').css('margin-left','10px')
      }
    }
  )

  $('.list-item>.img-container>.options').mouseleave(function () {
    if($('.list-item>.img-container>.shadow:hover').length < 1){
      var $options = $(this)
      $options.css('bottom','-40px')
      $options.children('i').css('opacity','.2')
      $options.children('i.edit').css('margin-right','10px')
      $options.children('i.delete').css('margin-left','10px')
    }
  })

  $('.side-menu>.body>.item').click(function () {
    var $toggle = $(this)
    $('.side-menu>.body>.item').removeClass('item-active')
    $(this).addClass('item-active')
    $.each($('div.main-card'), function (i,e) {
      if($(e).attr('for') == $toggle.attr('for'))
      {
        $(e).delay(300).fadeIn(200,function () {
          if($('.main-container').height() + $('.footer').outerHeight() + 150 <= $(window).height()){
            $('.footer').css({
              position:'absolute',
              bottom:'0'
            });
          }
          else{
            $('.footer').css({
              position:'relative'
            });
          }
        })
      }
      else $(e).fadeOut(200)
    })
  })

  $('.img-file-selector').children('input[type=file]').change(function () {
    if($(this)[0].files.length > 0){
      $(this).parent().children('p').text($(this)[0].files[0].name);
    }
    else{
      $(this).parent().children('p').text('Haz click o arrastra un archivo...');
    }
  });

  function showModal(id) {
    $modal = $(id)
    $modal.fadeIn();
    $children = $modal.children('.modal-black-card');
    $children.fadeIn(400);
    $children.css('-webkit-transform','scale(1)');
  }

  function closeModal(modalId){
    $parent = $(modalId).children('.modal-black-card')
    $parent.css('-webkit-transform','scale(.7)');
    $parent.fadeOut(400, function () {
      $parent.parent().fadeOut();
    });
  }

  $('.modal-black-card').find('#close-btn').click(function () {
    $parent = $(this).parent().parent();
    $parent.css('-webkit-transform','scale(.7)');
    $parent.fadeOut(400, function () {
      $parent.parent().fadeOut();
    });
  });

  $('.close-btn').click(function () {
    var $parent = $(this).parent().parent();
    $parent.css('-webkit-transform','scale(.7)');
    $parent.fadeOut(200, function () {
      $parent.parent().fadeOut();
    });
  })

  function showMsg(title, body) {
    $('#general-msg').show(0);
    $('#general-msg>.msg-card').css('opacity',1);
    $('#general-msg>.msg-card').css('margin-top','100px');
    $('#general-msg>.msg-card').css('-webkit-transform','scale(1)');
    $('#general-msg>.msg-card>.header>h3').text(title);
    $('#general-msg>.msg-card>.body').children().remove();
    $.each(body, function (i, paragraph) {
      $('#general-msg>.msg-card>.body').append('<p>'+paragraph);
    });
  }

  function showMsgDialog(title, body) {
    $('#msg-dialog').show(0);
    $('#msg-dialog>.msg-card').css('opacity',1);
    $('#msg-dialog>.msg-card').css('margin-top','100px');
    $('#msg-dialog>.msg-card').css('-webkit-transform','scale(1)');
    $('#msg-dialog>.msg-card>.header>h3').text(title);
    $('#msg-dialog>.msg-card>.body').children().remove();
    $.each(body, function (i, paragraph) {
      $('#msg-dialog>.msg-card>.body').append('<p>'+paragraph);
    });
  }

  $('.msg-footer>button').click(function () {
    $('.msg-card').css('-webkit-transform','scale(.7)');
    $('.msg-card').parent().fadeOut(400, function () {
      $(this).hide();
    });
  });

  @if(session('options'))
  showMsg("{{session('options')['msg']['title']}}",["{{session('options')['msg']['body']}}"]);
  @endif

  @if(session('options') and isset(session('options')['activeItem']))
    $('.side-menu>.body>.item').removeClass('item-active')
    $('.side-menu>.body').children('.item[for='+'{{session("options")["activeItem"]}}'+']').addClass('item-active')
    $('div.main-card').hide();
    $('div.main-card[for='+'{{session("options")["activeItem"]}}'+']').show();
  @endif

})
</script>
@endsection
