
<div class="wrapper wrapper-content pb-0">
    <div class="row">   
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add New Exam Calender</h5>
                </div>
                <div class="ibox-content pb-1">
                    <form class="m-t" role="form" method="post" action="{{ route('save-new-exam-calender') }}" id="form_exams">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Please Select Exam Name <span class="text-danger">*</span></label>
                                    <select class="select-2 form-control  @error('exam_id') is-invalid @enderror" name="exam_id" id="exam_id" data-target="" data-url="">
                                        @foreach ($exams as $single)
                                        <option value="{{$single->id}}">{{$single->exam_title}}</option>
                                        @endforeach
                                    </select>
                                    @error('exam_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Plase Select Exam Center <span class="text-danger">*</span></label>
                                    <select class="select-2 form-control  @error('exam_center_id') is-invalid @enderror" name="exam_center_id" id="exam_center_id" data-target="" data-url="">
                                        @foreach ($examcenters as $single)
                                        <option value="{{$single->id}}">{{$single->name}}</option>
                                        @endforeach
                                    </select>
                                @error('exam_center_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Exam Date <span class="text-danger">*</span></label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input name="exam_date" id="exam_date" type="text" class="form-control datepicker @error('exam_date') is-invalid @enderror" placeholder="Please Enter Exam Start Date" value="{{ old('exam_date') }}" >
                                    @error('exam_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
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

            //Disable Past Dates
            $('#exam_date').datepicker({
              todayHighlight:'TRUE',
              startDate: today,
              endDate:0,
              autoclose: true
            });

        });
    </script>
 @endpush   