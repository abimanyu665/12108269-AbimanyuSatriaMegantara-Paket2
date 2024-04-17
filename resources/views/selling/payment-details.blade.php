@extends('layouts.layout')
@section('contents')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="invoice-preview-wrapper">
                <div class="row invoice-preview">
                    <!-- Invoice -->
                    <div class="col-xl-9 col-md-8 col-12">
                        <div class="card invoice-preview-card">
                            <div class="card-body invoice-padding pb-0">
                                <!-- Header starts -->
                                <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                    <div>
                                        <div class="logo-wrapper d-flex align-items-center">
                                            <img src="/app-assets/images/logo.png" alt="" width="40px">

                                            <h3 class="text-primary invoice-logo">Cashier</h3>
                                        </div>

                                    </div>
                                    <div class="mt-md-0 mt-2">
                                        <h4 class="invoice-title">
                                            Invoice
                                            <span class="invoice-number">#{{ $sellingData->id }}</span>
                                        </h4>
                                        <div class="invoice-date-wrapper">
                                            <p class="invoice-date-title">Date Issued:</p>
                                            <p class="invoice-date">{{ $sellingData->created_at }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Header ends -->
                            </div>

                            <hr class="invoice-spacing" />

                            <!-- Address and Contact starts -->
                            <div class="card-body invoice-padding pt-0">
                                <div class="row invoice-spacing">
                                    <div class="col-xl-8 p-0">
                                        <h6 class="mb-2">Invoice To:</h6>
                                        <h6 class="mb-25">{{ $sellingData->customer->name }}</h6>
                                        <p class="card-text mb-0">{{ $sellingData->customer->address }}</p>
                                    </div>
                                    <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                        <h6 class="mb-2">Payment Details:</h6>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="pe-1">Total price:</td>
                                                    <td><span class="fw-bold">Rp
                                                            {{ number_format($sellingData->total_price, 0, ',', '.') }}</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Address and Contact ends -->

                            <!-- Invoice Description starts -->
                            <div class=" table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="py-1">Image</th>
                                            <th class="py-1">Item name</th>
                                            <th class="py-1">Price</th>
                                            <th class="py-1">Quantity</ths>
                                            <th class="py-1">Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sellingData->salesDetail as $item)
                                            <tr>
                                                <td class="py-1">
                                                    <img src="{{ asset("/image/{$item->product->image}") }}" alt="" width="70">
                                                </td>
                                                <td class="py-1">
                                                    <p class="card-text fw-bold mb-25">{{ $item->product->name }}</p>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold">Rp
                                                        {{ number_format($item->product->price, 0, ',', '.') }}</span>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold">{{ $item->amount }}</span>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold">Rp
                                                        {{ number_format($item->product->price, 0, ',', '.') }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-body invoice-padding pb-0">
                                <div class="row invoice-sales-total-wrapper">
                                    <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                        <p class="card-text mb-0">
                                            <span class="fw-bold">Salesperson:</span> <span
                                                class="ms-75">{{ $sellingData->user->name }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Invoice Description ends -->

                            <hr class="invoice-spacing" />

                            <!-- Invoice Note starts -->
                            <!-- Invoice Note ends -->
                        </div>
                    </div>
                    <!-- /Invoice -->

                    <!-- Invoice Actions -->
                    <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <a href="/selling/download/{{ $sellingData->id }}" class="btn btn-primary w-100 mb-75">
                                    Download
                                </a>
                                <a href="/selling" class="btn btn-success w-100">
                                    Close
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /Invoice Actions -->
                </div>
            </section>

            <!-- Send Invoice Sidebar -->

            <!-- /Send Invoice Sidebar -->

            <!-- Add Payment Sidebar -->

            <!-- /Add Payment Sidebar -->

        </div>
    </div>
    </div>
@endsection
