@if(count($productos) < 1)
<p style="padding:20px;text-align:center">No se encontraron coincidencias.</p>
@endif
@foreach($productos as $p)
<div class="col-xs-12 col-sm-4 col-md-3" style="padding:15px">
  <div class="p-item">
    <div class="img-container">
      <img src="{{asset('storage/'.$p->fotografia)}}" alt="" width="100%">
      <i class="material-icons info-toggle" id="{{$p->id}}">info_circle</i>
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
