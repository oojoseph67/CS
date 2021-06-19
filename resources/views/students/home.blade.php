@extends('layouts.backend-student')

@section('css_after')
    <link href="{{asset('libs/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('libs/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
@endsection


@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/dashmix.core.min.js') }}"></script>
    <script src="{{ asset('js/dashmix.app.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.maskedinput/jquery.maskedinput.min.js')}}"></script>

    <script src="{{asset('libs/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('libs/dropify/dropify.min.js')}}"></script>

    <script src="{{asset('js/pages/form-fileuploads.init.js')}}"></script>
    

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/be_forms_wizard.min.js') }}"></script>

    <script>jQuery(function(){Dashmix.helpers(['flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'rangeslider', 'masked-inputs', 'pw-strength']);});</script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
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
    </div>
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

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
        </div>


        <!-- Your Block -->
        <div class="block block-rounded" >
            <div class="block-header block-header-default center" >
                <h3 class="block-title"> Dashboard </h3>
            </div>
            <div class="block-content center">
                <!-- <p>Your content..</p> -->

                @if (Auth::user()->personal_form == 'NOTFILLLED')
                 <!-- Validation Wizards -->
                 <h2 class="content-heading">Student Information</h2>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <!-- Validation Wizard -->
                            <div class="js-wizard-validation block block block-rounded">
                                <!-- Step Tabs -->
                                <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#wizard-validation-step1" data-toggle="tab">1. Personal</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#wizard-validation-step2" data-toggle="tab">2. School Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#wizard-validation-step3" data-toggle="tab">3. Extra</a>
                                    </li>
                                </ul>
                                <!-- END Step Tabs -->

                                <!-- Form -->
                                <form class="js-wizard-validation-form" action="{{ route('personal-form') }}" method="POST">
                                    @csrf
                                    <!-- Steps Content -->
                                    <div class="block-content block-content-full tab-content" style="min-height: 290px;">

                                        <!-- Step 1 -->
                                        <input class="form-control" type="hidden" id="fID" name="fID" value="{{auth()->user()->fID}}">
                                        <input class="form-control" type="hidden" id="first_name" name="first_name" value="{{auth()->user()->first_name}}">
                                        <input class="form-control" type="hidden" id="last_name" name="last_name" value="{{auth()->user()->last_name}}">
                                        <input class="form-control" type="hidden" id="email" name="email" value="{{auth()->user()->email}}">
                                         
                                        <div class="tab-pane active" id="wizard-validation-step1" role="tabpanel">
                                            <div class="form-group">
                                                <label for="firstname">First Name</label>
                                                <input class="form-control" type="text" id="firstname" name="first_name" value="{{auth()->user()->first_name}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname">Last Name</label>
                                                <input class="form-control" type="text" id="lastname" name="last_name" value="{{auth()->user()->last_name}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input class="form-control" type="email" id="email" name="email" value="{{auth()->user()->email}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="gsm">GSM</label>
                                                <input type="text" class="js-masked-phone form-control" id="gsm" name="gsm" placeholder="(999) 999-9999" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="dob">Date Of Birth</label>
                                                <input class="form-control" type="date" id="dob" name="dob" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="place_of_birth">Place Of Birth</label>
                                                <input class="form-control" type="text" id="place_of_birth" name="place_of_birth" spellcheck="true" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="disability">Disability</label>
                                                <input class="form-control" type="text" id="disability" spellcheck="true" name="disability">
                                            </div>
                                            <div class="form-group">
                                                <label for="sex">Sex</label>
                                                <select class="form-control" id="sex" name="sex" required>
                                                    <option value="">-Choose Sex-</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <select class="form-control" id="title" name="title" required>
                                                    <option value="">-Choose Title-</option>
                                                    <option value="Mr.">Mr.</option>
                                                    <option value="Mrs.">Mrs.</option>
                                                    <option value="Miss">Miss</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="martial_status">Marital Status</label>
                                                <select class="form-control" id="martial_status" name="martial_status" required>
                                                    <option value="">-Choose Status-</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Divorced">Divorced</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Single">Single</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- END Step 1 -->


                                        <!-- Step 2 -->
                                        <div class="tab-pane" id="wizard-validation-step2" role="tabpanel">
                                            <div class="form-group">
                                                <label for="level_of_entry">Level Of Entry</label>
                                                <input class="form-control" type="text" id="level_of_entry" name="level_of_entry" placeholder="100L" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="mode_of_entry">Mode Of Entry</label>
                                                <select class="form-control" id="mode_of_entry" name="mode_of_entry" required>
                                                    <option value="">-Choose Mode Of Entry-</option>
                                                    <option value="Part Time">Online</option>
                                                    <option value="Full Time">Physical</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="mode_of_study">Mode Of Study</label>
                                                <select class="form-control" id="mode_of_study" name="mode_of_study" required>
                                                    <option value="">-Choose Mode Of Study-</option>
                                                    <option value="Part Time">Part Time</option>
                                                    <option value="Full Time">Full Time</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="college">College</label>
                                                <select class="form-control" id="college" name="college" id="college" required>
                                                    <option selected value="">-Choose College-</option>
                                                    <option value="Science">Science</option>
                                                    <option value="Technology">Technology</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Department</label>
                                                <input class="form-control" type="text" spellcheck="true" name="department" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="mat_no">Matric Number (For FUPRE UG Student))</label>
                                                <input class="form-control" type="text" name="mat_no">
                                            </div>
                                            <div class="form-group">
                                                <label for="programme_of_study">Programme Of Study</label>
                                                <!-- <input class="form-control" type="text" spellcheck="true" id="programme_of_study" name="programme_of_study" required> -->
                                                <select class="form-control" id="programme_of_study" name="programme_of_study" id="programme_of_study" required>
                                                    <option selected value="">-Choose A Programme-</option>
                                                    <option value="POSTGRADUATE DIPLOMA">POSTGRADUATE DIPLOMA</option>
                                                    <option value="MSC">MSC</option>
                                                    <option value="M.ENGG">M.ENGG</option>
                                                    <option value="PH.D">PH.D</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="year_of_entry"> Year of Entry </label>
                                                <input class="form-control" type="date" name="year_of_entry" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="year_of_graduation"> Expected Year Graudation </label>
                                                <input class="form-control" type="date" name="year_of_graduation" required>
                                            </div>

                                            <!-- <div class="form-group">
                                                <label for="department">Department</label>
                                                <select class="form-control" id="department" name="department" id="subdep" required>
                                                    <option value="">-Choose Department-</option>
                                                </select>
                                            </div> -->
                                        </div>
                                        <!-- END Step 2 -->

                                        <!-- Step 3 -->
                                        <div class="tab-pane" id="wizard-validation-step3" role="tabpanel">
                                            <div class="form-group">
                                                <label for="nationality">Nationality</label>
                                                <input class="form-control" type="text" spellcheck="true" name="nationality" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="state_of_origin">State Of Origin</label>
                                                <input class="form-control" type="text" spellcheck="true" name="state_of_origin" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="religion">Religion</label>
                                                <select class="form-control" id="religion" name="religion" required>
                                                    <option value="">Please select your religion</option>
                                                    <option value="Christainity">Christainity</option>
                                                    <option value="Muslism">Muslism</option>
                                                    <option value="Pegan">Pegan</option>
                                                    <option value="Pefer Not To Say">Pefer Not To Say</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="language">Language</label>
                                                <input class="form-control" type="text" spellcheck="true" name="language" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name_of_guarrantor">Name Of Guarrantor</label>
                                                <input class="form-control" type="text" spellcheck="true" name="name_of_guarrantor" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="address_of_guarrantor">Address Of Guarrantor</label>
                                                <input class="form-control" type="text" spellcheck="true" name="address_of_guarrantor" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="gsm_of_guarrantor">GSM Of Guarrantor</label>
                                                <input class="form-control" type="text" spellcheck="true" name="gsm_of_guarrantor" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="resident_address">Resident Address</label>
                                                <input class="form-control" type="text" spellcheck="true" name="resident_address" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="private_address">Private Address</label>
                                                <input class="form-control" type="text" spellcheck="true" name="private_address" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="permmanent_address">Permmanent Address</label>
                                                <input class="form-control" type="text" spellcheck="true" name="permmanent_address" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="sponsor_name">Sponsor Name</label>
                                                <input class="form-control" type="text" spellcheck="true" name="sponsor_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="sponsor_address">Sponsor Address</label>
                                                <input class="form-control" type="text" spellcheck="true" name="sponsor_address" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="sponsor_gsm">Sponsor GSM</label>
                                                <input class="form-control" type="text" spellcheck="true" name="sponsor_gsm" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name_of_next_of_kin">Name Of Next Of Kin</label>
                                                <input class="form-control" type="text" spellcheck="true" name="name_of_next_of_kin" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="address_of_next_of_kin">Address Of Next Of Kin</label>
                                                <input class="form-control" type="text" spellcheck="true" name="address_of_next_of_kin" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="gsm_of_next_of_kin">GSM Of Next Of Kin</label>
                                                <input type="text" class="js-masked-phone form-control" id="gsm_of_next_of_kin" name="gsm_of_next_of_kin" placeholder="(999) 999-9999" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email_of_next_of_kin">Email Of Next Of Kin</label>
                                                <input class="form-control" type="email" name="email_of_next_of_kin" required>
                                            </div>
                                        </div>
                                        <!-- END Step 3 -->
                                    </div>
                                    <!-- END Steps Content -->

                                    <!-- Steps Navigation -->
                                    <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" class="btn btn-secondary" data-wizard="prev">
                                                    <i class="fa fa-angle-left mr-1"></i> Previous
                                                </button>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button type="button" class="btn btn-secondary" data-wizard="next">
                                                    Next <i class="fa fa-angle-right ml-1"></i>
                                                </button>
                                                <button type="submit" class="btn btn-primary d-none" data-wizard="finish">
                                                    <i class="fa fa-check mr-1"></i> Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Steps Navigation -->
                                </form>
                                <!-- END Form -->
                            </div>
                            <!-- END Validation Wizard Classic -->
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                <!-- END Validation Wizards -->
                @elseif (Auth::user()->documents == 'NOTSUBMITTED')
                <!-- END Upload Document -->
                    <h2 class="content-heading">Document Upload</h2>
                    <form action="{{ route('document') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input class="form-control" type="hidden" id="fID" name="fID" value="{{auth()->user()->fID}}">
                        <input class="form-control" type="hidden" id="first_name" name="first_name" value="{{auth()->user()->first_name}}">
                        <input class="form-control" type="hidden" id="last_name" name="last_name" value="{{auth()->user()->last_name}}">
                        <input class="form-control" type="hidden" id="email" name="email" value="{{auth()->user()->email}}">


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="o/l_certificate">O/l Certificate</label>
                                    <input type="file" data-plugins="dropify" name="o/l_certificate" required>                           
                                </div>
                                <div class="form-group">
                                    <label for="nysc/exemption_certificate">Relevant Higher Degree/Diploma Certificate</label>
                                    <input type="file" data-plugins="dropify" name="nysc/exemption_certificate" required>                           
                                </div>
                                <div class="form-group">
                                    <label for="birth_certificate">Birth Certificate</label>
                                    <input type="file" data-plugins="dropify" name="birth_certificate" required>                           
                                </div>
                                 <div class="form-group">
                                    <label for="rhd/diploma_certificate">rhd/diploma_certificate</label>
                                    <input type="file" data-plugins="dropify" name="rhd/diploma_certificate" required>                           
                                </div>
                                <div class="form-group">
                                    <label for="application_form">Copy Of The Online Application Form</label>
                                    <input type="file" data-plugins="dropify" name="application_form" required>                           
                                </div>
                                <div class="form-group">
                                    <label for="state_of_origin_certificate">State Of Origin Certificate</label>
                                    <input type="file" data-plugins="dropify" name="state_of_origin_certificate" required>                           
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="o/l_card">O/l Card</label>
                                    <input type="input" name="o/l_card" required>                           
                                </div>                           
                                <div class="form-group">
                                    <label for="nysc/exemption_certificate">NYSC Discharge/Exemption Certificate</label>
                                    <input type="file" data-plugins="dropify" name="nysc/exemption_certificate" required>                           
                                </div>
                                <div class="form-group">
                                    <label for="marriage_certificate">Marriage Certificate</label>
                                    <input type="file" data-plugins="dropify" name="marriage_certificate">                           
                                </div>
                                <div class="form-group">
                                    <label for="transcript">Transcript</label>
                                    <input type="file" data-plugins="dropify" name="transcript" required>                           
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ufd/hnd_certificate">University First Degrees/HND Certificate</label>
                                    <input type="file" data-plugins="dropify" name="ufd/hnd_certificate" required>                           
                                </div>                            
                                <div class="form-group">
                                    <label for="clearnce_certificate_fupre">O/L Clearnce Certificate <b>FUPRE STUDENTS</b></label>
                                    <input type="file" data-plugins="dropify" name="clearnce_certificate_fupre">                           
                                </div>
                                <div class="form-group">
                                    <label for="admission_letter">Letter Of Admissionn</label>
                                    <input type="file" data-plugins="dropify" name="admission_letter" required>                           
                                </div>
                                <div class="form-group">
                                    <label for="passport">passport</label>
                                    <input type="file" data-plugins="dropify" name="passport" required>                           
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-hero-primary">
                                <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Submit
                            </button>
                        </div>

                    </form> 
                <!-- END Upload Document -->
                @elseif (Auth::user()->preliminary_form == 'NOTFILLLED')
                <!-- Form Wizards -->
                    @foreach ($details as $detail)    
                    <h2 class="content-heading">Preliminary Student Registration Form</h2>
                    <div class="row">
                        @foreach ($documents as $document)    
                        <div class="col-md-3">
                            <!-- <img class="img-fluid" src="{{ asset('storage/app/public/documents/img/'. Auth::user()->profile_picture) }}"> -->
                            <img src="{{asset('documents/passport/'. $document->passport )}}" alt="Profile" width="500" height="600">
                        </div>
                        @endforeach
                        <div class="col-md-2">
                            
                        </div>
                        <div class="col-md-7">
                            <!-- Validation Wizard -->
                            <div class="js-wizard-validation block block block-rounded">
                                <!-- Step Tabs -->
                                <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#wizard-validation-step1" data-toggle="tab">1. Personal Data</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#wizard-validation-step2" data-toggle="tab">2. Parents/Sponsor(S) Data</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#wizard-validation-step3" data-toggle="tab">3. Programme</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#wizard-validation-step4" data-toggle="tab">4. Other Relevant Data</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#wizard-validation-step5" data-toggle="tab">5. Certification</a>
                                    </li>
                                </ul>
                                <!-- END Step Tabs -->

                                <!-- Form -->
                                <form class="js-wizard-validation-form" action="{{ route('preliminary-form') }}" method="POST">
                                    @csrf
                                    <!-- Steps Content -->
                                    <div class="block-content block-content-full tab-content" style="min-height: 290px;">

                                        <!-- Step 1 -->
                                        <input class="form-control" type="hidden" id="fID" name="fID" value="{{auth()->user()->fID}}">
                                        <input class="form-control" type="hidden" id="first_name" name="first_name" value="{{auth()->user()->first_name}}">
                                        <input class="form-control" type="hidden" id="last_name" name="last_name" value="{{auth()->user()->last_name}}">
                                        <input class="form-control" type="hidden" id="email" name="email" value="{{auth()->user()->email}}">
                                         
                                        <div class="tab-pane active" id="wizard-validation-step1" role="tabpanel">
                                            <div class="form-group">
                                                <label for="session">Session</label>
                                                <input class="form-control" type="text" id="session" name="session" value="2020/2021" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="date">Date</label>
                                                <input class="form-control" type="text" id="date" name="date" value="Today" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="firstname">First Name</label>
                                                <input class="form-control" type="text" id="firstname" name="first_name" value="{{auth()->user()->first_name}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname">Last Name</label>
                                                <input class="form-control" type="text" id="lastname" name="last_name" value="{{auth()->user()->last_name}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input class="form-control" type="text" id="email" name="last_name" value="{{auth()->user()->email}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="gsm">GSM</label>
                                                <input class="form-control" type="text" id="gsm" name="last_name" value="{{$detail->gsm}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="sex">Sex</label>
                                                <input class="form-control" type="text" id="sex" name="sex" value="{{$detail->sex}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="dob">Date Of Birth</label>
                                                <input class="form-control" type="text" id="dob" name="dob" value="{{$detail->dob}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="place_of_birth">Place Of Birth</label>
                                                <input class="form-control" type="text" id="place_of_birth" name="place_of_birth" value="{{$detail->place_of_birth}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="state_of_origin">State Of Origin</label>
                                                <input class="form-control" type="text" id="state_of_origin" name="state_of_origin" value="{{$detail->state_of_origin}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="lga">LGA</label>
                                                <input class="form-control" type="text" id="lga" name="lga"required>
                                            </div>
                                            <div class="form-group">
                                                <label for="martial_status">Martial Status</label>
                                                <input class="form-control" type="text" id="martial_status" name="martial_status" value="{{$detail->martial_status}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="nationality">Nationality</label>
                                                <input class="form-control" type="text" id="nationality" name="nationality" value="{{$detail->nationality}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="religion">Religion</label>
                                                <input class="form-control" type="text" id="religion" name="religion" value="{{$detail->religion}}" disabled>
                                            </div>
                                            <!-- END Step 1 -->
                                        </div>
                                        <!-- Step 2 -->
                                        <div class="tab-pane" id="wizard-validation-step2" role="tabpanel">
                                            <div class="form-group">
                                                <label for="parent_name">Parent Name</label>
                                                <input class="form-control" type="text" id="parent_name" name="parent_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="parent_address">Parent Address</label>
                                                <input class="form-control" type="text" id="parent_address" name="parent_address" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="sponsor_name">Sponsor Name</label>
                                                <input class="form-control" type="text" id="sponsor_name" name="sponsor_name" value="{{$detail->sponsor_name}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="sponsor_address">Sponsor Address</label>
                                                <input class="form-control" type="text" id="sponsor_address" name="sponsor_address" value="{{$detail->sponsor_address}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="sponsor_gsm">Sponsor GSM</label>
                                                <input class="form-control" type="text" id="sponsor_gsm" name="sponsor_gsm" value="{{$detail->sponsor_gsm}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="employer_name">Employer Name</label>
                                                <input class="form-control" type="text" id="employer_name" name="employer_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="employer_address">Employer Address</label>
                                                <input class="form-control" type="text" id="employer_address" name="employer_address" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="employer_gsm">Employer GSM</label>
                                                <input class="form-control" type="text" id="employer_gsm" name="employer_gsm" required>
                                            </div>
                                        </div>
                                        <!-- END Step 2 -->

                                        <!-- Step 3 -->
                                        <div class="tab-pane" id="wizard-validation-step3" role="tabpanel">
                                            <div class="form-group">
                                                <label for="programme_of_study">Programme Of Study</label>
                                                <input class="form-control" type="text" id="programme_of_study" name="programme_of_study" value="{{$detail->programme_of_study}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="dept">Department</label>
                                                <input class="form-control" type="text" id="dept" name="dept" value="{{$detail->dept}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="mat_no">Matric Number</label>
                                                <input class="form-control" type="text" id="mat_no" name="mat_no" value="{{$detail->mat_no}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="session">Session Admitted</label>
                                                <input class="form-control" type="text" id="session" name="session" value="2020/2021" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="session">Current Session</label>
                                                <input class="form-control" type="text" id="session" name="session" value="2020/2021" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="mode_of_study">Mode Of Study</label>
                                                <input class="form-control" type="text" id="mode_of_study" name="mode_of_study" value="{{$detail->mode_of_study}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="expected_graduation_year">Expected Graduation Year</label>
                                                <input class="form-control" type="text" id="expected_graduation_year" name="expected_graduation_year" value="{{$detail->expected_graduation_year}}" disabled>
                                            </div>
                                        </div>
                                        <!-- END Step 3 -->

                                        <!-- START Step 4 -->
                                        <div class="tab-pane" id="wizard-validation-step4" role="tabpanel">
                                            <div class="form-group">
                                                <label for="resident_address">Residential Address</label>
                                                <input class="form-control" type="text" id="resident_address" name="resident_address" value="{{$detail->resident_address}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="landlord_name">Landlord Name </label>
                                                <input class="form-control" type="text" id="landlord_name" name="landlord_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="landlord_address">Landlord Address</label>
                                                <input class="form-control" type="text" id="landlord_address" name="landlord_address" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="landlord_gsm">Landlord GSM</label>
                                                <input class="form-control" type="text" id="landlord_gsm" name="landlord_gsm" required>
                                            </div>
                                        </div>
                                        <!-- END Step 4 -->

                                        <!-- START Step 5 -->
                                        <div class="tab-pane" id="wizard-validation-step5" role="tabpanel">
                                            <h2>
                                                I <u><strong>  {{ auth()->user()->first_name }}  {{ auth()->user()->last_name }} </strong></u> DO HEREBY CERIFT THAT THE INFORMATION WHICH I HAVE GIVEN ABOVE IS CORRECT
                                            </h2>
                                        </div> 
                                        <!-- END Step 5 -->
                                    </div>
                                    <!-- END Steps Content -->

                                    <!-- Steps Navigation -->
                                    <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" class="btn btn-secondary" data-wizard="prev">
                                                    <i class="fa fa-angle-left mr-1"></i> Previous
                                                </button>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button type="button" class="btn btn-secondary" data-wizard="next">
                                                    Next <i class="fa fa-angle-right ml-1"></i>
                                                </button>
                                                <button type="submit" class="btn btn-primary d-none" data-wizard="finish">
                                                    <i class="fa fa-check mr-1"></i> Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Steps Navigation -->
                                </form>
                                <!-- END Form -->
                            </div>
                            <!-- END Validation Wizard Classic -->
                        </div>
                        
                    </div>
                    @endforeach
                <!-- END Form Wizards -->
                @endif



                    


            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection
