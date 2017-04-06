@if(\App\Subcategoria::find($id)->productos()->count() == 0)
<p style="padding:20px;padding-bottom:10px;color:#ddd">No se encontraron productos registrados en el sistema.</p>
@else
@foreach(\App\Subcategoria::find($id)->productos()->get() as $producto)
<div class="col-xs-12 col-sm-6 col-md-4" style="padding:15px">
  <div class="producto-item">
    <div class="img-container">
      <img src="{{asset('storage/'.$producto->fotografia)}}" alt="">
      <div class="shadow"></div>
      <i class="material-icons editar-producto-toggle" id="{{$producto->id}}">edit</i>
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
@endif
