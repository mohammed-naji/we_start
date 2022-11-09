@extends('admin.master')

@section('title', 'Edit Post | ' . env('APP_NAME'))

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Post</h1>

{{-- @dump($errors)
@dump($errors->any())
@dump($errors->all()) --}}

@include('admin.errors')

<form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')

    {{-- <input type="text" name="_token" value="{{ csrf_token() }}">
    {{ csrf_field() }} --}}
    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" placeholder="Title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $post->title) }}">
        @error('title')
            <small class="invalid-feedback">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
        @error('image')
            <small class="invalid-feedback">{{ $message }}</small>
        @enderror
        <img width="100" src="{{ asset('uploads/'.$post->image) }}" alt="">
    </div>

    <div class="mb-3">
        <label>Content</label>
        <textarea name="content" placeholder="Cotnent" class="form-control @error('content') is-invalid @enderror" rows="5">{{ old('content', $post->content) }}</textarea>
        @error('content')
            <small class="invalid-feedback">{{ $message }}</small>
        @enderror
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
