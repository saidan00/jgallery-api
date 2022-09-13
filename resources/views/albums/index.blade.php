@extends('index')

@section('content')
    <div>
        <div class="row">
            <div class="col-md-4">
                <h1>Albums</h1>
            </div>
            <div class="col-md-8">
                <button class="btn btn-primary float-right mb-3 ml-3">
                    Add
                </button>
                <a href="/api/albums" target="_blank" class="btn btn-primary float-right mb-3">To JSON</a>
            </div>
        </div>

        @foreach ($albums as $album)
            <div class="card card-body mb-3" style="height:165px">
                <div class="row h-100">
                    <div class="col-sm-4 col-lg-2 h-100">
                        <img src="{{ $album['cover_img_link'] }}" class="w-100 rounded cover-img h-100" style="object-fit:cover" />
                    </div>
                    <div class="col-sm-8 col-lg-10 h-100">
                        <div class="card-title align-middle">
                            <h2>
                                <a href="/albums/{{ $album['id'] }}">{{ $album['title'] }}</a>
                            </h2>
                            <small>{{ $album['pictures_count'] }} pictures</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
