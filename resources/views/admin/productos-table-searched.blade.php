@if(count($productos) == 0)
<div class="col-xs-12" style="padding:0">
  <p style="padding:20px;padding-bottom:10px;color:#777">No se encontraron productos activos registrados en el sistema.</p>
</div>
@else
<div class="col-xs-12" style="padding:0">
  @foreach($productos as $producto)
  <div class="col-xs-12 col-sm-6 col-md-4" style="padding:15px">
    <div class="producto-item">
      <div class="img-container">
        <img src="{{asset($producto->fotografia)}}" alt="">
        <div class="shadow"></div>
        <i class="material-icons item-btn descontinuar-producto-toggle" id="{{$producto->id}}">delete</i>
        <i class="material-icons item-btn editar-producto-toggle" id="{{$producto->id}}">edit</i>
        <i class="material-icons item-btn surtir-producto-toggle" id="{{$producto->id}}">add_circle</i>
      </div>
      <div class="info">
        <div class="col-xs-12">
          <span>{{$producto->nombre}}</span>
        </div>
        <div class="col-xs-12">
          <button type="button" class="btn4 detalles-producto-toggle" id="{{$producto->id}}">Detalles</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endif
@if(count($productosDescontinuados) > 0)
<div class="col-xs-12">
  <hr>
  <h5 style="color:#777">Descontinuados</h5>
</div>
<div class="col-xs-12" style="padding:0">
  @foreach($productosDescontinuados as $producto)
  <div class="col-xs-12 col-sm-6 col-md-4" style="padding:15px">
    <div class="producto-item">
      <div class="img-container">
        <img src="{{asset($producto->fotografia)}}" alt="">
        <div class="shadow"></div>
        <i class="material-icons item-btn restore-producto-toggle" id="{{$producto->id}}">restore</i>
      </div>
      <div class="info">
        <div class="col-xs-12">
          <span>{{$producto->nombre}}</span>
        </div>
        <div class="col-xs-12">
          <button type="button" class="btn4 detalles-producto-toggle" id="{{$producto->id}}">Detalles</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endif
