@extends('exam_center.layouts.exam_center_main')

@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Candidate Details</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Candidate Details</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <!-- <a href="" class="btn btn-primary">Add New</a> -->
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs" role="tablist">
                    <li><a class="nav-link active" data-toggle="tab" href="#tab-1"> Physical Verification</a></li>
                    <li><a class="nav-link" data-toggle="tab" href="#tab-2">Biometric Verification</a></li>
                    <li><a class="nav-link" data-toggle="tab" href="#tab-3">Student Education</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Candidate Name:</th>
                                                    <td>{{ $data->user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Father Name:</th>
                                                    <td>{{ $data->user->father_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Registration No:</th>
                                                    <td>{{ $data->reg_number }}</td>
                                                </tr>
                                                <tr>
                                                    <th>CNIC Number:</th>
                                                    <td>{{ $data->user->cnic_number }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Exam:</th>
                                                    <td>{{ $data->timeslot->exam_calander->exam->exam_title }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Exam Date:</th>
                                                    <td>{{ $data->timeslot->exam_calander->exam_date->format('d-m-Y') }} ({{ $data->timeslot->name }})</td>
                                                </tr>
                                                <tr>
                                                    <th>Arrival:</th>
                                                    <td>{{ $data->arrived_at }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        @if(strlen($data->exam_password) == 0)
                                                        <a class="btn btn-primary" href="{{ route('generate-exam-credentials', ['id' => $data->id]) }}">
                                                            <i class="fa fa-check"></i> Mark Present
                                                        </a>
                                                        &nbsp;
                                                        @endif
                                                        <a class="btn btn-danger" target="_blank" href="{{ route('download-credentials-slip', ['id' => $data->id]) }}">
                                                            <i class="fa fa-check"></i> Print Exam Slip
                                                        </a>
                                                    </td>
                                                    <!-- <td></td> -->
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-3 text-center" id="cluster_info">
                                            <div class="student-profile-image">
                                                <img src="{{ $data->user->profile_picture_url }}" class=" m-b-md" alt="profile">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6 text-center user-image-col">
                                    <div class="student-profile-image-2">
                                        <img src="{{ $data->user->profile_picture_url }}" class=" m-b-md" alt="profile">
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex text-center">
                                    <form method="post" id="face-compare-form">
                                        <div id="camera-div">
                                            <div id="my_camera"></div>
                                            <br/>
                                            <button type="button" class="btn btn-primary" onClick="take_snapshot()">Take Snapshot</button>
                                        </div>
                                        <div id="result-div" style="display: none;">
                                            <div id="results"></div>
                                            <input type="hidden" name="candidate_reg_image" value="{{ $data->user->profile_picture_url }}">
                                            <input type="hidden" name="candidate_cam_image" id="candidate_cam_image">
                                            <br/>
                                            <button type="button" class="btn btn-primary" onClick="re_take_snapshot()">Re-Take Snapshot</button>
                                            <button type="button" class="btn btn-primary" onclick="verify()">Verify</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" id="tab-3" class="tab-pane">
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Degree / Certificate</th>
                                    <th>Institute / Board / University</th>
                                    <th>Roll No. / Reg# No.</th>
                                    <th>Total Marks</th>
                                    <th>Obtained Marks</th>
                                    <th>Grade</th>
                                    <th>Passing Year</th>
                                </tr>

                                @foreach ($education as $edu)
                                    <tr>
                                        <td>{{ $edu->academic_achievement }}</td>
                                        <td>{{ $edu->institute->name }}</td>
                                        <td>{{ $edu->roll_number }}</td>
                                        <td>{{ $edu->total_marks }}</td>
                                        <td>{{ $edu->obtain_marks }}</td>
                                        <td>{{ $edu->grade }}</td>
                                        <td>{{ $edu->passing_year }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@push('footer_scripts')
    <script src="{{ asset('assets/js/plugins/webcamjs/webcam.min.js') }}"></script>
    <script>
        $(document).ready(function () {

            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach( '#my_camera' );
        });
        
        function take_snapshot() {
            Webcam.snap( function(data_uri) {
                document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
                $('#candidate_cam_image').val(data_uri);
                $('#result-div').show();
                $('#camera-div').hide();
            });
        }

        function re_take_snapshot() {
            $('#result-div').hide();
            $('#camera-div').show();
        }

        function verify(){

            $.ajax({

                url: "{{ route('face-compare-verify') }}",
                type: "POST",
                data : $('#face-compare-form').serializeArray(),
                headers: {
                  'X-CSRF-Token': '{{ csrf_token() }}',
                },
                cache   : false,
                success : function(data){
                    swal("Verified!", "Confidence level" + data.confidence, "success");
                },
                error : function(){

                },
                beforeSend : function(){
                    showLoading();
                },
                complete   : function () {
                    hideLoading();
                }
            });
        }
    </script> 
@endpush
