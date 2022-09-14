@extends('index')

@section('content')
    <a class="btn btn-secondary mb-3" href="/">
        ◄ Back
    </a>

    <div class="form-group">
        <h3>New Album</h3>
        <form action="/albums/store/" method="post">
            @csrf
            <input class="form-control mb-3" placeholder="Title" name="title" value="" required>
            <input class="form-control mb-3" placeholder="Cover Image Link" name="cover_img_link" value="" required>
            <input type="submit" class="btn btn-success" value="Save">
        </form>
    </div>
@endsection
