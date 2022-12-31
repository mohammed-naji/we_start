

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.basic-single').select2({
                width: 'resolve'
            });
        });

        $('.btn-edit').click(function() {
            $('.basic-single').val('');
            $('.basic-single').trigger('change');
            let url = $(this).data('url');
            let roles = $(this).data('roles');
            // console.log(typeof roles);
            if(roles) {
                if(typeof roles != 'number') {
                    roles = roles.split(',');
                }
                $('.basic-single').val(roles);
                $('.basic-single').trigger('change');
            }

            // console.log(roles);
            $('#edit_form').attr('action', url);
        })

        // $('#edit_form').on('submit', function(e) {
        //     e.preventDefault();

        //     var data = new FormData(this);
        //     let url = $('#editModal form').attr('action');
        //     $.ajax({
        //         type: 'post',
        //         url,
        //         data,
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         success: (res) => {
        //             console.log(res);
        //             // $('#row_'+res.id+' td:nth-child(2)').text(res.trans_name);
        //             // $('#row_'+res.id+' td:nth-child(3) img').attr('src', '/'+res.image.path)
        //             // $('#row_'+res.id+' td:nth-child(4)').text(res.parent.trans_name);

        //             // $('#editModal').modal('hide')
        //         }
        //     })
        // })
    </script>
@endpush

<x-admin-layout :title="'All Admins'">

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
                        <h2>All admins</h2>
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-dark">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($admins as $admin)
                                    <tr id="row_{{ $admin->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->phone }}</td>
                                        <td>{{ $admin->created_at->format('F m, Y') }}</td>
                                        <td>
                                            <button
                                            data-toggle="modal"
                                            data-target="#editModal"
                                            data-url={{ route('admin.edit_admin', $admin->id) }}
                                            data-roles="{{ implode(',', $admin->roles()->pluck('id')->toArray()) }}"
                                            class="btn btn-primary btn-sm btn-edit"
                                            ><i class="fas fa-edit"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $admins->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit_form" action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Roles</label>
                            <select style="width: 100%" name="roles[]" class="form-control basic-single" multiple>
                                <option value="">-- Select --</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->trans_name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" id="save_edit">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- /.content -->
</x-admin-layout>
