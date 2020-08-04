@extends('layouts.app')

@section('content')

<a class="btn btn-primary mb-3" href="/albums" role="button"><i class="fa fa-backward"></i> Go back</a>

<div class="card">
  <div class="card-header">
    <h2 id="album-title" class="d-inline-block" data-field="title">{{$album->title}}</h2>
    <i id="btn-edit-album-title" class="fa fa-pencil-square-o fa-lg hv-primary" aria-hidden="true"></i>

    <br>

    <h6 id="album-img" class="d-inline-block" data-field="coverImgLink">Cover image link: </h6>
    <i id="btn-edit-album-img" class="fa fa-pencil-square-o fa-lg hv-primary" aria-hidden="true"></i>

    <br>

    <small>{{$album->pictures_count}} pictures</small>
  </div>

  <div class="card-body">
    <table class="table" id="album-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          {{-- <th scope="col">Description</th> --}}
          <th scope="col">Image Link</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row" class="align-middle"></th>
          <td class="align-middle new-content" id="txt-title"></td>
          {{-- <td contenteditable="false" data-field="description">{{$picture->description}}</td> --}}
          <td class="align-middle new-content" id="txt-img-link"></td>
          <th>
            <input type="button" value="Add" class="btn btn-success w-100" id="btn-add">
          </th>
        </tr>

        @foreach ($album->pictures as $indexKey => $picture) {{-- indexKey start with 0 --}}
        <tr data-id="{{$picture->id}}">
          <th scope="row" class="align-middle">{{++$indexKey}}</th>
          <td class="align-middle content" data-field="title">{{$picture->title}}</td>
          {{-- <td contenteditable="false" data-field="description">{{$picture->description}}</td> --}}
          <td class="align-middle content" data-field="imgLink">{{$picture->imgLink}}</td>
          <th>
            <input type="button" value="Delete" class="btn btn-danger w-100 delete">
          </th>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
{{ csrf_field() }}

<script>
  $(document).ready( function() {

    // init DataTable
    $('#album-table').DataTable({
    "columnDefs": [{
    "orderable": false,
    "targets": -1
    }]
    });

    function updateAlbum(id, field, content) {
      $.ajax({
        url:"{{ route('albums.update_data') }}",
        method:"POST",
        data:{
        id: id,
        field: field,
        content: content,
        _token: _token
        },
        success:function(data) {
          let album = JSON.parse(data);
          console.log(field + ': ' + album[field]);
          
          if (field == "title") {
            albumTitle.text(album.title);
          }
        }
      });
    }

    let _token = $('input[name="_token"]').val();
    let albumTitle = $('#album-title');
    let albumCoverImg = $('#album-img');

    // double click event, add new content
    $('.new-content').on("dblclick", function() {
      $(this).attr("contenteditable","true");
      $(this).addClass("border border-primary bg-white");
    });

    // blur event
    $('.new-content').on("blur", function() {
      $(this).attr("contenteditable","false");
      $(this).removeClass("border border-primary bg-white");
    });

    // click event, store new content
    $('#btn-add').on('click', function() {
      let title = $('#txt-title').text();
      let imgLink = $('#txt-img-link').text();

      if (title && imgLink) {
        $.ajax({
          url:"{{ route('pictures.add_data') }}",
          method:"POST",
          data: {
          title: title,
          imgLink: imgLink,
          album_id: {{$album->id}},
          _token: _token
          },
          success: function(data) {
          console.log(data);
          location.reload();
          },
          error: function(jqxhr, status, exception) {
          console.log('Exception:', jqxhr.responseJSON.message);
          }
        });
      } else {
        alert("title & image link can't be empty");
      }
    });

    // double click event, edit content
    $('#album-table').on("dblclick", ".content", function() {
      $(this).attr("contenteditable","true");
      $(this).addClass("border border-primary bg-white");
    });

    // blur event, update content
    $('#album-table').on('blur', '.content', function() {
      $(this).attr("contenteditable","false");
      $(this).removeClass("border border-primary bg-white");

      // call ajax
      let id = $(this).parent().data("id");
      let field = $(this).data("field");
      let content = $(this).text();

      $.ajax({
        url:"{{ route('pictures.update_data') }}",
        method:"POST",
        data:{
          id: id,
          field: field,
          content: content,
          _token: _token
        },
        success:function(data) {
          let picture = JSON.parse(data);
          console.log(field + ': ' + picture[field]);
        }
      });
    });

    $('#album-table').on("click", ".delete", function() {
      if (confirm("Delete picture?")) {
        let id = $(this).parent().parent().data("id");
        console.log(id);

        $.ajax({
          url: "{{ route('pictures.delete_data') }}",
          method: "POST",
          data:{
            id:id,
            _token:_token
          },
          success: function(data) {
            location.reload();
          },
          error: function(jqxhr, status, exception) {
           console.log('Exception:', jqxhr.responseJSON.message);
          }
        });
      }
    });

    $('#btn-edit-album-title').on('click', function() {
      let content = prompt("Album Title", albumTitle.text());
      let field = albumTitle.data("field");
      let id = {{ $album->id }};

      if (content != null) {
        updateAlbum(id, field, content);
      }
    });

    $('#btn-edit-album-img').on('click', function() {
      let content = prompt("Album Cover Image Link", "");
      let field = albumCoverImg.data("field");
      let id = {{ $album->id }};
      
      if (content != null) {
        updateAlbum(id, field, content);
      }
    });
  });
</script>

@endsection