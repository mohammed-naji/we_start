@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.0/tinymce.min.js" integrity="sha512-CpqBk+ddDL2iYxwLkBkqiL9HywSfSfVQdkZThgvEryhQXnGlrrp9foNf6K9hDM+QrNUyT9ElgRoKJLSnsLujow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<script>
    tinymce.init({
        selector: '.contentarea'
    })

    var uploadedDocumentMap = {}
    Dropzone.autoDiscover = false;
    let myDropzone = new Dropzone("div#gallery", {
        url: "{{ route('admin.add_image') }}",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        addRemoveLinks: true,
        success: function(file, response) {
            let img = `<input type="hidden" name="album[]" value="${response}" />`
            document.querySelector('.gallery-wrapper').insertAdjacentHTML("beforeend", img );
            uploadedDocumentMap[file.name] = response
        },
        removedfile: function(file) {
            file.previewElement.remove()
            name = uploadedDocumentMap[file.name];
            document.querySelector('input[name="album[]"][value="' + name + '"]').remove()
        }
    });



    // Add New Field
    let btns = document.querySelectorAll('.add_feild')
    btns.forEach(el => {
        el.onclick = (e) => {
            e.preventDefault();

            let type = el.dataset.type;

            let index = document.querySelectorAll(`.${type}-wrapper .row`).length;

            // console.log(index);

            // $('.btn').click(function() {

            // })

            // $('.btn').on('click', function() {

            // })

            // $('.btn-wrapper').on('click', '.btn', function() {

            // })

            let field = `<div class="row">
                            <div class="col-8">
                                <input type="text" name="variation[${type}s][${index}][value]" class="form-control"
                                placeholder="Value">
                            </div>
                            <div class="col-4">
                                <input type="text" name="variation[${type}s][${index}][price]" class="form-control"
                                placeholder="Value">
                            </div>
                        </div>`;

            document.querySelector(`.${type}-wrapper`).insertAdjacentHTML("beforeend", field );
            // console.log(type);
        }
    })


    let inputImage = document.querySelector('#inputImage');

    inputImage.onchange = (e) => {
        let output = e.target.nextElementSibling;
        // console.log(output);
        output.src = URL.createObjectURL(e.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    }
</script>
@endpush

<x-admin-layout title="Add New Category">
    <div class="content">
        <div class="container-fluid">
            <br>
            <h2>Add New Category</h2>
            <br>
            <div class="row">
                <div class="col-md-12">

                    <x-errors />

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-body">

                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="basic-data-tab" data-toggle="tab"
                                            data-target="#basic-data" type="button" role="tab"
                                            aria-controls="basic-data" aria-selected="true">Basic Data</button>
                                        <button class="nav-link" id="images-tab" data-toggle="tab"
                                            data-target="#images" type="button" role="tab"
                                            aria-controls="images" aria-selected="false">Images</button>
                                        <button class="nav-link" id="variations-tab" data-toggle="tab"
                                            data-target="#variations" type="button" role="tab"
                                            aria-controls="variations" aria-selected="false">Variations</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="basic-data" role="tabpanel"
                                        aria-labelledby="basic-data-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mt-3">
                                                    <label for="featured" class="mr-3">Featured</label>
                                                    <input id="featured" type="checkbox" name="featured" value="1">
                                                </div>
                                            </div>
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

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>English Small Description</label>
                                                    <textarea name="en_smalldesc" class="form-control" placeholder="Small Description" rows="5"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Arabic Small Description</label>
                                                    <textarea name="ar_smalldesc" class="form-control" placeholder="Small Description" rows="5"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>English Description</label>
                                                    <textarea name="en_desc" class="form-control contentarea" placeholder="Description" rows="5"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Arabic Description</label>
                                                    <textarea name="ar_desc" class="form-control contentarea" placeholder="Description" rows="5"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Price</label>
                                                    <input type="number" name="price" class="form-control"
                                                        placeholder="Price">
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Quantity</label>
                                                    <input type="number" name="quantity" class="form-control"
                                                        placeholder="Quantity">
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <select name="category_id" class="form-control custom-select">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->trans_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="images" role="tabpanel"
                                        aria-labelledby="images-tab">
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="inputImage">Image</label>
                                                    <input type="file" name="image" class="form-control"
                                                        id="inputImage">
                                                    <img width="80" class="img-thumbnail" src="">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Gallery</label>
                                                    <div class="dropzone" id="gallery">
                                                        <div class="dz-message">
                                                            Upload Product Images
                                                        </div>
                                                    </div>
                                                    {{-- <input type="file" name="gallery" class="form-control"
                                                        id="inputImage"> --}}

                                                        <div class="gallery-wrapper"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="variations" role="tabpanel"
                                        aria-labelledby="variations-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Colors</label>

                                                    <div class="color-wrapper">

                                                    </div>

                                                    <button class="btn btn-sm btn-primary mt-2 add_feild" data-type="color">Add</button>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Sizes</label>
                                                    <div class="size-wrapper">

                                                    </div>

                                                    <button class="btn btn-sm btn-primary mt-2 add_feild" data-type="size">Add</button>
                                                </div>
                                            </div>
                                        </div>
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
