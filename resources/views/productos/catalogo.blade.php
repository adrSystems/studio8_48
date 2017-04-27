@extends('layouts.master')

@section('title')
Catálogo de productos
@endsection

@section('css')
<style media="screen">
body{
  background-color: #fff;
}
  h3{
    font-family: 'Lobster Two';
    color: #ddd;
  }
  .textbox3{
    border-radius: 3px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    background-color: rgba(255, 255, 255, 0.05);
    padding-left: 5px;
    color: #555;
  }
  .textbox3-with-btn{
    padding-right: 25px;
    width: 100%;
  }
  .textbox3-btn{
    position: absolute;
    right: 5px;
    top: 3px;
  }
  input[name=search]{
    border-radius: 15px;
    padding-left: 10px;
    padding-right: 10px;
    outline: none;
    color: #ddd;
  }
  input[name=search]:focus{
    border-color: rgba(255, 255, 255, 0.3);
  }
  .results-container{
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 1px;
    border-radius: 2px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.8);
    width: 100%;
  }
  .results-container>.result-item{
    display: table;
    cursor: pointer;
    background-color: rgba(255, 255, 255, .05);
  }
  .results-container>.result-item:hover{
    background-color: rgba(255, 255, 255, .1);
  }
  .results-container>.results-count{
    padding: 5px;
  }
  .results-container>.result-item>.img-container{
    display: table-cell;
    width: 60px;
  }
  .results-container>.result-item>.img-container>img{
    width: 100%;
  }
  .results-container>.result-item>.info{
    display: table-cell;
    width: 100%;
    padding: 5px;
  }
  .results-container>.result-item>.info>p{
    color: #fff;
    margin-bottom: 5px;
  }
  .results-container>.result-item>.info>span{
    float: right;
    font-size: 13px;
  }
  .filter-marca-item{
    position: relative;
    padding: 0;
    padding-bottom: 10px;
  }
  .filter-marca-item>div>input{
    position: absolute;
    top: 5px;
    right: 0;
  }
  .filter-marca-item>div{
    width: 100%;
  }
  .filter-marca-item>div>.img-container{
    width: 60px;
    float: left;
  }
  .filter-marca-item>div>.info{
    float: left;
    padding-left: 10px;
  }
  .textbox3{
    color: #ddd;
  }
  option{
    color: dodgerblue;
  }
  .center{
    display: table;
    text-align: center;
    margin: auto;
    width: auto;
  }
  #quitar-filtros-btn{
    cursor:pointer;
  }
  #quitar-filtros-btn:hover{
    color:#fff;
  }
  .btn5{
    border: 1px solid rgba(255, 255, 255, 0.7);
    border-radius: 3px;
    cursor: pointer;
    color: #ddd;
    width: auto;
    display: table;
    margin: auto;
  }
  .btn5:hover{
    background-color: rgba(255, 255, 255, .09);
    color: #fff;
  }
  .p-item{
    border-radius: 3px;
    overflow: hidden;
    border: 1px solid rgba(0, 0, 0, .12);
  }
  .p-item>.img-container{
      position: relative;
      width: 100%;
  }
  .p-item>.info{
    background-color: rgba(0, 0, 0, 0.5);
    padding: 5px;
    padding-bottom: 10px;
  }
  .p-item>.img-container>span{
    position: absolute;
    background-color: dodgerblue;
    color: #eee;
    border-radius: 3px;
    padding: 3px;
  }
  .p-item>.img-container>.existencia{
    bottom: 3px;
    margin-left: 15%;
    width: 70%;
    text-align: center;
  }
  .p-item>.img-container>.costo{
    left: 3px;
    top: 3px;
  }
  .p-item>.img-container>.info-toggle{
      position: absolute;
      top:3px;
      right: 3px;
      cursor: pointer;
      color: dodgerblue;
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
    overflow: auto;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5),0 0 10px rgba(0, 0, 0, 0.7);
    -webkit-transform: scale(.7);
    -webkit-transition: -webkit-transform .4s;
  }
  .modal-back>.modal-black-card::-webkit-scrollbar{
    display: none;
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
  .detalles-producto-container>.img-container{
    display: block;
    width: auto;
    margin: auto;
    width: 100px;
  }
  .detalles-producto-container>div>p{
    margin-top: 15px;
    margin-bottom: 5px;
  }
  .detalles-producto-container>div>span{
    border-radius: 3px;
    background-color: rgba(0, 0, 0, .08);
    padding: 2px;
  }
  .card{
    background-color: #333;
  }
  .card4{
    background-color: rgba(0, 0, 0, 0.05);
    float: left;
    border-radius: 6px;
  }
  .main-container{
    background-color: #fff;
    z-index: 1;
    margin-top: 100px;
  }
  .main-cover-fixed-container{
    padding-top: 60px;
    background-color: #222;
  }
  .card2{
    background: #fff;
    border-radius: 3px;
    box-shadow: inset 0 0 3px rgba(0, 0, 0, .1);
    border: 1px solid rgba(0, 0, 0, .1);
    padding: 15px;
  }
</style>
@endsection

@section('body')
<div class="modal-back" id="detalles-producto-modal-back">
  <div class="modal-black-card col-xs-12 col-md-6 col-md-offset-3">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Información del producto</h4>
    </div>
    <div class="body">
        <div class="alert alert-info col-xs-12 col-md-8 col-md-offset-2 detalles-producto-container">
          <div class="col-xs-12">
            <h5 style="text-align:center">Sobre el producto</h5>
          </div>
          <div class="img-container">
            <img src="" alt="" id="producto-details-img" width="100%">
          </div>
          <div class="col-xs-12" style="padding:'0">
            <p>Código:</p><span id="codigo-producto-details"></span>
          </div>
          <div class="col-xs-12" style="padding:'0">
            <p>Nombre:</p><span id="producto-details"></span>
          </div>
          <div class="col-xs-12" style="padding:'0">
            <p>De la marca:</p><span id="marca-producto-details"></span>
          </div>
          <div class="col-xs-12" style="padding:'0">
            <p>Categoria:</p><span id="categoria-producto-details"></span>
          </div>
          <div class="col-xs-12" style="padding:'0">
            <p>Subcategoria:</p><span id="subcategoria-producto-details"></span>
          </div>
          <div class="col-xs-12" style="padding:'0">
            <p>Precio:</p><span id="precio-venta-producto-details"></span>
          </div>
          <div class="col-xs-12" style="padding:'0">
            <p>Contenido:</p><span id="contenido-producto-details"></span>
          </div>
          <div class="col-xs-12" style="padding:'0">
            <p>Descripción:</p><span id="descripcion-producto-details"></span>
          </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" name="button" id="close-btn"><i class="material-icons">block</i>Cerrar</button>
    </div>
  </div>
</div>

<div class="main-cover-fixed-container">
  <img class="main-cover-fixed" src="{{asset("img/covers/2.jpg")}}">
</div>

<div class="main-container">
  <div class="col-xs-12">
    <h3 class="dark-text1">Catálogo de productos</h3>
  </div>
  @if(\App\Marca::count() < 1)
  <div class="col-xs-12 col-md-6 col-md-offset-3" style="padding-top:50px;padding-bottom:50px">
    <div class="card2">
      <h3 class="dark-text1 title1" style="margin-top:0">Disculpe las molestias...</h3>
      <h4 class="dark-text3">Estamos trabajando en esta sección...</h4>
    </div>
  </div>
  @else
  <div class="col-xs-12 col-md-3">
    <div class="card" style="margin-bottom:15px">
      <div class="header">
        <h4>Explora</h4>
      </div>
      <div class="body">
        <!--
        <div class="col-xs-12">
          <input type="text" name="search" value="" placeholder="escribe el termino de busqueda..." class="textbox3 col-xs-12">
          <div class="col-xs-12" style="padding:2px 10px 0 10px;">
            <div class="results-container">
              <div class="result-item">
                <div class="img-container">
                  <img src="" alt="">
                </div>
                <div class="info">
                  <p>Avon</p>
                  <span>Categoria</span>
                </div>
              </div>
              <div class="results-count">
                <span><span id="results-count">0</span> resultados</span>
              </div>
            </div>
          </div>
        </div>
        -->
        <div class="col-xs-12">
          <h5>Filtrar</h5>
        </div>
        <div class="col-xs-12">
          <h5>Por marca</h5>
        </div>
        <div class="col-xs-12">
          @foreach (\App\Marca::get() as $marca)
            <div class="col-xs-12 filter-marca-item">
              <div class="marca-body">
                <div class="img-container">
                  <img src="{{asset('storage/'.$marca->logo)}}" alt="" width="100%">
                </div>
                <div class="info">
                  <span>{{$marca->nombre}}</span>
                </div>
                <input type="radio" name="marca" value="{{$marca->id}}" id="marca">
              </div>
            </div>
          @endforeach
        </div>
        <div class="col-xs-12">
          <h5>Por categoria</h5>
        </div>
        <div class="col-xs-12">
          <select class="textbox3" name="categoria">
            <option value="">Seleccione una opción...</option>
            @foreach($categorias as $cat)
            <option value="{{$cat->id}}">{{$cat->nombre}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-xs-12">
          <h5>Por subcategoria</h5>
        </div>
        <div class="col-xs-12">
          <select class="textbox3" name="subcategoria">
            <option value="">Seleccione una opción...</option>
            @foreach($subcategorias as $sub)
            <option value="{{$sub->id}}">{{$sub->nombre}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-xs-12">
          <hr>
          <div class="" style="width:100%">
            <div class="btn btn-warning center" id="filter-btn">Filtrar</div>
          </div>
        </div>
        <div class="col-xs-12" style="margin-top:5px">
          <span class="center" id="quitar-filtros-btn">Quitar filtros</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-9">
    @if(!\Auth::check())
    <div class="alert alert-warning">
      <strong>Atención...</strong>
      <p>Para realizar compras debes iniciar sesión...</p>
    </div>
    @endif
    <div class="card4">
      <div class="body" id="productos-container">
        @if(count($productos = \App\Producto::where('venta_publico','1')->get()) < 1)
        <p style="padding:20px;text-align:center;color:#777">No se encontraron coincidencias.</p>
        @endif
        @foreach($productos as $p)
        <div class="col-xs-12 col-sm-4 col-md-3" style="padding:15px">
          <div class="p-item">
            <div class="img-container">
              <img src="{{asset('storage/'.$p->fotografia)}}" alt="" width="100%">
              <i class="material-icons info-toggle" id="{{$p->id}}">info</i>
              <span class="existencia">{{$p->existencia()}} en existencia</span>
              <span class="costo">${{$p->precio_venta}}</span>
            </div>
            <div class="info">
              <p style="text-align:center;color:#fff;font-size:15px">{{$p->nombre}}</p>
              <p style="text-align:center;color:#eee;font-size:12px;margin-bottom:2px">{{$p->codigo}}</p>
              <p style="text-align:center;color:#eee;margin-bottom:2px;font-size:13px">{{$p->subcategoria->nombre}}</p>
              <p style="text-align:center;color:#eee;margin-bottom:2px;font-size:13px">{{$p->contenido." ".$p->u_medida}}</p>
              @if(\Auth::check() and \Auth::user()->cuentable_type == \App\Cliente::class)
              <div class="btn5 btn-xs add-to-cart" id="{{$p->id}}" style="margin-top:10px;margin-bottom:10px">Añadir al carrito</div>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @endif
</div>
@endsection

@section('js')
<script type="text/javascript">

  $('.main-container').css('margin-top', $('.main-cover-fixed-container').outerHeight(true))

  $(document).ready(function () {

    $('.main-container').css('margin-top', $('.main-cover-fixed-container').outerHeight(true))

    $(window).resize(function () {
      $('.main-container').css('margin-top', $('.main-cover-fixed-container').outerHeight(true))
      if($('.main-container').outerHeight(true) + $('body').children('.footer').outerHeight(true) <= $(window).height()){
        $('body').children('.footer').css({
          position:'absolute',
          bottom:'0'
        });
      }
      else{
        $('body').children('.footer').css({
          position:'relative'
        });
      }
    })

    $('#quitar-filtros-btn').click(function () {
      $('select[name=categoria]').children().attr('selected',false)
      $('select[name=categoria]').children('option[value=""]').attr('selected',true)
      $('select[name=subcategoria]').children().attr('selected',false)
      $('select[name=subcategoria]').children('option[value=""]').attr('selected',true)
      $('input[type=radio][name=marca]').prop('checked',false)
      filter()
    })

    function delegateEventShowProductInfo() {
      $('.info-toggle').click(function () {
        var productoId = $(this).attr('id')
        $.ajax({
          url:"/admin/inventario/productos/get-by-id",
          type:"post",
          dataType:"json",
          data:{
            _token:"{{csrf_token()}}",
            id: productoId
          }
        }).done(function(producto){
          //info basica
          $('#producto-details-img').attr('src', producto.fotografia)
          $('#producto-details').text(producto.nombre)
          $('#marca-producto-details').text(producto.subcategoria.categoria.marca.nombre)
          $('#categoria-producto-details').text(producto.subcategoria.categoria.nombre)
          $('#subcategoria-producto-details').text(producto.subcategoria.nombre)
          $('#codigo-producto-details').text(producto.codigo)
          $('#descripcion-producto-details').text(producto.descripcion)
          $('#precio-venta-producto-details').text("$"+producto.precio_venta)
          $('#contenido-producto-details').text(producto.contenido+" "+producto.u_medida)
          showModal('#detalles-producto-modal-back')
        })
      })
    }

    delegateEventShowProductInfo()

    function deletgateEventAddToCart() {
      $('.add-to-cart').click(function () {
        var id = $(this).attr('id')
        $.ajax({
          url:"/productos/add-to-cart",
          type:"post",
          dataType:"json",
          data:{
            _token:"{{csrf_token()}}",
            id: id
          }
        }).done(function(response){
          if(!response.result){
            showMsg(response.msg.title, [response.msg.body])
          }
          else {
            if($('.cart-items').length < 1){
              $.ajax({
                url:"/productos/update-cart-html-items",
                type:"post",
                dataType:"html",
                data:{
                  _token:"{{csrf_token()}}"
                }
              }).done(function(html){
                $('.cart-items').remove()
                $('.cart-toggle').remove()
                $('body').append(html)
                $('.cart-toggle').click(function () {
                  if($('.cart-items').css('right') == '0px')
                    $('.cart-items').css('right','-400px')
                  else $('.cart-items').css('right','0px')
                })
                $('.remove-p').click(function () {
                  var $this = $(this)
                  $.ajax({
                    url:"/productos/remove-from-cart",
                    type:"post",
                    dataType:"json",
                    data:{
                      _token:"{{csrf_token()}}",
                      id: $this.attr('id')
                    }
                  }).done(function (response){
                    if(response.totalCount < 1)
                    {
                      $('.cart-toggle').hide()
                      $('.cart-items').hide()
                      $('.cart-items').children('.item').remove()
                    }
                    else {
                      if(response.count < 1)
                        $this.parent().parent().parent().parent().remove()
                      else $this.parent().parent().children('.cant').text('('+response.count+')')
                      $('#monto-cart').text('$'+response.monto)
                    }
                  })
                })
                $('.descartar-cart').click(function () {
                  $.ajax({
                    url:"/productos/descartar-cart",
                    type:"post",
                    data:{
                      _token:"{{csrf_token()}}"
                    }
                  }).done(function(){
                    $('.cart-toggle').remove()
                    $('.cart-items').remove()
                  })
                })
                $('#btn-cart-comprar').click(function () {
                  $('#monto-cart-confirm').text($('#monto-cart').text())
                  showModal('#confirmar-compra-modal-back')
                })
                setTimeout(function () {
                  $('.cart-items').css('right','0px')
                }, 50)
              })
            }
            else {
              $.ajax({
                url:"/productos/update-cart-products-items",
                type:"post",
                dataType:"html",
                data:{
                  _token:"{{csrf_token()}}"
                }
              }).done(function(html){
                $('.cart-items').show()
                $('.cart-toggle').show()
                $('.cart-items').children('.items-body').children('.item').remove()
                $('.cart-toggle').children('span').text(response.cart.productos.length)
                $('#monto-cart').text('$'+response.cart.monto)
                $('.items-body').append(html)
                $('.cart-toggle').click(function () {
                  if($('.cart-items').css('right') == '0px')
                    $('.cart-items').css('right','-400px')
                  else $('.cart-items').css('right','0px')
                })
                $('.remove-p').click(function () {
                  var $this = $(this)
                  $.ajax({
                    url:"/productos/remove-from-cart",
                    type:"post",
                    dataType:"json",
                    data:{
                      _token:"{{csrf_token()}}",
                      id: $this.attr('id')
                    }
                  }).done(function (response){
                    if(response.totalCount < 1)
                    {
                      $('.cart-toggle').hide()
                      $('.cart-items').hide()
                      $('.cart-items').children('.item').remove()
                    }
                    else {
                      if(response.count < 1)
                        $this.parent().parent().parent().parent().remove()
                      else $this.parent().parent().children('.cant').text('('+response.count+')')
                      $('#monto-cart').text('$'+response.monto)
                    }
                  })
                })
              })
            }
          }
        })
      })
    }

    deletgateEventAddToCart()

    $('#filter-btn').click(function () {
      filter()
    })

    function filter() {
      var marcaId = null;
      $.each($('input[name=marca]'), function (i, e) {
        if($(e).prop('checked') == true)
          marcaId = $(e).val()
      })
      $.ajax({
        url:"/productos/catalogo/filtrar",
        type:"post",
        dataType:"html",
        data:{
          _token:"{{csrf_token()}}",
          marca: marcaId,
          cat: $('select[name=categoria]').val(),
          subcat: $('select[name=subcategoria]').val()
        }
      }).done(function(html){
        $('#productos-container').children().remove()
        $('#productos-container').append(html)
        delegateEventShowProductInfo()
        deletgateEventAddToCart()
      })
    }

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

    $('.msg-footer>button').click(function () {
      $('.msg-card').css('-webkit-transform','scale(.7)');
      $('.msg-card').parent().fadeOut(400, function () {
        $(this).hide();
      });
    });

    @if(session('msg'))
    showMsg("{{session('msg')['title']}}",["{{session('msg')['body']}}"]);
    @endif

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

  })
</script>
@endsection
