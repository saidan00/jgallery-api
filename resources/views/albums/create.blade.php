@extends('layouts.app')

@section('content')

<a class="btn btn-primary mb-3" href="/albums" role="button"><i class="fa fa-backward"></i> Go back</a>

<div class="card card-body mt-3">
  <h1>Create Album</h1>
  <p>Please fill out this form</p>
  <form action="/albums" method="POST">
    @csrf
    <div class="form-group">
      <label for="title">Title <span class="text-danger font-weight-bold">*</span></label>
      <input type="text" class="form-control" name="title" placeholder="Album title" required>
    </div>

    <div class="form-group">
      <label for="cover-img-link">Cover image link <span class="text-danger font-weight-bold">*</span></label>
      <input type="text" class="form-control" name="cover-img-link" placeholder="Cover image link" required>
    </div>

    <div class="form-group">
      <label for="title">Description <span class="text-danger font-weight-bold">*</span></label>
      <textarea class="form-control" name="description" placeholder="Description" required></textarea>
    </div>
    <input type="submit" value="Submit" class="btn btn-success">
  </form>
</div>

@endsection