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
                <div class="card-header" style="display:flex">
                   <strong>search products</strong> 
                   <br>
                   <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      Filter by Category
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach ($allcategories as $cat )
                        <li><a class="dropdown-item" href="{{ route('bycategory',$cat->id) }}">{{ $cat->title }}</a></li>
                        @endforeach
                      
                    </ul>
                  </div>
                  
                   <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      Filter by Sub Category
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach ($allsubcategories as $sub )
                        <li><a class="dropdown-item" href="{{ route('bysubcategory',$sub->id) }}">{{ $sub->title }}</a></li>
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
                                  <button value="{{ $item->id }}" class="btn btn-sm btn-danger delete_student">delete</button>
                                </td>
                                <td>{{ $item->title }}</td>
                                <td >
                                    <img style="width: 90px" src="{{ asset('images/'.$item->thumbnail) }}" alt="" srcset="">
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
    $(document).ready( function () {
    $('#myTable').DataTable();
  } );
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
  function refreshPage()
  {
      window.location = window.location.href;
  }
  
</script>
@endsection