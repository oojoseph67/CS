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
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">PG Officer</h1>
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



        <div class="content">
            <!-- Block Tabs -->
            <h2 class="content-heading">Document Clearance</h2>
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
                                                    @if (DB::table('clearance_statuses')->where('fID', $detail->fID)->where('document', 'PENDING REVIEW')->exists())
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
                                                        <!-- Alternative Tabs in Modal -->
                                                        <div class="modal" id="modal-block-tabs-alternative" tabindex="-1" role="dialog" aria-labelledby="modal-block-tabs-alternative" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="block block-transparent bg-white mb-0">
                                                                        <div class="block-content tab-content">
                                                                            <h2 class="content-heading">Document</h2>
                                                                            <!-- Block Tabs Alternative Style -->
                                                                                <div class="block block-transparent bg-white mb-0">
                                                                                    <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                                                                        <li class="nav-item">
                                                                                            <a class="nav-link active" href="#btabs-alt-static-home">Document</a>
                                                                                        </li>
                                                                                        <li class="nav-item ml-auto">
                                                                                            <a class="nav-link" href="#btabs-alt-static-note"><i class="si si-note"></i></a>
                                                                                        </li>
                                                                                    </ul>
                                                                                    <div class="block-content tab-content">
                                                                                        <div class="tab-pane active" id="btabs-alt-static-home" role="tabpanel">
                                                                                            <!-- Text based -->
                                                                                            <div class="row gutters-tiny push">
                                                                                                @php
                                                                                                    $documents = DB::table('documents')->where(
                                                                                                        'fID', $detail->fID
                                                                                                    )->get();
                                                                                                @endphp 
                                                                                                @foreach ($documents as $document)
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo15.jpg');" target="_blank" href="#">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white">{{ $document->ol_card }}</div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">OL Card</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo15.jpg');" target="_blank" href="{{asset('documents/passport/'. $document->passport )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">Passport</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo11.jpg');" target="_blank" href="{{asset('documents/file/'. $document->admission_letter )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">Admission Letter</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->ol_certificate )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">OL Certificate</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->ufd_hnd_certificate )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">UFD/HND Certificate</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->rhd_diploma_certificate )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">RHD/Diploma Certificate</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->nysc_exemption_certificate )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">NYSC/Exemption Certificate</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->clearnce_certificate_fupre )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">Clearnce Certificate FUPRE</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->birth_certificate )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">Birth Certificate</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->state_of_origin_certificate )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">State Of Origin Certificate</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->marriage_certificate )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">Marriage Certificate</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->application_form )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">Application Form</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->transcript )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">Transcript</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                </div>
                                                                                                @endforeach
                                                                                            </div>
                                                                                            <!-- END Text based -->
                                                                                        </div>

                                                                                        <div class="tab-pane" id="btabs-alt-static-note" role="tabpanel">
                                                                                            <form action="{{ route('document-clearance') }}" method="post">
                                                                                                @csrf

                                                                                                <input type="hidden" name="fID" value="{{$detail->fID}}">
                                                                                                <input type="hidden" name="clearance_type" value="document">
                                                                                                <input type="hidden" name="first_name" value="{{$detail->first_name}}">
                                                                                                <input type="hidden" name="last_name" value="{{$detail->last_name}}">

                                                                                                <div class="row">
                                                                                                    <div class="col-4">
                                                                                                        <div class="form-group">
                                                                                                            <label>OL Card</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="ol_card" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="ol_card" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="form-group">
                                                                                                            <label>OL Certificate</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="ol_certificate" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="ol_certificate" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="form-group">
                                                                                                            <label>Transcript</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="transcript" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="transcript" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="form-group">
                                                                                                            <label>Passport</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="passport" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="passport" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>                                                                                                        
                                                                                                
                                                                                                    </div>
                                                                                                    
                                                                                                    <div class="col-4"> 
                                                                                                        <div class="form-group">
                                                                                                            <label>UFD/HND Certificate</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="ufd_hnd_certificate" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="ufd_hnd_certificate" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>                                                                                                        

                                                                                                        <div class="form-group">
                                                                                                            <label>RHD/Diploma Certificate</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="rhd_diploma_certificate" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="rhd_diploma_certificate" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="form-group">
                                                                                                            <label>NYSC/Exemption Certificate</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="nysc_exemption_certificate" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="nysc_exemption_certificate" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="form-group">
                                                                                                            <label>Clearnce Certificate FUPRE</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="clearnce_certificate_fupre" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="clearnce_certificate_fupre" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="form-group">
                                                                                                            <label>Birth Certificate</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="birth_certificate" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="birth_certificate" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="col-4">
                                                                                                        <div class="form-group">
                                                                                                            <label>Admission Letter</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="admission_letter" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="admission_letter" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="form-group">
                                                                                                            <label>State Of Origin Certificate</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="state_of_origin_certificate" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="state_of_origin_certificate" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="form-group">
                                                                                                            <label>Marriage Certificate</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="marriage_certificate" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="marriage_certificate" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="form-group">
                                                                                                            <label>Application Form</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="application_form" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="application_form" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                    </div>                                                                                                
                                                                                                </div>

                                                                                                <hr>

                                                                                                <div class="form-group">
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
                                                                                                    <textarea class="form-control form-control-alt" spellcheck="true" rows="7" name="recommendation" placeholder="Recommended Changes"></textarea>
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
                                                            </div>
                                                        </div>
                                                        <!-- END Alternative Tabs in Modal -->                                             
                                                    @endif
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
                                                    @if (DB::table('clearance_statuses')->where('fID', $detail->fID)->where('document', 'UPDATED')->exists())
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
                                                            <div class="block block-transparent bg-white mb-0">
                                                                <div class="block-content tab-content">
                                                                    <h2 class="content-heading">Document</h2>
                                                                    <!-- Block Tabs Alternative Style -->
                                                                        <div class="block block-transparent bg-white mb-0">
                                                                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link active" href="#btabs-alt-static-home">Document</a>
                                                                                </li>
                                                                                <li class="nav-item ml-auto">
                                                                                    <a class="nav-link" href="#btabs-alt-static-note"><i class="si si-note"></i></a>
                                                                                </li>
                                                                            </ul>
                                                                            <div class="block-content tab-content">
                                                                                <div class="tab-pane active" id="btabs-alt-static-home" role="tabpanel">
                                                                                    <!-- Text based -->
                                                                                    <div class="row gutters-tiny push">
                                                                                        @php
                                                                                            $documents = DB::table('documents')->where(
                                                                                                'fID', $detail->fID
                                                                                            )->get();

                                                                                            $doc_stats = DB::table('document_statuses')->where(
                                                                                                'fID', $detail->fID
                                                                                            )->get();
                                                                                        @endphp 
                                                                                        @foreach ($documents as $document)
                                                                                            @foreach ($doc_stats as $doc_stat)

                                                                                                @if ($doc_stat->ol_card == 'UPDATED')
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo15.jpg');" target="_blank" href="#">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white">{{ $document->ol_card }}</div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">OL Card</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>                                                                                   
                                                                                                </div>
                                                                                                @endif
                                                                                                @if ($doc_stat->passport == 'UPDATED')
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo15.jpg');" target="_blank" href="{{asset('documents/passport/'. $document->passport )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">Passport</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>                                                                                        
                                                                                                </div>
                                                                                                @endif 
                                                                                                @if ($doc_stat->admission_letter == 'UPDATED')
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo11.jpg');" target="_blank" href="{{asset('documents/file/'. $document->admission_letter )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">Admission Letter</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>                                                                                 
                                                                                                </div>
                                                                                                @endif    
                                                                                                @if ($doc_stat->ol_certificate == 'UPDATED')
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->ol_certificate )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">OL Certificate</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>                                                                                  
                                                                                                </div>
                                                                                                @endif 
                                                                                                @if ($doc_stat->ufd_hnd_certificate == 'UPDATED')
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->ufd_hnd_certificate )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">UFD/HND Certificate</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>                                                                                 
                                                                                                </div>   
                                                                                                @endif
                                                                                                @if ($doc_stat->rhd_diploma_certificate == 'UPDATED')
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->rhd_diploma_certificate )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">RHD/Diploma Certificate</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                </div> 
                                                                                                @endif
                                                                                                @if ($doc_stat->nysc_exemption_certificate == 'UPDATED')
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->nysc_exemption_certificate )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">NYSC/Exemption Certificate</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                </div>
                                                                                                @endif
                                                                                                @if ($doc_stat->clearnce_certificate_fupre == 'UPDATED')
                                                                                                <div class="col-4">                                                                                                
                                                                                                        <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->clearnce_certificate_fupre )}}">
                                                                                                            <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                                <div>
                                                                                                                    <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                    <div class="font-w600 mt-2 text-uppercase text-white-75">Clearnce Certificate FUPRE</div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </a>
                                                                                                </div>
                                                                                                @endif
                                                                                                @if ($doc_stat->birth_certificate == 'UPDATED')
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->birth_certificate )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">Birth Certificate</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                </div>
                                                                                                @endif
                                                                                                @if ($doc_stat->state_of_origin_certificate == 'UPDATED')
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->state_of_origin_certificate )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">State Of Origin Certificate</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                </div>
                                                                                                @endif
                                                                                                @if ($doc_stat->marriage_certificate == 'UPDATED')
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->marriage_certificate )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">Marriage Certificate</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>     
                                                                                                </div>
                                                                                                @endif 
                                                                                                @if ($doc_stat->application_form == 'UPDATED')
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->application_form )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">Application Form</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>                                                                                      
                                                                                                </div> 
                                                                                                @endif   
                                                                                                @if ($doc_stat->transcript == 'UPDATED')
                                                                                                <div class="col-4">
                                                                                                    <a class="block text-center bg-image" style="background-image: url('assets/media/photos/photo10.jpg');" target="_blank" href="{{asset('documents/file/'. $document->transcript )}}">
                                                                                                        <div class="block-content block-content-full bg-gd-dusk-op aspect-ratio-1-1 d-flex justify-content-center align-items-center">
                                                                                                            <div>
                                                                                                                <div class="font-size-h1 font-w300 text-white"></div>
                                                                                                                <div class="font-w600 mt-2 text-uppercase text-white-75">Transcript</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </a>                                                                                     
                                                                                                </div>
                                                                                                @endif 

                                                                                            @endforeach
                                                                                        @endforeach
                                                                                    </div>
                                                                                    <!-- END Text based -->
                                                                                </div>

                                                                                @foreach ($doc_stats as $doc_stat)
                                                                                    <div class="tab-pane" id="btabs-alt-static-note" role="tabpanel">
                                                                                        <form action="{{ route('document-clearance') }}" method="post">
                                                                                            @csrf

                                                                                            <input type="hidden" name="fID" value="{{$detail->fID}}">
                                                                                            <input type="hidden" name="clearance_type" value="document">
                                                                                            <input type="hidden" name="first_name" value="{{$detail->first_name}}">
                                                                                            <input type="hidden" name="last_name" value="{{$detail->last_name}}">

                                                                                            <div class="row">
                                                                                                <div class="col-4">
                                                                                                    @if ($doc_stat->ol_card == 'UPDATED')
                                                                                                        <div class="form-group">
                                                                                                            <label>OL Card</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="ol_card" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="ol_card" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @endif  

                                                                                                    @if ($doc_stat->ol_certificate == 'UPDATED')
                                                                                                        <div class="form-group">
                                                                                                            <label>OL Certificate</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="ol_certificate" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="ol_certificate" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @endif

                                                                                                    @if ($doc_stat->transcript == 'UPDATED')
                                                                                                        <div class="form-group">
                                                                                                            <label>Transcript</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="transcript" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="transcript" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @endif

                                                                                                    @if ($doc_stat->passport == 'UPDATED')
                                                                                                        <div class="form-group">
                                                                                                            <label>Passport</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="passport" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="passport" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>  
                                                                                                    @endif
                                                                                                </div>
                                                                                                
                                                                                                <div class="col-4"> 
                                                                                                    @if ($doc_stat->ufd_hnd_certificate == 'UPDATED')
                                                                                                        <div class="form-group">
                                                                                                            <label>UFD/HND Certificate</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="ufd_hnd_certificate" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="ufd_hnd_certificate" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>   
                                                                                                    @endif                                                                                                     

                                                                                                    @if ($doc_stat->rhd_diploma_certificate == 'UPDATED')
                                                                                                        <div class="form-group">
                                                                                                            <label>RHD/Diploma Certificate</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="rhd_diploma_certificate" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="rhd_diploma_certificate" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @endif

                                                                                                    @if ($doc_stat->nysc_exemption_certificate == 'UPDATED')
                                                                                                        <div class="form-group">
                                                                                                            <label>NYSC/Exemption Certificate</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="nysc_exemption_certificate" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="nysc_exemption_certificate" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>  
                                                                                                    @endif

                                                                                                    @if ($doc_stat->clearnce_certificate_fupre == 'UPDATED')
                                                                                                        <div class="form-group">
                                                                                                            <label>Clearnce Certificate FUPRE</label>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="clearnce_certificate_fupre" value="NOT APPROVED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                            </div>
                                                                                                            <div class="form-check">
                                                                                                                <input class="form-check-input" type="radio" name="clearnce_certificate_fupre" value="CLEARED" required>
                                                                                                                <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @endif

                                                                                                    @if ($doc_stat->birth_certificate == 'UPDATED')
                                                                                                    <div class="form-group">
                                                                                                        <label>Birth Certificate</label>
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="radio" name="birth_certificate" value="NOT APPROVED" required>
                                                                                                            <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                        </div>
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="radio" name="birth_certificate" value="CLEARED" required>
                                                                                                            <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    @endif
                                                                                                </div>

                                                                                                <div class="col-4">
                                                                                                    @if ($doc_stat->admission_letter == 'UPDATED')
                                                                                                    <div class="form-group">
                                                                                                        <label>Admission Letter</label>
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="radio" name="admission_letter" value="NOT APPROVED" required>
                                                                                                            <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                        </div>
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="radio" name="admission_letter" value="CLEARED" required>
                                                                                                            <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    @endif

                                                                                                    @if ($doc_stat->state_of_origin_certificate == 'UPDATED')
                                                                                                    <div class="form-group">
                                                                                                        <label>State Of Origin Certificate</label>
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="radio" name="state_of_origin_certificate" value="NOT APPROVED" required>
                                                                                                            <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                        </div>
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="radio" name="state_of_origin_certificate" value="CLEARED" required>
                                                                                                            <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    @endif

                                                                                                    @if ($doc_stat->marriage_certificate == 'UPDATED')
                                                                                                    <div class="form-group">
                                                                                                        <label>Marriage Certificate</label>
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="radio" name="marriage_certificate" value="NOT APPROVED" required>
                                                                                                            <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                        </div>
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="radio" name="marriage_certificate" value="CLEARED" required>
                                                                                                            <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    @endif

                                                                                                    @if ($doc_stat->application_form == 'UPDATED')
                                                                                                    <div class="form-group">
                                                                                                        <label>Application Form</label>
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="radio" name="application_form" value="NOT APPROVED" required>
                                                                                                            <label class="form-check-label" for="example-checkbox-default1">NOT APPROVED</label>
                                                                                                        </div>
                                                                                                        <div class="form-check">
                                                                                                            <input class="form-check-input" type="radio" name="application_form" value="CLEARED" required>
                                                                                                            <label class="form-check-label" for="example-checkbox-default2">CLEARED</label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    @endif
                                                                                                </div>                                                                                                
                                                                                            </div>

                                                                                            <hr>

                                                                                            <div class="form-group">
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
                                                                                                <textarea class="form-control form-control-alt" spellcheck="true" rows="7" name="recommendation" placeholder="Recommended Changes"></textarea>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <button type="submit" class="btn btn-block btn-hero-primary">
                                                                                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Submit
                                                                                                </button>
                                                                                            </div>
                                                                                        </form>                                                                                    
                                                                                    </div>
                                                                                @endforeach

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
@endsection
