@extends('layouts.master')
@section('title')
Portafolio
@endsection
@section('css')
<style media="screen">
ul.fotos {
   width: 970px;
   margin: 0 0 18px -30px;
}
ul.fotos li {
   display: block;
}
ul.fotos a {
   display: inline;
   float: left;
   margin: 0 0 27px 30px;
   width: auto;
   padding: 10px 10px 15px;
   text-align: center;
   color: #333;
   font-size: 18px;
  -webkit-box-shadow: 0 3px 6px rgba(0,0,0,.25);
-webkit-transform: rotate(-2deg);
-webkit-transition: -webkit-transform .15s linear;
}
ul.fotos li:nth-child(3n) a {
   -webkit-transform: none;
   position: relative;
   top: -5px;

}
ul.fotos li:nth-child(5n) a {
   -webkit-transform: rotate(5deg);
   position: relative;
   right: 5px;

}

ul.fotos li a:hover {
   -webkit-transform: scale(1.25);
   -webkit-box-shadow: 0 3px 6px rgba(0,0,0,.5);
   position: relative;
   z-index: 5;
}
ul.fotos img {
   display: block;
   width: 190px;
   height: 200px;
   margin-bottom: 12px;
}

.modal-content{
  width: 460px;
  background-color: rgba(0, 0, 0, 0.5);
}
#mod_img{
  width: 440px;
  height: 500px;
}
</style>
@endsection
@section('body')
<br><br><br>
<div class="container">
  <div class="row">
    @foreach(App\Portafolio::where('imagen','!=','null')->get() as $imagen)
    <ul class="fotos">
      <div class="col-xs-12 col-md-3">
        <li><a href="#" data-toggle="modal" data-target="#id_modal{{$imagen->id}}"><img src="storage/{{$imagen->imagen}}" alt="" border="0"></a></li>
        <li></li>
      </div>
      <div class="modal fade" id="id_modal{{$imagen->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                
              </button>
            <div class="modal-body">
              <img id="mod_img" src="storage/{{$imagen->imagen}}" alt="">
            </div>
          </div>
        </div>
      </div>
    </ul>
    @endforeach
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">

</script>
@endsection
