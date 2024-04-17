@extends('layouts.layout')
@section('contents')
    @if(Session::has('success'))
        <div class="alert alert-success text-center py-1" role="alert">
           <h2>{{ Session::get('success') }}</h5>
        </div>
    @endif
    @if(Session::has('fail'))
        <div class="alert alert-success text-center py-1" role="alert">
            <h2>{{ Session::get('fail') }}</h5>
        </div>
    @endif

    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1>Product Data</h1>
                    <div class="">

                        <form action="{{ route('product.search') }}" method="GET" class="d-flex">
                            <input type="text" class="form-control" name="query" placeholder="Search For Product">
                            <button class="btn btn-secondary ps-2" type="submit"></button>
                        </form>
                    <a href="/product/create" class="btn btn-primary mt-2">Add New Product</a>

                </div>

                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ asset("/image/{$item->image}") }}" alt="" width="100"></td>
                                    <td>{{ $item->name }}</td>
                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td class="d-flex mt-2">
                                        <a href="/product/edit/{{ $item->id }}" class="btn btn-warning">Edit</a>
                                        <form action="/product/delete/{{ $item->id }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger ms-1">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
