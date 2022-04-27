@extends('layouts.app')
@section('content')
    <div class="container">
        {{-- <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Launch demo modal
        </button> --}}

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="submit_form" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="alert alert-danger print-error-msg" style="display:none">
                              <ul>
                              </ul>
                            </div>
                            <input type="hidden" class="form-control" id="id" name="id" placeholder="id">
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
                                <select class="form-select" id="subcategory_id" name="subcategory_id"
                                    aria-label="Default select example">
                                    <option>Sub Category name</option>
                                    @foreach ($allsubcategories as $item)
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
                            <div class="input-group mb-3" id="picture">

                            </div>
                            <button class="btn btn-sm btn-primary" type="submit">update</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
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
                    <div class="card-header" style="display:flex">
                        <strong>search products</strong>
                        <br>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Filter by Category
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @foreach ($allcategories as $cat)
                                    <li><a class="dropdown-item"
                                            href="{{ route('bycategory', $cat->id) }}">{{ $cat->title }}</a></li>
                                @endforeach

                            </ul>
                        </div>

                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Filter by Sub Category
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @foreach ($allsubcategories as $sub)
                                    <li><a class="dropdown-item"
                                            href="{{ route('bysubcategory', $sub->id) }}">{{ $sub->title }}</a></li>
                                @endforeach

                            </ul>
                        </div>

                    </div>


                    <div class="card-body">
                        <div class="alert" id="message" style="display: none"></div>
                        <div id="error_message"></div>
                        <ul id="errorList"></ul>
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Category ID</th>
                                    <th scope="col">Sub Category</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allProducts as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            <button value="{{ $item->id }}"
                                                class="btn btn-sm btn-danger delete_student">delete</button>
                                            <!-- Button trigger modal -->
                                            <a href="{{ route('productedit.edit', $item->id) }}"
                                                class="btn edit_button btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                edit
                                            </a>
                                        </td>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            <img style="width: 90px" src="{{ asset('images/' . $item->thumbnail) }}"
                                                alt="" srcset="">
                                        </td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->subcategory->category_id }}</td>
                                        <td>{{ $item->subcategory->title }}</td>

                                    </tr>
                                @endforeach


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit_button', function(e) {
                e.preventDefault();
                let url = $(this).attr("href")
                $.ajax({
                    type: "get",
                    url: url,
                    success: function(response) {
                        //  console.log(response);
                        if (response.status == 200) {
                            $('#id').val(response.currentProduct.id);
                            $('#title').val(response.currentProduct.title);
                            $('#description').val(response.currentProduct.description)
                            $('#price').val(response.currentProduct.price)
                            $('#subcategory_id').val(response.currentProduct.subcategory_id)
                            $('#title').val(response.currentProduct.title)
                            // $('#thumbnail').val(response.currentProduct.thumbnail)
                            $("#picture").html(
                                `<img src="/images/${response.currentProduct.thumbnail}" width="100" class="img-fluid img-thumbnail">`
                            );
                        } else {
                            alert('something went wrong')
                        }
                    }
                });
            });
            // submit form
            $(document).on('submit', '#submit_form', function(e) {
                e.preventDefault();
                let id = $('#id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('productedit') }}" + '/' + id,
                    method: "post",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                      if(response.status == 200) {
                        swal({
                          icon:"success",
                        });
                        $('#exampleModal').modal('hide');
                        
                      }else{
                        swal({
                        icon:"error",
                      });
                      refreshPage();
                    }
                  }
                });
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

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    {{-- delete --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.delete_student', function(e) {
                e.preventDefault();
                var delete_id = $(this).val();
                // console.log(delete_id);
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: "get",
                                url: "/delete/" + delete_id,
                                success: function(response) {
                                    swal(response.message, {
                                        icon: "success",
                                    });
                                    refreshPage()
                                }
                            });
                        } else {
                            swal("Your file is safe!");
                        }
                    });
            });
        });
    </script>
    {{-- End delete --}}
    <script>
        function refreshPage() {
            window.location = window.location.href;
        }
    </script>
@endsection
