@extends('layouts.simple2')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

    <link href="{{asset('libs/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('libs/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>

    <script src="{{asset('libs/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('libs/dropify/dropify.min.js')}}"></script>

    <script src="{{asset('js/pages/form-fileuploads.init.js')}}"></script>

    <script src="{{asset('js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js')}}"></script>
    <script src="{{asset('js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/plugins/jquery-validation/additional-methods.js')}}"></script>


    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/be_forms_wizard.min.js') }}"></script>

    <script>jQuery(function(){Dashmix.helpers(['flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'rangeslider', 'masked-inputs', 'pw-strength']);});</script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">HOD</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">PG</li>
                        <li class="breadcrumb-item active" aria-current="page">Clearance System</li>
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
        </div>


        <!-- Your Block -->
        {{-- <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Dashboard</h3>
            </div>
            <div class="block-content">                
                <p>Your content..</p>
            </div>
        </div> --}}
        <!-- END Your Block -->


        <div class="content">
        <!-- Block Tabs -->
            <h2 class="content-heading">Block Tabs</h2>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Block Tabs Default Style -->
                    <div class="block block-rounded">
                        <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#btabs-static-home">NOT REVIEWD</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#btabs-static-profile">PENDING UPDATE</a>
                            </li>
                            {{-- <li class="nav-item ml-auto">
                                <a class="nav-link" href="#btabs-static-settings">
                                    <i class="si si-settings"></i>
                                </a>
                            </li> --}}
                        </ul>
                        <div class="block-content tab-content">
                            <div class="tab-pane active" id="btabs-static-home" role="tabpanel">               
                                <!-- Dynamic Table Full -->
                                <div class="block block-rounded">
                                    <div class="block-header block-header-default">
                                        <h3 class="block-title">Pending Clearance</h3>
                                    </div>
                                    <div class="block-content block-content-full">
                                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 80px;">#</th>
                                                    <th class="text-center" style="width: 100px;">
                                                        <i class="far fa-user"></i>
                                                    </th>
                                                    <th>Name</th>
                                                    <th class="d-none d-sm-table-cell" style="width: 30%;">Diploma In View</th>
                                                    <th style="width: 15%;">View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($details as $detail) 
                                                    @if (DB::table('clearance_statuses')->where('fID', $detail->fID)->where('preliminary_form', 'PENDING REVIEW')->exists())
                                                        <tr>
                                                            <?php $count=1; ?>
                                                                <td class="text-center"><?php echo $count; ?></td>
                                                            <?php $count++; ?>
                                                            @php
                                                                $documents = DB::table('documents')->where(
                                                                    'fID', $detail->fID
                                                                )->get();
                                                            @endphp
                                                            @foreach ($documents as $document) 
                                                                <td class="text-center">
                                                                    <img class="img-avatar img-avatar48" src="{{asset('documents/passport/'. $document->passport )}}"  alt="">
                                                                </td>
                                                            @endforeach
                                                            <td class="font-w600">
                                                                <a href="javascript:void(0)">{{$detail->first_name}} {{$detail->last_name}}</a>
                                                            </td>
                                                            <td class="d-none d-sm-table-cell">
                                                                {{$detail->programme_of_study}}
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary push" data-toggle="modal" data-target="#modal-block-tabs-alternative">View</button>
                                                                {{-- <em class="text-muted">{{ rand(2, 10) }} days ago</em> --}}
                                                            </td>
                                                        </tr>                                                    
                                                    @endif
                                                    
                                                
                                                <!-- Alternative Tabs in Modal -->
                                                <div class="modal" id="modal-block-tabs-alternative" tabindex="-1" role="dialog" aria-labelledby="modal-block-tabs-alternative" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <!-- Block Tabs Alternative Style -->
                                                            <div class="block block-transparent bg-white mb-0">
                                                                <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" href="#btabs-alt-static-home">User Data</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#btabs-alt-static-parents">Parents/Sponsor(S) Data</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#btabs-alt-static-programme">Programme</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#btabs-alt-static-other_data">Other Relevant Data</a>
                                                                    </li>
                                                                    <li class="nav-item ml-auto">
                                                                        <a class="nav-link" href="#btabs-alt-static-note"><i class="si si-note"></i></a>
                                                                    </li>
                                                                </ul>
                                                                <div class="block-content tab-content">
                                                                    <div class="tab-pane active" id="btabs-alt-static-home" role="tabpanel">
                                                                        <div class="form-group">
                                                                            <label for="session">Session</label>
                                                                            <input class="form-control" type="text" id="session" name="session" value="2020/2021" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="firstname">First Name</label>
                                                                            <input class="form-control" type="text" id="firstname" name="first_name" value="{{$detail->first_name}}" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="lastname">Last Name</label>
                                                                            <input class="form-control" type="text" id="lastname" name="last_name" value="{{$detail->last_name}}" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="email">Email</label>
                                                                            <input class="form-control" type="text" id="email" name="last_name" value="{{$detail->email}}" disabled>
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
                                                                            <input class="form-control" type="text" id="lga" name="lga" value="{{$detail->lga}}" disabled>
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
                                                                        <div class="form-group">
                                                                            <label for="health_challenges">Health Challenges</label>
                                                                            <input class="form-control" type="text" id="health_challenges" value="{{$detail->health_challenges}}" name="health_challenges" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="tab-pane" id="btabs-alt-static-parents" role="tabpanel">
                                                                        <div class="form-group">
                                                                            <label for="parent_name">Parent Name</label>
                                                                            <input class="form-control" type="text" id="parent_name" spellcheck="true" value="{{$detail->parent_name}}"  name="parent_name" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="parent_address">Parent Address</label>
                                                                            <input class="form-control" type="text" id="parent_address" spellcheck="true" value="{{$detail->parent_address}}"  name="parent_address" disabled>
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
                                                                            <input class="form-control" type="text" id="employer_name" spellcheck="true" value="{{$detail->employer_name}}" name="employer_name" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="employer_address">Employer Address</label>
                                                                            <input class="form-control" type="text" id="employer_address" spellcheck="true" value="{{$detail->employer_address}}" name="employer_address" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="employer_gsm">Employer GSM</label>
                                                                            <input type="text" class="js-masked-phone form-control" id="employer_gsm" name="employer_gsm" value="{{$detail->employer_gsm}}" placeholder="(999) 999-9999" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="tab-pane" id="btabs-alt-static-programme" role="tabpanel">
                                                                        <div class="form-group">
                                                                            <label for="programme_of_study">Programme Of Study</label>
                                                                            <input class="form-control" type="text" id="programme_of_study" name="programme_of_study" value="{{$detail->programme_of_study}}" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="college">College</label>
                                                                            <input class="form-control" type="text" id="college" name="college" value="{{$detail->college}}" disabled>
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
                                                                            <label for="year_of_entry"> Year of Entry </label>
                                                                            <input class="form-control" type="date" name="year_of_entry" value="{{$detail->year_of_entry}}"  disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="expected_graduation_year">Expected Graduation Year</label>
                                                                            <input class="form-control" type="text" id="expected_graduation_year" name="expected_graduation_year" value="{{$detail->expected_graduation_year}}" disabled>                                          
                                                                        </div>
                                                                    </div>

                                                                    <div class="tab-pane" id="btabs-alt-static-other_data" role="tabpanel">
                                                                        <div class="form-group">
                                                                            <label for="resident_address">Residential Address</label>
                                                                            <input class="form-control" type="text" id="resident_address" name="resident_address" value="{{$detail->resident_address}}" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="landlord_name">Landlord Name </label>
                                                                            <input class="form-control" type="text" id="landlord_name" spellcheck="true" value="{{$detail->landlord_name}}"  name="landlord_name" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="landlord_address">Landlord Address</label>
                                                                            <input class="form-control" type="text" id="landlord_address" spellcheck="true" value="{{$detail->landlord_address}}"  name="landlord_address" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="landlord_gsm">Landlord GSM</label>
                                                                            <input type="text" class="js-masked-phone form-control" id="landlord_gsm" value="{{$detail->landlord_gsm}}"  name="landlord_gsm" placeholder="(999) 999-9999" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="tab-pane" id="btabs-alt-static-note" role="tabpanel">
                                                                        <form action="{{ route('clearance-status') }}" method="post">
                                                                            @csrf
                                                                            <div class="form-group">

                                                                                <input type="hidden" name="fID" value="{{$detail->fID}}">
                                                                                <input type="hidden" name="clearance_type" value="preliminary_form">
                                                                                <input type="hidden" name="first_name" value="{{$detail->first_name}}">
                                                                                <input type="hidden" name="last_name" value="{{$detail->last_name}}">

                                                                                <label>Clearance Status</label>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="clearance_status" value="NOT APPROVED" required>
                                                                                    <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="clearance_status" value="CLEARED" required>
                                                                                    <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="note">Recommended Changes</label>
                                                                                <textarea class="form-control form-control-alt" rows="7" name="recommendation" placeholder="Recommended Changes"></textarea>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <button type="submit" class="btn btn-block btn-hero-primary">
                                                                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Submit
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="block-content block-content-full text-right bg-light">
                                                                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                                                                    {{-- <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Done</button> --}}
                                                                </div>
                                                            </div>
                                                            <!-- END Block Tabs Alternative Style -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END Alternative Tabs in Modal -->
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END Dynamic Table Full -->
                            </div>

                            <div class="tab-pane" id="btabs-static-profile" role="tabpanel">
                               <!-- Dynamic Table Full -->
                                <div class="block block-rounded">
                                    <div class="block-header block-header-default">
                                        <h3 class="block-title">Updated Clearance</h3>
                                    </div>
                                    <div class="block-content block-content-full">
                                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 80px;">#</th>
                                                    <th class="text-center" style="width: 100px;">
                                                        <i class="far fa-user"></i>
                                                    </th>
                                                    <th>Name</th>
                                                    <th class="d-none d-sm-table-cell" style="width: 30%;">Diploma In View</th>
                                                    <th style="width: 15%;">View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($details as $detail) 
                                                    @if (DB::table('clearance_statuses')->where('fID', $detail->fID)->where('preliminary_form', 'UPDATED')->exists())
                                                        <tr>
                                                            <?php $count=1; ?>
                                                                <td class="text-center"><?php echo $count; ?></td>
                                                            <?php $count++; ?>
                                                            @php
                                                                $documents = DB::table('documents')->where(
                                                                    'fID', $detail->fID
                                                                )->get();
                                                            @endphp
                                                            @foreach ($documents as $document) 
                                                                <td class="text-center">
                                                                    <img class="img-avatar img-avatar48" src="{{asset('documents/passport/'. $document->passport )}}"  alt="">
                                                                </td>
                                                            @endforeach
                                                            <td class="font-w600">
                                                                <a href="javascript:void(0)">{{$detail->first_name}} {{$detail->last_name}}</a>
                                                            </td>
                                                            <td class="d-none d-sm-table-cell">
                                                                {{$detail->programme_of_study}}
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary push" data-toggle="modal" data-target="#modal-block-tabs-alternative-2">View</button>
                                                                {{-- <em class="text-muted">{{ rand(2, 10) }} days ago</em> --}}
                                                            </td>
                                                        </tr>                                                    
                                                    @endif
                                                    
                                                
                                                <!-- Alternative Tabs in Modal -->
                                                <div class="modal" id="modal-block-tabs-alternative-2" tabindex="-1" role="dialog" aria-labelledby="modal-block-tabs-alternative-2" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <!-- Block Tabs Alternative Style -->
                                                            <div class="block block-transparent bg-white mb-0">
                                                                <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" href="#btabs-alt-static-home-2">User Data</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#btabs-alt-static-parents-2">Parents/Sponsor(S) Data</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#btabs-alt-static-programme-2">Programme</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#btabs-alt-static-other_data-2">Other Relevant Data</a>
                                                                    </li>
                                                                    <li class="nav-item ml-auto">
                                                                        <a class="nav-link" href="#btabs-alt-static-note-2"><i class="si si-note"></i></a>
                                                                    </li>
                                                                </ul>
                                                                <div class="block-content tab-content">
                                                                    <div class="tab-pane active" id="btabs-alt-static-home-2" role="tabpanel">
                                                                        <div class="form-group">
                                                                            <label for="session">Session</label>
                                                                            <input class="form-control" type="text" id="session" name="session" value="2020/2021" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="firstname">First Name</label>
                                                                            <input class="form-control" type="text" id="firstname" name="first_name" value="{{$detail->first_name}}" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="lastname">Last Name</label>
                                                                            <input class="form-control" type="text" id="lastname" name="last_name" value="{{$detail->last_name}}" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="email">Email</label>
                                                                            <input class="form-control" type="text" id="email" name="last_name" value="{{$detail->email}}" disabled>
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
                                                                            <input class="form-control" type="text" id="lga" name="lga" value="{{$detail->lga}}" disabled>
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
                                                                        <div class="form-group">
                                                                            <label for="health_challenges">Health Challenges</label>
                                                                            <input class="form-control" type="text" id="health_challenges" value="{{$detail->health_challenges}}" name="health_challenges" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="tab-pane" id="btabs-alt-static-parents-2" role="tabpanel">
                                                                        <div class="form-group">
                                                                            <label for="parent_name">Parent Name</label>
                                                                            <input class="form-control" type="text" id="parent_name" spellcheck="true" value="{{$detail->parent_name}}"  name="parent_name" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="parent_address">Parent Address</label>
                                                                            <input class="form-control" type="text" id="parent_address" spellcheck="true" value="{{$detail->parent_address}}"  name="parent_address" disabled>
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
                                                                            <input class="form-control" type="text" id="employer_name" spellcheck="true" value="{{$detail->employer_name}}" name="employer_name" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="employer_address">Employer Address</label>
                                                                            <input class="form-control" type="text" id="employer_address" spellcheck="true" value="{{$detail->employer_address}}" name="employer_address" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="employer_gsm">Employer GSM</label>
                                                                            <input type="text" class="js-masked-phone form-control" id="employer_gsm" name="employer_gsm" value="{{$detail->employer_gsm}}" placeholder="(999) 999-9999" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="tab-pane" id="btabs-alt-static-programme-2" role="tabpanel">
                                                                        <div class="form-group">
                                                                            <label for="programme_of_study">Programme Of Study</label>
                                                                            <input class="form-control" type="text" id="programme_of_study" name="programme_of_study" value="{{$detail->programme_of_study}}" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="college">College</label>
                                                                            <input class="form-control" type="text" id="college" name="college" value="{{$detail->college}}" disabled>
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
                                                                            <label for="year_of_entry"> Year of Entry </label>
                                                                            <input class="form-control" type="date" name="year_of_entry" value="{{$detail->year_of_entry}}"  disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="expected_graduation_year">Expected Graduation Year</label>
                                                                            <input class="form-control" type="text" id="expected_graduation_year" name="expected_graduation_year" value="{{$detail->expected_graduation_year}}" disabled>                                          
                                                                        </div>
                                                                    </div>

                                                                    <div class="tab-pane" id="btabs-alt-static-other_data-2" role="tabpanel">
                                                                        <div class="form-group">
                                                                            <label for="resident_address">Residential Address</label>
                                                                            <input class="form-control" type="text" id="resident_address" name="resident_address" value="{{$detail->resident_address}}" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="landlord_name">Landlord Name </label>
                                                                            <input class="form-control" type="text" id="landlord_name" spellcheck="true" value="{{$detail->landlord_name}}"  name="landlord_name" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="landlord_address">Landlord Address</label>
                                                                            <input class="form-control" type="text" id="landlord_address" spellcheck="true" value="{{$detail->landlord_address}}"  name="landlord_address" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="landlord_gsm">Landlord GSM</label>
                                                                            <input type="text" class="js-masked-phone form-control" id="landlord_gsm" value="{{$detail->landlord_gsm}}"  name="landlord_gsm" placeholder="(999) 999-9999" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="tab-pane" id="btabs-alt-static-note-2" role="tabpanel">
                                                                        <form action="{{ route('clearance-status') }}" method="post">
                                                                            @csrf
                                                                            <div class="form-group">

                                                                                <input type="hidden" name="fID" value="{{$detail->fID}}">
                                                                                <input type="hidden" name="first_name" value="{{$detail->first_name}}">
                                                                                <input type="hidden" name="last_name" value="{{$detail->last_name}}">

                                                                                <label>Clearance Status</label>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="clearance_status" value="NOT APPROVED" required>
                                                                                    <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="clearance_status" value="CLEARED" required>
                                                                                    <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="note">Recommended Changes</label>
                                                                                <textarea class="form-control form-control-alt" id="note" name="note" rows="7" name="recommendation" placeholder="Recommended Changes"></textarea>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <button type="submit" class="btn btn-block btn-hero-primary">
                                                                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Submit
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="block-content block-content-full text-right bg-light">
                                                                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                                                                    {{-- <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Done</button> --}}
                                                                </div>
                                                            </div>
                                                            <!-- END Block Tabs Alternative Style -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END Alternative Tabs in Modal -->
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END Dynamic Table Full -->
                            </div>


                            {{-- <div class="tab-pane" id="btabs-static-settings" role="tabpanel">
                                <h4 class="font-w400">Settings Content</h4>
                                <p>...</p>
                            </div> --}}
                        </div>
                    </div>
                    <!-- END Block Tabs Default Style -->
                </div>
            </div>
        </div>



    </div>
    <!-- END Page Content -->
@endsection
