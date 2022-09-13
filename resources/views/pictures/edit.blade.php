@extends('index')

@section('content')
    <a class="btn btn-secondary mb-3" href="/albums/{{ $picture->album_id }}">
        ◄ Back
    </a>

    <div class="form-group">
        <h3>Album {{ $picture->album_id }} - Picture {{ $picture->id }}</h3>
        <form action="/pictures/update/{{ $picture->id }}" method="post">
            @csrf
            <input class="form-control mb-3" placeholder="Image link" name="img_link" value="{{ $picture->img_link }}" required>
            <input type="submit" class="btn btn-success" value="Save">
        </form>
    </div>

    <img src="{{ $picture->img_link }}" class="rounded w-100 rounded cover-img h-100" style="object-fit:cover" />
@endsection
