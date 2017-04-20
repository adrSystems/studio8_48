@if($cart = session('cart'))
<div class="cart-toggle">
  <i class="material-icons">shopping_cart</i>
  <span>{{count($cart['productos'])}}</span>
</div>
<div class="cart-items">
  <div class="col-xs-12 header">
    <span class="btn-xs btn pull-right btn-danger descartar-cart">Descartar todo</span>
  </div>
  <div class="items-body">
    @foreach($cart['productos'] as $i => $p)
    <div class="item" style="@if($i%2 == 0){{'background-color:#fff'}}@endif">
      <div class="img-container">
        <img src="{{$p['foto']}}" alt="" width="100%">
      </div>
      <div class="info">
        <p style="">
          {{$p['nombre']}}<br><span class="cant">({{$p['cantidad']}})</span>
          <span>
            <i class="material-icons remove-p" id="{{$p['id']}}">remove_circle</i>
          </span>
        </p>
      </div>
    </div>
    @endforeach
  </div>
  <div class="col-xs-12 footer-cart">
    <div class="col-xs-12">
      <p id="monto-cart">${{$cart['monto']}}</p>
    </div>
    <div class="center" id="btn-cart-comprar">Comprar</div>
  </div>
</div>
@endif
