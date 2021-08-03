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
        <div class="block block-rounded">
            <div class="block-content">
                <!-- <p>Your content..</p> -->
            </div>

             <!-- Pricing Title-->
                <div class="text-center">
                    <h3 class="mb-2">Here are your <b>Unpaid Fees</b></h3>
                    <!-- <p class="text-muted w-50 m-auto">
                        We have plans and prices that fit your business perfectly. Make your client site a success with our products.
                    </p> -->
                </div>

                @if (Auth::user()->prospectus_fee_status == 'NOTPAID')

                <!-- Page Content -->
                <div class="content">
                    <!-- Modern Design -->
                    <div class="row center">
                        <div class="col-md-6 col-xl-3">
                            <!-- Freelancer Plan -->
                            <a class="block block-link-pop block-rounded text-center" href="javascript:void(0)">
                                <div class="block-header">
                                    <h3 class="block-title">Prospectus Fee</h3>
                                </div>
                                <div class="block-content bg-primary">
                                    <div class="py-2">
                                        <p class="h1 font-w700 text-white mb-2">#5000</p>
                                        <p class="h6 text-white-75">Once</p>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <div class="py-2">
                                        <p>
                                            <strong>3</strong> Projects
                                        </p>
                                        <p>
                                            <strong>1GB</strong> Storage
                                        </p>
                                        <p>
                                            <strong>1</strong> Monthly Backup
                                        </p>
                                        <p>
                                            <strong>10</strong> Clients
                                        </p>
                                        <p>
                                            <strong>Email</strong> Support
                                        </p>
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                                    <input type="hidden" name="email" value="{{auth()->user()->email}}"> {{-- required --}}
                                    <input type="hidden" name="orderID" value="Prospectus Fee">
                                    <input type="hidden" name="amount" value="50000"> {{-- required in kobo --}}
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="currency" value="NGN">
                                    <input type="hidden" name="callback_url" value="http://localhost:8000/payment/callback">
                                    <input type="hidden" name="metadata" value="{{ json_encode($array = [
                                        'first_name' => Auth::user()->first_name,
                                        'last_name' => Auth::user()->last_name,
                                        'email' => Auth::user()->email,  
                                        'fee_type' => 'Prospectus Fee',    
                                        'session' => '2020/2021',                         
                                        'fID' => Auth::user()->fID,
                                        ]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                    {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}

                                    <p>
                                        <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                                            <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                                        </button>
                                    </p>
                                </form>

                            </a>
                            <!-- END Freelancer Plan -->
                        </div>  
                @endif
                        @if(auth()->user()->department_fee_status == 'NOTPAID')
                        <div class="col-md-6 col-xl-3">
                            <!-- Freelancer Plan -->
                            <a class="block block-link-pop block-rounded text-center" href="javascript:void(0)">
                                <div class="block-header">
                                    <h3 class="block-title">Department Fee</h3>
                                </div>
                                <div class="block-content bg-success">
                                    <div class="py-2">
                                        <p class="h1 font-w700 text-white mb-2">#2000</p>
                                        <p class="h6 text-white-75">Per Session</p>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <div class="py-2">
                                        <p>
                                            <strong>3</strong> Projects
                                        </p>
                                        <p>
                                            <strong>1GB</strong> Storage
                                        </p>
                                        <p>
                                            <strong>1</strong> Monthly Backup
                                        </p>
                                        <p>
                                            <strong>10</strong> Clients
                                        </p>
                                        <p>
                                            <strong>Email</strong> Support
                                        </p>
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                                    <input type="hidden" name="email" value="{{auth()->user()->email}}"> {{-- required --}}
                                    <input type="hidden" name="orderID" value="Department Fee">
                                    <input type="hidden" name="amount" value="200000"> {{-- required in kobo --}}
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="currency" value="NGN">
                                    <input type="hidden" name="callback_url" value="http://localhost:8000/payment/callback">
                                    <input type="hidden" name="metadata" value="{{ json_encode($array = [
                                        'first_name' => Auth::user()->first_name,
                                        'last_name' => Auth::user()->last_name,
                                        'email' => Auth::user()->email,  
                                        'fee_type' => 'Department Fee',    
                                        'session' => '2020/2021',                         
                                        'fID' => Auth::user()->fID,
                                        ]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                    {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}

                                    <p>
                                        <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                                            <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                                        </button>
                                    </p>
                                </form>

                            </a>
                            <!-- END Freelancer Plan -->
                        </div>
                        @endif

                        @if(auth()->user()->school_fee_status == 'NOTPAID')
                        <div class="col-md-6 col-xl-3">
                            <!-- Freelancer Plan -->
                            <a class="block block-link-pop block-rounded text-center" href="javascript:void(0)">
                                <div class="block-header">
                                    <h3 class="block-title">School Fee</h3>
                                </div>
                                <div class="block-content bg-danger">
                                    <div class="py-2">
                                        <p class="h1 font-w700 text-white mb-2">#80000</p>
                                        <p class="h6 text-white-75">Per Session</p>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <div class="py-2">
                                        <p>
                                            <strong>3</strong> Projects
                                        </p>
                                        <p>
                                            <strong>1GB</strong> Storage
                                        </p>
                                        <p>
                                            <strong>1</strong> Monthly Backup
                                        </p>
                                        <p>
                                            <strong>10</strong> Clients
                                        </p>
                                        <p>
                                            <strong>Email</strong> Support
                                        </p>
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                                    <input type="hidden" name="email" value="{{auth()->user()->email}}"> {{-- required --}}
                                    <input type="hidden" name="orderID" value="School Fee">
                                    <input type="hidden" name="amount" value="800000"> {{-- required in kobo --}}
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="currency" value="NGN">
                                    <input type="hidden" name="callback_url" value="http://localhost:8000/payment/callback">
                                    <input type="hidden" name="metadata" value="{{ json_encode($array = [
                                        'first_name' => Auth::user()->first_name,
                                        'last_name' => Auth::user()->last_name,
                                        'email' => Auth::user()->email,  
                                        'fee_type' => 'School Fee',    
                                        'session' => '2020/2021',                         
                                        'fID' => Auth::user()->fID,
                                        ]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                    {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}

                                    <p>
                                        <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                                            <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                                        </button>
                                    </p>
                                </form>

                            </a>
                            <!-- END Freelancer Plan -->
                        </div>
                        @endif



                    </div>
                </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection
