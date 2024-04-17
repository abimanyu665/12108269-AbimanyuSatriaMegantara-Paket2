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
                    <h1>User Data</h1>
                    <a href="/user/create" class="btn btn-primary">Add New User</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td class="d-flex mt-2">
                                        <a href="/user/edit/{{ $item->id }}" class="btn btn-warning">Edit</a>
                                        <form action="/user/delete/{{ $item->id }}" method="POST">
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
