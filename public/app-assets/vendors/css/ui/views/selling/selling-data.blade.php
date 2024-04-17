@extends('layouts.layout')
@section('contents')
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1>Selling Data</h1>
                    <a href="/selling/create" class="btn btn-primary">Add new selling data</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Customer Name</th>
                                <th>Total Price</th>
                                <th>Salesman</th>
                                <th>Date issued</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Bims</td>
                                    <td>Rp 20,000</td>
                                    <td>Bims</td>
                                    <td>20/07/2006</td>
                                    <td class="d-flex">
                                        <a href="/selling/detail/1" class="btn btn-warning">See
                                            Details</a>
                                        <a href="/selling/download/1"
                                            class="btn btn-success ms-1">Download</a>
                                        <form action="/selling/delete/1" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger ms-1">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
