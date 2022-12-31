@push('styles')
    <style>
        ul.permissions {
            column-count: 2;
        }
    </style>
@endpush

<x-admin-layout title="Add New Role">
    <div class="content">
        <div class="container-fluid">
            <br>
            <h2>Add New Role</h2>
            <br>
            <div class="row">
                <div class="col-md-12">

                    <x-errors />

                    <form action="{{ route('admin.roles.store') }}" method="POST">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>English Name</label>
                                            <input type="text" name="en_name" class="form-control"
                                                placeholder="English Name">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Arabic Name</label>
                                            <input type="text" name="ar_name" class="form-control"
                                                placeholder="Arabic Name">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label>Permissions</label>
                                        <ul class="list-unstyled permissions">
                                            @foreach ($permissions as $permission)
                                                <li><label><input type="checkbox" name="permissions[]" value="{{ $permission->id }}"> {{ __('per.'.$permission->name) }}</label></li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>

                                <button class="btn btn-success">Save</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
