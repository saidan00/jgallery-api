@extends('index')

@section('content')
    <a class="btn btn-secondary mb-3" href="/albums/{{ $picture['album_id'] }}">
        ◄ Back
    </a>

    <div class="form-group">
        <h3>Album {{ $album['title'] }} - Picture {{ $picture['order_number'] }}</h3>
        <div class="row">
            <div class="col-4">
                <img src="{{ $picture['img_link'] }}" class="rounded w-100 rounded cover-img h-100" style="object-fit:cover" />
            </div>
            <div class="col-8">
                <form action="/pictures/update/{{ $picture['album_id'] }}/{{ $picture['id'] }}" method="post">
                    @csrf
                    <input class="form-control mb-3" placeholder="Image link" name="img_link" value="{{ $picture['img_link'] }}" required>
                    <input type="submit" class="btn btn-success float-right" value="Save">
                </form>
            </div>
        </div>
    </div>
@endsection
