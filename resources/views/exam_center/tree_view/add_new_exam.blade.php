
<div class="wrapper wrapper-content pb-0">
    <div class="row">   
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add New Exam</h5>
                </div>
                <div class="ibox-content pb-1">
                    <form class="m-t" role="form" method="post" action="{{ route('add-new-exam') }}" id="form_exams">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Exam Title <span class="text-danger">*</span></label>
                                    <input name="exam_title" id="exam_title" type="text" class="form-control @error('exam_title') is-invalid @enderror" placeholder="Please Enter Exam Name" value="{{ old('exam_title') }}" >
                                @error('exam_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                             </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Exam Fee <span class="text-danger">*</span></label>
                                    <input name="exam_fee" id="exam_fee" type="number" class="form-control @error('exam_fee') is-invalid @enderror" placeholder="Please Enter Exam Fee" value="{{ old('exam_fee') }}" >
                                @error('exam_fee')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                             </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Exam Start Date <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input name="exam_start_date" id="exam_start_date" type="text" class="form-control @error('exam_start_date') is-invalid @enderror" placeholder="Select Exam Start Date" value="{{ old('exam_start_date') }}" >
                                    @error('exam_start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                </div>
                             </div> 
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label>Exam End Date <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input name="exam_end_date" id="exam_end_date" type="text" class="form-control @error('exam_end_date') is-invalid @enderror" placeholder="Select Exam End Date" value="{{ old('exam_end_date') }}" >
                                    @error('exam_end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                             </div>           
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descriptions <span class="text-danger"></span></label>
                                    <textarea class="form-control  @error('exam_description') is-invalid @enderror" placeholder="Please Enter Exam Description" name="exam_description" id="exam_description">{{ old('exam_description') }}</textarea>
                                @error('exam_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row text-right">
                            <div class="col-sm-12 ">
                                <button class="btn btn-white btn-sm" type="submit">Cancel</button>
                                <button class="btn btn-primary btn-sm" type="submit">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>   
@push('footer_scripts')
    <script>
    
        $(function () {
            /*--FOR DATE----*/
            var date = new Date();
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

            //Disable Past Dates for start Exam
            $('#exam_start_date').datepicker({
              format: 'dd-mm-yyyy',
              todayHighlight:'TRUE',
              startDate: today,
              endDate:0,
              autoclose: true
            });

            //Disable Past Dates for Exam start 
            $(document).on('change','#exam_start_date',function(e){
                $("#exam_end_date").removeAttr("disabled");
                var minimum_examend = $('#exam_start_date').val();
                $('#exam_end_date').datepicker({
                format: 'dd-mm-yyyy',
                todayHighlight:'TRUE',
                startDate: minimum_examend,
                endDate:0,
                autoclose: true
                });
            });

        });
    </script>
 @endpush   