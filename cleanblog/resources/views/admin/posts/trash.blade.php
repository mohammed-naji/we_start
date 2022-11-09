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

<table class="table table-bordered table-hover table-striped">
    <tr class="bg-dark text-white">
        <th>ID</th>
        <th>Title</th>
        <th>Deleted By</th>
        <th>Deleted At</th>
        <th>Actions</th>
    </tr>

    @forelse ($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->deleted_by }}</td>
            <td>{{ $post->deleted_at->format('F d, Y') }}</td>
            <td>
                    <a href="{{ route('admin.posts.restore', $post->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-undo"></i></a>
                    <a href="{{ route('admin.posts.forcedelete', $post->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>

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
