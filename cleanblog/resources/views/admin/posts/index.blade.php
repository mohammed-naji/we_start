@extends('admin.master')

@section('title', 'All Posts | ' . env('APP_NAME'))

@section('styles')
{{-- <script src="https://cdn.tailwindcss.com"></script> --}}

<style>
    .table th,
    .table td {
        vertical-align: middle
    }
</style>

@stop

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">All Posts</h1>

<p>This is test add to github</p>

<form id="search-form" method="GET" action="{{ route('admin.posts.index') }}">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search here.." name="search" value="{{ request()->search }}">
        <select name="count" onchange="document.getElementById('search-form').submit()">
            <option {{ request()->count == 10 ? 'selected' : '' }} value="10">10</option>
            <option {{ request()->count == 15 ? 'selected' : '' }} value="15">15</option>
            <option {{ request()->count == 20 ? 'selected' : '' }} value="20">20</option>
            <option @selected(request()->count == $posts->total()) value="{{ $posts->total() }}">All</option>
        </select>
        <div class="input-group-append">
          <button class="btn btn-dark px-4" id="button-addon2">Button</button>
        </div>
      </div>
</form>

<table class="table table-bordered table-hover table-striped">
    <tr class="bg-dark text-white">
        <th>ID</th>
        <th>Title</th>
        <th>Image</th>
        <th>Author</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Actions</th>
    </tr>

    @forelse ($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td><img width="100" src="{{ asset('uploads/'.$post->image) }}" alt=""></td>
            <td>{{ $post->user_id }}</td>
            <td>{{ $post->created_at->format('F d, Y') }}</td>
            <td>{{ $post->updated_at->diffForHumans() }}</td>
            <td>
                {{-- <div class="btn-group"> --}}
                    <a href="#" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                    {{-- <a href="{{ route('admin.posts.destroy', $post->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> --}}
                    <form class="d-inline" action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
                        @csrf
                        @method('delete')

                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                {{-- </div> --}}
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7">No Data Found</td>
        </tr>
    @endforelse




</table>

{{-- {{ $posts->appends(['search' => request()->search, 'count' => request()->count])->links() }} --}}
{{ $posts->appends($_GET)->links() }}
@stop
