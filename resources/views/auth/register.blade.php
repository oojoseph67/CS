@extends('layouts.simple')

@section('content')
<div id="page-container">

<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="bg-image" style="background-image: url({{asset('media/photos/photo14@2x.jpg')}});">
        <div class="row no-gutters justify-content-center bg-black-75">
            <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                <!-- Sign Up Block -->
                <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                    <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-white">
                        <!-- Header -->
                        <div class="mb-2 text-center">
                            <a class="link-fx text-success font-w700 font-size-h1" href="{{ route('register') }}">
                                <span class="text-dark">FUPRE</span><span class="text-success"> PG CS</span>
                            </a>
                            <p class="text-uppercase font-w700 font-size-sm text-muted">Create New Account</p>
                        </div>
                        <!-- END Header -->

                        <!-- Sign Up Form -->
                        <form method="POST" action="{{ route('register') }}">

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

                            @csrf
                            
                            <input type="hidden" name="role" value="student">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="first_name" name="first_name" :value="old('first_name')" placeholder="First Name" autocomplete='off'>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-user-circle"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="last_name" name="last_name" :value="old('last_name')" placeholder="Last Name" autocomplete='off'>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-user-circle"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="email" class="form-control" id="email" name="email" :value="old('email')" placeholder="Email" autocomplete='off'>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-envelope-open"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password" placeholder="Password">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-asterisk"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-asterisk"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <a class="font-w600 font-size-sm" href="{{ route('login') }}">Already registered?</a>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-hero-success">
                                    <i class="fa fa-fw fa-plus mr-1"></i> Sign Up
                                </button>
                            </div>
                        </form>
                        <!-- END Sign Up Form -->
                    </div>
                </div>
            </div>
            <!-- END Sign Up Block -->
        </div>
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
</div>
<!-- END Page Container -->
@endsection
