@if($cart = session('cart'))
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
@endif
