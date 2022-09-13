@extends('index')

@section('content')
    <a class="btn btn-secondary mb-3" href="/albums/{{ $album['id'] }}">
        ◄ Back
    </a>

    <div class="form-group">
        <h3>Album {{ $album['id'] }}</h3>
        <form action="/albums/update/{{ $album['id'] }}" method="post">
            @csrf
            <input class="form-control mb-3" placeholder="Title" name="title" value="{{ $album['title'] }}" required>
            <input class="form-control mb-3" placeholder="Cover Image Link" name="cover_img_link" value="{{ $album['cover_img_link'] }}" required>
            <input type="submit" class="btn btn-success" value="Save">
        </form>
    </div>

    <img src="{{ $album['cover_img_link'] }}" class="rounded w-100 rounded cover-img h-100" style="object-fit:cover" />
@endsection
