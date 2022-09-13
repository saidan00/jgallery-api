@extends('index')

@section('content')
    <div>
        <a class="btn btn-secondary mb-3" href="/">
            <font-awesome-icon icon="backward" />◄ Back
        </a>

        <button class="btn btn-danger mb-3 float-right">
            <font-awesome-icon icon="trash" />Delete Album
        </button>

        <div class="card">
            <table class="card-header">
                <tr>
                    <td class="align-middle content p-3" style="height: 165px">
                        <img class="mr-3 rounded w-100 rounded cover-img h-100" style="object-fit:cover" src="{{ $album['cover_img_link'] }}" />
                    </td>
                    <td class="align-middle content p-3">
                        <h2 id="album-title" data-field="title">
                            {{ $album['title'] }}
                            <a type="submit" class="btn btn-primary" href="/albums/edit/{{ $album['id'] }}">Edit</a>
                        </h2>

                        <small>{{ $album['pictures_count'] }} pictures</small>
                    </td>
                </tr>
            </table>

            <div class="card-header">
                <form action="/pictures/create-many" method="POST">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="album_id" value="{{ $album['id'] }}">
                        <div class="col-11">
                            <textarea name="img_links" cols="110" rows="10" required></textarea>
                        </div>
                        <div class="col-1">
                            <input type="submit" class="btn btn-success w-100 font-weight-bold" title="Add" value="Add" />
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Image Link</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    </tbody>
                    {{--  --}}
                    @foreach ($album['pictures'] as $index => $picture)
                        <tr>
                            <th scope="row" class="align-middle text-center" style="width:7%" id="{{ $picture['order_number'] }}">
                                @if (!$loop['first'])
                                    <form action="/pictures/update-order/{{ $picture['id'] }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="new_index" value="{{ $picture['order_number'] - 1 }}">
                                        <input type="submit" value="▲" class="mb-1 btn btn-light"><br>
                                    </form>
                                @endif

                                <input type="text" maxlength="4" size="3" value={{ $picture['order_number'] }} class="form-control mb-1">

                                @if (!$loop['last'])
                                    <form action="/pictures/update-order/{{ $picture['id'] }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="new_index" value="{{ $picture['order_number'] + 1 }}">
                                        <input type="submit" value="▼" class="btn btn-light">
                                    </form>
                                @endif
                            </th>

                            <td class="align-middle content" style="height:165px">
                                <img src="{{ $picture['img_link'] }}" class="rounded w-100 rounded cover-img h-100" style="object-fit:cover" />
                            </td>

                            <td class="align-middle content">{{ $picture['img_link'] }}</td>

                            <td class="align-middle content" style="width:5%">
                                <form action="/pictures/edit/{{ $picture['id'] }}" method="get">
                                    @csrf
                                    <input type="submit" value="Edit" class="btn btn-primary w-100 mb-1">
                                </form>
                                <a class="btn btn-danger w-100 mb-1" rel="stylesheet" href="/pictures/delete/{{ $picture['id'] }}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    {{--  --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
