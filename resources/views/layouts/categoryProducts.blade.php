@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">

                <br>
                {{-- add sub category --}}
                <div style="text-align: center">
                    <strong>Filter By Category Product</strong>
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
                        {{-- subcategory --}}
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Product Title</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Sub Category</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productThroughCategory as $item)
                                    @foreach ($item->products as $value)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $value->title }}</td>
                                            <td> <img style="width: 90px" src="{{ asset('images/' . $value->thumbnail) }}"
                                                    alt="" srcset=""></td>
                                            <td>{{ $value->description }}</td>
                                            <td>{{ $value->price }}</td>
                                            <td>{{ $value->subcategory_id }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
