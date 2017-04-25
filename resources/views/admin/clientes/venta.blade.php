@extends('layouts.master')

@section('title')
Nueva venta
@endsection

@section('css')
<style media="screen">
  body{
    background-color: #333;
  }
  .footer{
    box-shadow: none;
  }
  .card3{
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, .15);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    border-radius: 3px;
    overflow: hidden;
  }
  .card3>.header{
    box-shadow: 0 1px 3px rgba(0, 0, 0, .1);
    border-bottom: 1px solid rgba(0, 0, 0, .15);
  }
  .card3>.header>h4{
    color: #555;
    padding: 15px;
    text-align: center;
    margin: 0;
  }
  .card3>.body{
    float: left;
    width: 100%;
    position: relative;
  }
  .gray-container{
    background-color: rgba(0, 0, 0, .05);
    border-radius: 3px;
    color: #777;
    padding: 10px;
  }
  .gray-container>h4{
    border-bottom: 1px solid rgba(0, 0, 0, .1);
    padding-bottom: 11px;
  }
  p>span{
    margin-left: 5px;
  }
  .toggle-header{
    border: 1px solid rgba(0, 0, 0, .2);
    float: left;
    position: relative;
    width: 100%;
    padding: 5px;
    color: #ddd;
    padding-bottom: 3px;
    cursor: pointer;
  }
  .toggle-header>span{
    float: left;
  }
  .toggle-header>i{
    float: right;
  }
  .upper{
    border: 1px solid #000;
    background-color: #111;
    color: #eee;
    margin-top: 10px;
  }
  .sub-upper{
    border: 1px solid #111;
    background-color: #333;
    color: #eee;
  }
  .productos-container{
    border: 1px solid rgba(0, 0, 0, .2);
    border-top: none;
    width: 100%;
    float: left;
    position: relative;
  }
  .producto-item{
    padding:15px;
  }
  .producto-item>.item-card{
    background-color: rgba(0, 0, 0, 0.5);
    box-shadow: 0 0 3px rgba(0, 0, 0, .3);
  }
  .producto-item>.item-card>.img-container{
    width: 100%;
    position: relative;
  }
  .producto-item>.item-card>.img-container>img{
    width: 100%;
  }
  .producto-item>.item-card>.img-container>.precio{
    padding: 0px 3px 0 3px;
    border-radius: 10px;
    background-color: dodgerblue;
    position: absolute;
    top: 3px;
    left: 3px;
    color: #fff;
  }
  .producto-item>.item-card>.img-container>.add{
    position: absolute;
    top: 3px;
    right: 3px;
    color: dodgerblue;
    cursor: pointer;
  }
  .producto-item>.item-card>.img-container>.remove{
    position: absolute;
    top: 30px;
    right: 3px;
    color: dodgerblue;
    cursor: pointer;
  }
  .producto-item>.item-card>.img-container>.existencia{
    padding: 0px 3px 0 3px;
    border-radius: 10px;
    background-color: dodgerblue;
    position: absolute;
    bottom: 3px;
    width: 90%;
    left: 5%;
    margin: auto;
    text-align: center;
    color: #fff;
  }
  .producto-item>.item-card>.info{
    color: #fff;
    padding: 5px;
    text-align: center;
  }
  table{
    width: 100%;
    text-align: center;
  }
  th{
    padding-top: 10px;
    padding-bottom: 15px;
    border-bottom: 1px solid rgba(0, 0, 0, .1);
    text-align: center;
  }
  td{
    padding-top: 5px;
    padding-bottom: 5px;
  }
  label{
    font-weight: 400;
    color: #999;
  }
  .textbox3{
    border-radius: 3px;
    border: 1px solid rgba(0, 0, 0, 0.2);
    background-color: rgba(0, 0, 0, 0.05);
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
  .btn1{
    background: linear-gradient(to bottom, #eee, #ddd);
    border: 1px solid skyblue;
    color: #555;
    padding: 3px 15px 5px 15px;
    font-size: 16px;
    border-radius: 3px;
    -webkit-transition: box-shadow .3s;
  }
  .btn1:hover{
    box-shadow: 0 1px 3px #aaa;
  }
  .btn-center{
    display: block;
    margin: auto;
  }
  .white-link1{
    color: #ddd;
  }
  .white-link1:link{
    color: #eee;
    text-decoration: none;
    -webkit-transition: color .3s;
  }
  .white-link1:hover,.white-link1:visited,.white-link1:active{
    color: #fff;
  }
</style>
@endsection

@section('body')
<div class="main-container">
  <div class="col-xs-12">
    <h3 style="font-family:Lobster Two;color:#fff;float:left">Nueva venta</h3>
    <a href="/admin/clientes/info/{{$cliente->id}}" style="float:right" class="white-link1">Volver a información de {{$cliente->nombre}}</a>
  </div>
  <div class="col-xs-12 col-md-5">
    <div class="card">
      <div class="header">
        <h4>Selecciona los productos</h4>
      </div>
      <div class="body" style="padding:10px;padding-top:0">
        @foreach(\App\Marca::get() as $marca)
        <div class="toggle-header upper" for="{{$marca->id}}">
          <span>{{$marca->nombre}}</span>
          <i class="material-icons">keyboard_arrow_down</i>
        </div>
        <div class="toggles-container" of="{{$marca->id}}" style="display:none">
          @foreach($marca->categorias as $categoria)
          <div class="toggle-header sub-upper" for="{{$categoria->id}}">
            <span>{{$categoria->nombre}}</span>
            <i class="material-icons">keyboard_arrow_down</i>
          </div>
          <div class="toggles-container" of="{{$categoria->id}}" style="display:none">
            @foreach($categoria->subcategorias as $subcategoria)
            <div class="toggle-header" for="{{$subcategoria->id}}">
              <span>{{$subcategoria->nombre}}</span>
              <i class="material-icons">keyboard_arrow_down</i>
            </div>
            <div class="toggles-container productos-container" of="{{$subcategoria->id}}" style="display:none">
            @if($subcategoria->productos()->where('venta_publico', 1)->count() < 1)
            <p style="padding:5px;margin:0;color:#fff">No se encontraron productos.</p>
            @else
              @foreach($subcategoria->productos()->where('venta_publico', 1)->get() as $producto)
              <div class="col-xs-12 col-md-4 producto-item">
                <div class="item-card">
                  <div class="img-container" producto="{{json_encode($producto)}}" existencia="{{$producto->existencia()}}">
                    <img src="{{asset('storage/'.$producto->fotografia)}}" alt="">
                    <span class="precio">{{"$".$producto->precio_venta}}</span>
                    <i class="material-icons add" id="{{$producto->id}}">add_circle</i>
                    <i class="material-icons remove" id="{{$producto->id}}">remove_circle</i>
                    <span class="existencia">{{$producto->existencia()}} en existencia</span>
                  </div>
                  <div class="info">
                    <p style="margin-top:0px;margin-bottom:5px">{{$producto->nombre}}</p>
                    <p style="font-size:12px;margin-top:0px;margin-bottom:0px">{{$producto->codigo}}</p>
                  </div>
                </div>
              </div>
              @endforeach
            @endif
            </div>
            @endforeach
          </div>
          @endforeach
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-7">
    <div class="card3">
      <div class="header">
        <h4>Datos de venta</h4>
      </div>
      <div class="body">
        <form class="" action="/admin/ventas/agregar" method="post" id="add-venta">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="clienteId" value="{{$cliente->id}}">
          <div class="col-xs-12">
            <div class="gray-container" style="margin-top:15px; margin-bottom:15px">
              <h4>Información del cliente</h4>
              <p style="margin-top:5px">Nombre: <span>{{$cliente->nombre." ".$cliente->apellido}}</span></p>
              <p style="margin-top:5px">Teléfono: <span>{{$cliente->telefono}}</span></p>
              @if($cliente->credito)
              <p style="margin-top:5px">Crédito: <span style="color:#3cbf3d">Activado</span></p>
              @else
              <p style="margin-top:5px">Crédito: <span style="color:#f75">Desactivado</span></p>
              @endif
            </div>
          </div>
          <div class="col-xs-12" style="margin-bottom:15px">
            <h5 class="dark-text2">Productos</h5>
            <div class="gray-container" id="productos-container">
              <table style="display:none">
                <thead>
                  <th>Imagen</th>
                  <th>Nombre</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                </thead>
                <tbody>

                </tbody>
              </table>
              <p style="padding:15px;margin:0">Agregue o quite productos para la venta desde el panel izquierdo</p>
            </div>
          </div>
          <div class="col-xs-12" style="text-align:right">
            <p class="dark-text3">Monto a pagar: <span id="monto" style="font-weight:800">$0</span></p>
          </div>
          <div class="col-xs-12">
            <h5 style="color:#999">Pago</h5>
          </div>
          <div class="col-xs-12">
            <div class="" style="border-radius:4px;border: 1px solid rgba(0,0,0,.1);display:table;padding:5px;padding-top:15px;padding-bottom:15px;margin-bottom:15px">
              @if($cliente->credito)
              <div class="col-xs-12" style="padding:0">
                <label for="" class="col-xs-offset-2 col-md-offset-1">Abono inicial:</label>
              </div>
              <div class="col-xs-12" style="padding:0">
                <span class="col-xs-2 col-md-1" style="text-align:center;color:#888">$</span>
                <input type="text" name="abono" value="0" class="textbox3 col-xs-10 col-md-4 money" autocomplete="off">
              </div>
              @endif
              <div class="col-xs-12" style="padding:0;margin-top:10px">
                <label for="" class="col-xs-offset-2 col-md-offset-1">Recibido:</label>
              </div>
              <div class="col-xs-12" style="padding:0">
                <span class="col-xs-2 col-md-1" style="text-align:center;color:#888">$</span>
                <input type="text" name="recibido" value="0" class="textbox3 col-xs-10 col-md-4 money" autocomplete="off">
              </div>
              <div class="col-xs-12" style="padding:0;margin-top:10px">
                <p class="col-xs-offset-2 col-md-offset-1" style="color:#999" id="cambio-p">Cambio: <span id="cambio" style="font-weight:800">$0</span></p>
                <p style="color:#f75" class="col-xs-offset-2 col-md-offset-1" id="message-text"></p>
              </div>
            </div>
          </div>
          <div class="col-xs-12" style="margin-bottom:15px">
            <button type="button" name="add" class="btn1 btn-center">Aceptar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

$(document).ready(function () {

  $('button[name=add]').click(function () {
    @if($cliente->credito)
    if(productos.length < 1)
      showMsg('Ups!',['La venta debe contener al menos un producto'])
    else if(details.pago > details.monto)
      showMsg('Ups!',['El pago no puede sobrepasar el monto total a pagar de la venta.'])
    else if(details.recibido < details.pago)
      showMsg('Ups!',['El dinero recibido no es suficiente de acuerdo con el pago establecido'])
    else
    {
      $.each(productos, function (i, p) {
        $('form[id=add-venta]').append($('<input type="hidden" name="productos[]" value='+JSON.stringify({id:p.id,cantidad: p.cantidad})+'>'));
      });
      $('form[id=add-venta]').submit()
    }
    @else
    if(productos.length < 1)
      showMsg('Ups!',['La venta debe contener al menos un producto'])
    else if(details.recibido < details.monto)
      showMsg('Ups!',['El dinero recibido no es suficiente'])
    else
    {
      $.each(productos, function (i, p) {
        $('form[id=add-venta]').append($('<input type="hidden" name="productos[]" value='+JSON.stringify({id:p.id,cantidad: p.cantidad})+'>'));
      });
      $('form[id=add-venta]').submit()
    }
    @endif
  })

  $('.toggle-header').click(function () {
    if($(this).children('i').text() == 'keyboard_arrow_up') $(this).children('i').text('keyboard_arrow_down')
    else $(this).children('i').text('keyboard_arrow_up')

    $(this).parent().children('.toggles-container[of='+$(this).attr('for')+']').toggle()
    if($('.main-container').outerHeight(true) + $('body').children('.footer').outerHeight(true) <= $(window).height()){
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

  var productos = []
  $('.producto-item>.item-card>.img-container>.add').click(function () {
    if(productos.length == 0)
    {
      $('#productos-container').children('table').show()
      $('#productos-container').children('p').hide()
    }
    var producto = JSON.parse($(this).parent().attr('producto'))
    producto.existencia = $(this).parent().attr('existencia')
    var productosFound = $.grep(productos, function (p, i) {
      return p.id == producto.id
    })
    if(productosFound.length > 0)
    {
      if(productosFound[0].existencia < productosFound[0].cantidad + 1)
      {
        showMsg('Ups!', ['No hay sufucientes unidades en existencia'])
      }
      else
      {
        productosFound[0].cantidad = productosFound[0].cantidad + 1;
        $('#productos-container').children('table').children('tbody').children('tr#'+productosFound[0].id).children('.cantidad').text(productosFound[0].cantidad)
        $('#productos-container').children('table').children('tbody').children('tr#'+productosFound[0].id).children('.cantidad').css('font-size','18px')
        setTimeout(function () {
          $('#productos-container').children('table').children('tbody').children('tr#'+productosFound[0].id).children('.cantidad').css('font-size','16px')
        }, 200)
      }
    }
    else
    {
      if(producto.existencia < 1)
      {
        showMsg('Ups!', ['No hay sufucientes unidades en existencia'])
      }
      else
      {
        producto.cantidad = 1;
        productos.push(producto)
        $item = $('<tr id="'+producto.id+'">')
        $img = $('<img src="'+'/storage/'+producto.fotografia+'" width="50px">')
        var $td = $('<td>')
        $td.append($img)
        $item.append($td)
        $item.append($('<td>'+producto.nombre+'</td>'))
        $item.append($('<td>'+producto.precio_venta+'</td>'))
        $item.append($('<td class="cantidad">'+producto.cantidad+'</td>'))
        $('#productos-container').children('table').children('tbody').append($item)
      }
    }
    getSaleDetails()

  })

  $('.producto-item>.item-card>.img-container>.remove').click(function () {
    var id = $(this).attr('id')
    var productosFound = $.grep(productos, function (producto, i) {
      return producto.id == id
    })
    if(productosFound.length > 0)
    {
      if(productosFound[0].cantidad < 2)
      {
        $('#productos-container').children('table').children('tbody').children('tr#'+productosFound[0].id).remove()
        productos.splice(productos.indexOf(productosFound[0]), 1)
        if(productos.length < 1){
          $('#productos-container').children('table').hide()
          $('#productos-container').children('p').show()
        }
      }
      else {
        productosFound[0].cantidad =  productosFound[0].cantidad - 1;
        $('#productos-container').children('table').children('tbody').children('tr#'+productosFound[0].id).children('.cantidad').text(productosFound[0].cantidad)
        $('#productos-container').children('table').children('tbody').children('tr#'+productosFound[0].id).children('.cantidad').css('font-size','14px')
        setTimeout(function () {
          $('#productos-container').children('table').children('tbody').children('tr#'+productosFound[0].id).children('.cantidad').css('font-size','16px')
        }, 200)
      }
    }
    getSaleDetails()
  })

  $('input[name=recibido]').keyup(function () {
    getSaleDetails()
  })

  $('input[name=abono]').keyup(function () {
    getSaleDetails()
  })

  var details = null;
  function getSaleDetails(){
    details = {
      monto: 0,
      recibido: 0,
      pago: 0,
      cambio: 0
    }
    $.each(productos, function (i, p) {
      details.monto += p.precio_venta * p.cantidad;
    })
    details.monto = parseFloat(parseFloat(details.monto).toFixed(2))
    @if($cliente->credito)
      if($('input[name=abono]').val() == '') details.pago = 0
      else details.pago = parseFloat(parseFloat($('input[name=abono]').val()).toFixed(2))

      if($('input[name=recibido]').val() == '') details.recibido = 0
      else details.recibido = parseFloat(parseFloat($('input[name=recibido]').val()).toFixed(2))

      if(details.pago > details.monto)
      {
        $('#message-text').text('El pago no puede ser mayor que el monto a pagar')
        $('#message-text').show()
        $('#cambio-p').hide()
      }
      else if(details.recibido < details.pago)
      {
        $('#message-text').text('El dinero recibido debe ser igual o mayor a lo que se va pagar.')
        $('#message-text').show()
        $('#cambio-p').hide()
      }
      else {
        $('#message-text').hide()
        $('#cambio-p').show()
      }
      details.cambio = parseFloat(parseFloat(details.recibido - details.pago).toFixed(2))
    @else
      if($('input[name=recibido]').val() == '') details.recibido = 0
      else details.recibido = parseFloat(parseFloat($('input[name=recibido]').val()).toFixed(2))
      if(details.recibido < details.monto)
      {
        $('#message-text').text('El monto recibido no puede ser menor que el monto a pagar')
        $('#message-text').show()
        $('#cambio-p').hide()
      }
      else {
        $('#message-text').hide()
        $('#cambio-p').show()
      }
      details.cambio = parseFloat(parseFloat(details.recibido - details.monto).toFixed(2))
    @endif
    $('#cambio').text("$"+details.cambio)
    $('#monto').text("$"+details.monto)
  }

  $('input.money').keypress(function (e) {
    if((!$.isNumeric(e.key) && e.key != '.')
    || ($(this).val().indexOf('.') > -1 && e.key == '.')
    || ($(this).val().indexOf('.') > -1 && $(this).val().indexOf('.') + 2 == $(this).val().length -1))
      e.preventDefault();
    else if(e.key == '.' && $(this).val().length == 0)
      $(this).val('0')
    else if($(this).val().length > 1 && $(this).val().charAt($(this).val().length-1) == '.')
    {
      e.preventDefault();
      $(this).val($(this).val()+e.key+"0")
    }
    else if($(this).val().length > 2 && $(this).val().charAt($(this).val().length-2) == '.')
    {
      e.preventDefault();
      $(this).val($(this).val()+"0")
    }
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

  $('.msg-footer>button').click(function () {
    $('.msg-card').css('-webkit-transform','scale(.7)');
    $('.msg-card').parent().fadeOut(400, function () {
      $(this).hide();
    });
  });

  @if(session('msg'))
  showMsg("{{session('msg')['title']}}",["{{session('msg')['body']}}"]);
  @endif

})
</script>
@endsection
