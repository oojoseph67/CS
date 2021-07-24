@extends('layouts.simple')

@section('content')
    <!-- Hero -->
    <!-- <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Main Title</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Examples</li>
                        <li class="breadcrumb-item active" aria-current="page">Blank</li>
                    </ol>
                </nav>
            </div>
       </div>
    </div> -->
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="card-box">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>


        <!-- Your Block -->
        <div class="block block-rounded" >
            <!-- <div class="block-header block-header-default center" >
                <h3 class="block-title">Payment </h3>
            </div> -->
            <div class="block-content center">
                <!-- <p>Your content..</p> -->

                <!-- Page Content -->
                <div class="content content-boxed">
                    <!-- Invoice -->
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">#INV{{$order_number}}</h3>
                            <div class="block-options">
                                <!-- Print Page functionality is initialized in Helpers.print() -->
                                <button type="button" class="btn-block-option" onclick="Dashmix.helpers('print');">
                                    <i class="si si-printer mr-1"></i> Print Invoice
                                </button>
                                <button type="button" class="btn-block-option">
                                    <i class="si si-arrow mr-1"></i> <a href="{{ route('student.home') }}">Continue</a> 
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="p-sm-4 p-xl-7">
                                <!-- Invoice Info -->
                                <div class="row mb-5">
                                    <!-- Company Info -->
                                    <div class="col-6">
                                        <p class="h3">Company</p>
                                        <address>
                                            Federal University of Pertroleum Resouces Effurun<br>
                                            Delta, Warri<br>
                                            Region, Postal Code<br>
                                            fupre@edu.ng
                                        </address>
                                    </div>
                                    <!-- END Company Info -->

                                    <!-- Client Info -->
                                    <div class="col-6 text-right">
                                        <p class="h3">Client</p>
                                        <address>
                                            {{$first_name}} {{$last_name}}<br>
                                            <b> Order Number: </b> {{$order_number}}<br>
                                            <h6 style="text-transform: capitalize;">Status: {{$status}}</h6> <br>
                                            {{$email}}
                                        </address>
                                    </div>
                                    <!-- END Client Info -->
                                </div>
                                <!-- END Invoice Info -->

                                <!-- Table -->
                                <div class="table-responsive push">
                                    <table class="table table-bordered">
                                        <thead class="bg-body">
                                            <tr>
                                                <th class="text-center" style="width: 60px;"></th>
                                                <th>Fee Type</th>
                                                <th class="text-center" style="width: 90px;">Qnt</th>
                                                <th class="text-right" style="width: 120px;">Price</th>
                                                <th class="text-right" style="width: 120px;">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>
                                                    <p class="font-w600 mb-1">{{$fee_type}}</p>
                                                    <div class="text-muted">{{$fee_type}} Into The PG Programme</div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-pill badge-primary">1</span>
                                                </td>
                                                <td class="text-right">#{{$amount}}</td>
                                                <td class="text-right">#{{$amount}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="font-w600 text-right">Subtotal</td>
                                                <td class="text-right">#{{$amount}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="font-w700 text-uppercase text-right bg-body-light">Total Due</td>
                                                <td class="font-w700 text-right bg-body-light">#{{$amount}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END Table -->

                                <!-- Footer -->
                                <p class="text-muted text-center my-5">
                                    Thank you for doing business with us.
                                </p>
                                <!-- END Footer -->
                            </div>
                        </div>
                    </div>
                    <!-- END Invoice -->
                </div>
                <!-- END Page Content -->



            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection
