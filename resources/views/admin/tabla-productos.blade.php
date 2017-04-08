@if(\App\Subcategoria::find($id)->productos()->count() == 0)
<div class="col-xs-12" style="padding:0">
  <p style="padding:20px;padding-bottom:10px;color:#ddd">No se encontraron productos activos registrados en el sistema.</p>
</div>
@else
<div class="col-xs-12" style="padding:0">
  @foreach(\App\Subcategoria::find($id)->productos as $producto)
  <div class="col-xs-12 col-sm-6 col-md-4" style="padding:15px">
    <div class="producto-item">
      <div class="img-container">
        <img src="{{asset('storage/'.$producto->fotografia)}}" alt="">
        <div class="shadow"></div>
        <i class="material-icons item-btn descontinuar-producto-toggle" id="{{$producto->id}}">delete</i>
        <i class="material-icons item-btn editar-producto-toggle" id="{{$producto->id}}">edit</i>
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
@if(\App\Subcategoria::find($id)->productos()->onlyTrashed()->count() > 0)
<div class="col-xs-12">
  <hr>
  <h5 style="color:#fff">Descontinuados</h5>
</div>
<div class="col-xs-12" style="padding:0">
  @foreach(\App\Subcategoria::find($id)->productos()->onlyTrashed()->get() as $producto)
  <div class="col-xs-12 col-sm-6 col-md-4" style="padding:15px">
    <div class="producto-item">
      <div class="img-container">
        <img src="{{asset('storage/'.$producto->fotografia)}}" alt="">
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
