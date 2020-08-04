@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-md-6">
    <h1>Albums</h1>
  </div>
  <div class="col-md-6"><a href="/albums/create" class="btn btn-primary pull-right mb-3">
      <i class="fa fa-pencil"></i> Add
    </a></div>
</div>

@foreach ($albums as $album)
<div class="card card-body mb-3">
  <div class="row">
    <div class="col-sm-4 col-lg-2">
      <img src="{{$album->coverImgLink}}" class="w-100 rounded cover-img">
    </div>
    <div class="col-sm-8 col-lg-10">
      <div class="card-title align-middle">
        <h2><a href="/albums/{{$album->id}}">{{$album->title}}</a></h2>
        <small>{{$album->pictures_count}} pictures</small>
      </div>
    </div>
  </div>
</div>
@endforeach

{{$albums->links()}}

<script>
  function resizeCoverImg() {
    let coverImgs = document.getElementsByClassName("cover-img");
    let coverImgsLength = coverImgs.length;

    for (let i = 0; i < coverImgsLength; i++) {
      coverImgs[i].style.height = coverImgs[i].offsetWidth + "px";
    }
  }
  
  resizeCoverImg();

  window.addEventListener("resize", resizeCoverImg);
</script>

@endsection