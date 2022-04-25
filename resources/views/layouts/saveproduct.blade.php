@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                
                <br>
                {{-- add sub category --}}
                <div style="text-align: center">
                    <strong>Add Product</strong>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">{{ __('Add Products') }}</div>
                    <div class="card-body">
                        <div class="alert" id="message" style="display: none"></div>
                        <div id="error_message"></div>
                        <ul id="errorList"></ul>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" id="upload_form" enctype="multipart/form-data">
                            @csrf
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul>

                                </ul>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">


                            <label for="basic" class="form-label">Name</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                            </div>
                            <label for="description" class="form-label">Description</label>
                            <div class="input-group mb-3">
                                <textarea class="form-control" name="description" id="description" cols="30" rows="2"></textarea>
                            </div>
                            <label for="basic" class="form-label">Price</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" id="price" name="price" placeholder="price">
                            </div>
                            <label for="sub category name" class="form-label">Select sub category</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="subcategory_id" name="subcategory_id" aria-label="Default select example">
                                    <option >Sub Category name</option>
                                    @foreach ($subcategory as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="images" class="form-label">Select Picture</label>
                            <br>
                            <img id="image" src="#" alt="No image">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="thumbnail" name="thumbnail" required
                                    accept="image/*" placeholder="thumbnail" onchange="readURL(this);">
                            </div>
                            <button class="btn btn-sm btn-primary" type="submit">save</button>
                        </form>
                        <div style="text-align:right">
                            <a class="btn btn-sm btn-success" href="{{ route('viewproducts') }}">Go to product section</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $('#upload_form').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ url('prosave') }}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
                        if (data.error) {
                            $('#message').html("");
                            $('#error_message').html("");
                            $('#error_message').addClass('alert alert-danger');
                            $.each(data.error, function(key,
                                errorElement
                            ) { // showing earch error with for each loop
                                $('#error_message').append('<li>' + errorElement +
                                    '</li>')
                            });
                        } else {
                            $('#error_message').html("")
                            $('#message').html("");
                            $('#message').css('display', 'block');
                            $('#message').html(data.success);
                            $('#message').addClass(data.class_name);
                            $('#title').val('');
                            $('#description').val('');
                            $('#price').val('');
                            $('#subcategory_id').val('');
                            
                            
                        }

                    }
                })
            });

        });
    </script>
{{-- image Upload thumbanile --}}
<script>
    function readURL(input) {
        // console.log('ok');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(90);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
