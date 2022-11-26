<x-admin-layout :title="'All Categories'">


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    @if (session('msg'))
                        <div class="alert alert-{{ session('type') }}">
                            {{ session('msg') }}
                        </div>
                    @endif

                    <div>
                        <h2>All categories</h2>
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-dark">
                                    <th>ID</th>
                                    <th>Original Name</th>
                                    <th>Name</th>
                                    <th>En Name</th>
                                    <th>Ar Name</th>
                                    <th>Image</th>
                                    <th>Parent</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->trans_name }}</td>
                                    <td>{{ $category->en_name }}</td>
                                    <td>{{ $category->ar_name }}</td>
                                    <td><img width="70" src="{{ asset($category->image->path) }}" alt=""></td>
                                    <td>{{ $category->parent_id }}</td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                        <form class="d-inline" action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('Are you sure?!')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">No Data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.content -->

</x-admin-layout>
