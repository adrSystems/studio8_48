@extends('layouts.master')
@section('title')
Videos
@endsection
@section('css')
@endsection
@section('body')
<br><br><br>
<div class="container">
  <div class="row">
    @foreach(App\Imagen::where('link','!=','null')->get() as $link)
    <div class="col-md-4">
       {!! Embed::make($link->link)->parseUrl()->setAttribute(['width' => 380,'height'=>270])->getIframe(); !!}
    </div>
    @endforeach
  </div>
</div>
@endsection
