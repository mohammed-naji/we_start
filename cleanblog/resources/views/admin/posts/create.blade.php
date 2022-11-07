@extends('admin.master')

@section('title', 'All Posts | ' . env('APP_NAME'))

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Add new Post</h1>

@dump($errors)
@dump($errors->any())
@dump($errors->all())

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    {{-- <input type="text" name="_token" value="{{ csrf_token() }}">
    {{ csrf_field() }} --}}
    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" placeholder="Title" class="form-control @error('title') is-invalid @enderror">
        @error('title')
            <small class="invalid-feedback">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
    </div>

    <div class="mb-3">
        <label>Content</label>
        <textarea name="content" placeholder="Cotnent" class="form-control" rows="5"></textarea>
        {{-- <input type="text" name="title" placeholder="Title" > --}}
    </div>

    <button class="btn btn-success px-5"><i class="fas fa-plus"></i> Add</button>
</form>

@stop


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.2.0/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: ['code']
    });
  </script>
@stop
