<x-admin-layout :title="'All Roles'">

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
                        <h2>All roles</h2>
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-dark">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($roles as $role)
                                    <tr id="row_{{ $role->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->trans_name }}</td>
                                        <td>{{ $role->created_at->format('F m, Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.roles.edit', $role) }}"
                                                class="btn btn-primary btn-sm btn-edit"><i class="fas fa-edit"></i></a>
                                            <form class="d-inline"
                                                action="{{ route('admin.roles.destroy', $role->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button onclick="return confirm('Are you sure?!')"
                                                    class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</x-admin-layout>
