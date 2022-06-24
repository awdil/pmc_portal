@extends('candidate.layouts.candidate_main')

@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Upload students documents</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Upload students documents</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Upload Student Documents</h5>
                </div>
                <div class="ibox-content">
                    <form enctype='multipart/form-data' role="form" id="add_student_docs_form" action="{{ route('update-education-files') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="1">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Degree / Certificate <span class="text-danger">*</span></label> 
                                    <select name="academic_achievement" id="academic_achievement" class="form-control @error('academic_achievement') is-invalid @enderror"  aria-required="true">
                                        <option {{ old('academic_achievement') == '' ? 'selected' : '' }} value="">Please Select </option>
                                        <option {{ old('academic_achievement') == 'masters' ? 'selected' : '' }} value="masters">Masters</option>
                                        <option {{ old('academic_achievement') == 'bachelors' ? 'selected' : '' }} value="bachelors">Bachelors</option>
                                        <option {{ old('academic_achievement') == 'intermediate' ? 'selected' : '' }} value="intermediate">Intermediate</option>
                                        <option {{ old('academic_achievement') == 'martic' ? 'selected' : '' }} value="martic">Martic</option>
                                    </select>
                                    @error('academic_achievement')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Institute / Board / University <span class="text-danger">*</span></label> 
                                    <select class="load_select form-control  @error('institute_id') is-invalid @enderror" name="institute_id" id="institute_id">
                                        <option value="0">Please Select</option>
                                        @foreach ($institutions as $single)
                                        <option value="{{$single->id}}">{{$single->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('institute_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Roll No. / Reg# No. <span class="text-danger">*</span></label> 
                                    <input value="{{ old('roll_number') }}" type="text" placeholder="Enter Roll No. / Reg# No." name="roll_number" id="roll_number" class="form-control @error('roll_number') is-invalid @enderror"  aria-required="true">
                                    @error('roll_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Total Marks <span class="text-danger">*</span></label> 
                                    <input value="{{ old('total_marks') }}" type="number" placeholder="Enter Total Marks" name="total_marks" id="total_marks" class="form-control @error('total_marks') is-invalid @enderror"  aria-required="true">
                                    @error('total_marks')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Obtained Marks <span class="text-danger">*</span></label> 
                                    <input value="{{ old('obtain_marks') }}" type="number" placeholder="Enter Obtained Marks" name="obtain_marks" id="obtain_marks" class="form-control @error('obtain_marks') is-invalid @enderror"  aria-required="true">
                                    @error('obtain_marks')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Grade <span class="text-danger">*</span></label> 
                                    <input value="{{ old('grade') }}" type="text" placeholder="Enter Grade" name="grade" id="grade" class="form-control @error('grade') is-invalid @enderror">
                                    @error('grade')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Passing Year <span class="text-danger">*</span></label> 
                                    <input value="{{ old('passing_year') }}" type="text" placeholder="Enter Passing Year" name="passing_year" id="passing_year" class="form-control @error('passing_year') is-invalid @enderror"  aria-required="true">
                                    @error('passing_year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Degree / Certificate <span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input name="document" id="document" type="file" class="custom-file-input @error('document') is-invalid @enderror" >
                                        <label for="logo" class="custom-file-label">Upload Document</label>
                                    </div> 
                                    @error('document')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 text-right">
                                <button class="btn btn-white btn-sm" type="reset">Cancel</button>
                                <button class="btn btn-primary btn-sm" type="submit">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Student Documents Details</h5>
                </div>
                <div class="ibox-content">

                    <div class="col-lg-12 m-b-lg">
                        <div id="vertical-timeline" class="vertical-container light-timeline no-margins">

                            @forelse ($documents as $single)
                                <div class="vertical-timeline-block">
                                    <div class="vertical-timeline-icon blue-bg">
                                        <i class="fa fa-file-text"></i>
                                    </div>
                                    <div class="vertical-timeline-content pt-1">
                                        <h2><i class="fa fa-institution"></i> {{ ucfirst($single->institute->name) }}</h2>
                                        <h3>{{ ucfirst($single->academic_achievement) }}</h3>
                                        
                                        <span> 
                                            <strong> Roll No. / Reg# No: </strong> 
                                            {{ $single->roll_number }}
                                        </span><br>
                                        <span><strong> Total Marks: </strong> 
                                            {{ $single->total_marks }}
                                        </span><br>
                                        <span>
                                            <strong> Obtained Marks: </strong>
                                            {{ $single->obtain_marks }}
                                        </span><br>
                                        <span>
                                            <strong> Grade: </strong>
                                            {{ $single->grade }}
                                        </span><br>
                                      
                                        <a target="_blank" href="{{ route('view-educational-document',  $single->document)}}" class="btn btn-sm btn-success"> View Document </a>
                                        <form role="form" id="delete-documents" action="{{ route('delete-educational-document',  $single->id)}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger mr-2"> Delete </button>
                                        </form>
                                        
                                        <span class="vertical-date">
                                            <strong>Passing Year: </strong>
                                            {{ $single->passing_year }}</b>
                                        </span>
                                    </div>
                                </div>
                            @empty
                            <div class="alert alert-secondary" role="alert">No document/certificate uploaded yet!</div>
                            @endforelse              
                        </div>
                    </div>


                    <!-- <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="tbl-candidates-documnets">
                            <thead>
                                <tr>
                                    <th>Degree / Certificate</th>
                                    <th>Institute / Board / University</th>
                                    <th>Roll No. / Reg# No.</th>
                                    <th>Total Marks</th>
                                    <th>Obtained Marks</th>
                                    <th>Grade</th>
                                    <th>Passing Year</th>
                                    <th width="130"><i class="fa fa-cogs" aria-hidden="true"></i> Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('footer_scripts')
    <script>
        $(document).ready(function () {
            // init datatable.
            var dataTable = $('#tbl-candidates-documnets').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                scrollX: true,
                "order": [[ 0, "desc" ]],
                ajax: '{{ route('candidates-doc-list') }}',
                columns: [
                    {data: 'academic_achievement', name: 'academic_achievement'},
                    {data: 'institute', name: 'institute'},
                    {data: 'roll_number', name: 'roll_number'},
                    {data: 'total_marks', name: 'total_marks'},
                    {data: 'obtain_marks', name: 'obtain_marks'},
                    {data: 'grade', name: 'grade'},
                    {data: 'passing_year', name: 'passing_year'},
                    {data: 'action', name: 'action',orderable:false,serachable:false,sClass:'text-center'},
                ]
            });

        });
    </script> 
@endpush