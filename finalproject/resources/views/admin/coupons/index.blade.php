@push('scripts')
    <script>
        function edit_category(id) {
            let url = '{{ route("admin.coupons.index") }}/'+id;
            $.get({
                url,
                success: (res) => {
                    $('#editModal form').attr('action', url)
                    $('#editModal input[name=en_name]').val(res.en_name)
                    $('#editModal input[name=ar_name]').val(res.ar_name)
                    $('#editModal input[name=code]').val(res.code)
                    $('#editModal select[name=type]').val(res.type)
                    $('#editModal input[name=value]').val(res.value)
                    $('#editModal input[name=expire]').val(res.expire)
                    $('#editModal input[name=usage]').val(res.usage)
                    $('#editModal select[name=product_id]').val(res.product_id)
                }
            })
        }

        $('#edit_form').on('submit', function(e) {
            e.preventDefault();

            var data = new FormData(this);
            let url = $('#editModal form').attr('action');
            $.ajax({
                type: 'post',
                url,
                data,
                cache: false,
                contentType: false,
                processData: false,
                success: (res) => {
                    $('#row_'+res.id+' td:nth-child(2)').text(res.trans_name);
                    $('#row_'+res.id+' td:nth-child(3)').text(res.code);
                    $('#row_'+res.id+' td:nth-child(4)').text(res.usage);
                    $('#row_'+res.id+' td:nth-child(5)').text(res.expire);

                    $('#editModal').modal('hide')
                }
            })
        })
    </script>
@endpush


<x-admin-layout :title="'All Coupons'">

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
                        <h2>All coupons</h2>
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-dark">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Usage</th>
                                    <th>Expire</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($coupons as $coupon)
                                    <tr id="row_{{ $coupon->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $coupon->trans_name }}</td>
                                        <td>{{ $coupon->code }}</td>
                                        <td>{{ $coupon->usage }}</td>
                                        <td>{{ $coupon->expire }}</td>
                                        <td>
                                            <a onclick="edit_category({{ $coupon->id }})" data-id="{{ $coupon->id }}" data-toggle="modal" data-target="#editModal"
                                                class="btn btn-primary btn-sm btn-edit"><i class="fas fa-edit"></i></a>
                                            <form class="d-inline"
                                                action="{{ route('admin.coupons.destroy', $coupon->id) }}"
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
                                        <td colspan="5">No Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $coupons->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit_form" action="" method="POST">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>English Name</label>
                                    <input type="text" name="en_name" class="form-control" placeholder="English Name">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>Arabic Name</label>
                                    <input type="text" name="ar_name" class="form-control" placeholder="Arabic Name">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" name="code" class="form-control" placeholder="Code">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select name="type" class="form-control custom-select">
                                        <option value="value">Value</option>
                                        <option value="percentage">Percentage</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label>Value</label>
                                    <input type="text" name="value" class="form-control" placeholder="Value">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label>Expire</label>
                                    <input type="date" name="expire" class="form-control" placeholder="Expire">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label>Usage</label>
                                    <input type="number" name="usage" class="form-control" placeholder="Usage">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label>Product</label>
                                    <select name="product_id" class="form-control custom-select">
                                    </select>
                                </div>
                            </div>
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
