<x-admin-layout title="Add New Category">
    <br>
    <h1>Add New Category</h1>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-primary">
                        <div class="card-body">
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
                            </div>

                            <div class="form-group">
                                <label for="inputImage">Image</label>
                                <input type="file" name="image" class="form-control" id="inputImage">
                            </div>

                            <div class="form-group">
                                <label>Parent</label>
                                <select name="parent_id" class="form-control custom-select">
                                    <option value="">-- Select --</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
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
