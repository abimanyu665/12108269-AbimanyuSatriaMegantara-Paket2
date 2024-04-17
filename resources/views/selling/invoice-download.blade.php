<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    <!-- BEGIN: Head-->

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui" />
        <meta name="description"
            content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities." />
        <meta name="keywords"
            content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app" />
        <meta name="author" content="PIXINVENT" />
        <title>Home - Vuexy - Bootstrap HTML admin template</title>
        <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png" />
        <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico" />
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
            rel="stylesheet" />

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css" />
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/bootstrap.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/bootstrap-extended.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/colors.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/components.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/themes/dark-layout.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/themes/semi-dark-layout.css') }}" />

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}" />
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.css') }}" />
        <!-- END: Custom CSS-->
    </head>

    <body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click"
        data-menu="vertical-menu-modern" data-col="">
        <div class="container">
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <section class="invoice-preview-wrapper">
                        <div class="row invoice-preview">
                            <!-- Invoice -->
                            <div class="col-xl-12 col-md-8 col-12">
                                <div class="card invoice-preview-card">
                                    <div class="card-body invoice-padding pb-0">
                                        <!-- Header starts -->
                                        <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                            <div>
                                                {{-- <img src="/app-assets/images/logo.png" alt="" width="40px"> --}}
                                                <h2>Cashier App</h2>
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

        <!-- BEGIN: Vendor JS-->
        <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
        <!-- BEGIN Vendor JS-->

        <!-- BEGIN: Page Vendor JS-->
        <!-- END: Page Vendor JS-->

        <!-- BEGIN: Theme JS-->
        <script src="../../../app-assets/js/core/app-menu.js"></script>
        <script src="../../../app-assets/js/core/app.js"></script>
        <!-- END: Theme JS-->

        <!-- BEGIN: Page JS-->
        <!-- END: Page JS-->

        <script>
            $(window).on("load", function() {
                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14,
                    });
                }
            });
        </script>
        <script>
            window.print()
        </script>
    </body>
    <!-- END: Body-->

</html>
