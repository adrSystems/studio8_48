@if(\App\Categoria::count() < 1)
<p style="margin-top:10px;padding:0 10px 0 10px" id="no-cat-advice">No se encontraron categorias, añada una nueva para continuar.</p>
@else
@foreach(\App\Categoria::get() as $cat)
<div class="col-xs-12 col-lg-6" style="padding:5px">
  <div class="item" style="border-color: rgba(0,0,0,.2)">
    <div class="header for-edit-marca-header" id="{{$cat->id}}" style="background: linear-gradient(to bottom,rgba(0,0,0,.1),rgba(0,0,0,.2))">
      <h5 style="color: #555;">{{$cat->nombre}}</h5>
      <div class="select-btn unselected" style="background-color:rgba(0,0,0,.1)">
        <i class="material-icons">check</i>
      </div>
    </div>
    <div class="body">
      @foreach($cat->subcategorias as $sub)
      <div class="item" style="color:#888">{{$sub->nombre}}</div>
      @endforeach
    </div>
  </div>
</div>
@endforeach
@endif
