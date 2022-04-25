@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                {{-- <div class="card">
                    <div class="card-header">{{ __('Add Category') }}</div>
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
                        <form method="post" id="category_form">
                            @csrf
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul>

                                </ul>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">


                            <label for="basic" class="form-label">Title</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Category Title">
                            </div>
                            <label for="description" class="form-label">Description</label>
                            <div class="input-group mb-3">
                                <textarea class="form-control" name="description" id="description" cols="30" rows="2"></textarea>
                            </div>
                            <button class="btn btn-sm btn-primary saveButton" type="submit">save</button>
                        </form>
                    </div>
                </div> --}}
                <br>
                {{-- add sub category --}}
                <div style="text-align: center">
                    <strong>Sub Category</strong>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">{{ __('Add Subategory') }}</div>
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
                        <form method="post" id="subcategory_form">
                            @csrf
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul>

                                </ul>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">


                            <label for="basic" class="form-label">Sub category Name</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Category Title">
                            </div>
                            <label for="description" class="form-label">Description</label>
                            <div class="input-group mb-3">
                                <textarea class="form-control" name="description" id="description" cols="30" rows="2"></textarea>
                            </div>
                            <label for="category name" class="form-label">Select parent category</label>
                            <div class="input-group mb-3">
                                <select class="form-select" name="category_id" aria-label="Default select example">
                                <option value="">Category name</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                                </select>
                            </div>
                            <button class="btn btn-sm btn-primary saveButton" type="submit">save</button>
                        </form>
                        <div style="text-align:right">
                            <a class="btn btn-sm btn-success" href="{{ route('product') }}">Go to product section</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
   

    {{-- subcategory --}}
    <script>
        //add sub category 
        $(document).ready(function() {
            $('#subcategory_form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "savesubCategory",
                    method: "POST",
                    data: new FormData(this),
                    dataType: "JSON",
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
                        }

                    }
                });
            });
        });
    </script>
@endsection
