
<div class="wrapper wrapper-content pb-0">
    <div class="row">   
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add New Exam Calender Timeslot</h5>
                </div>
                <div class="ibox-content pb-1">
                    <form class="m-t" role="form" method="post" action="{{ route('save-new-exam-calender-time-slot') }}" id="form_exams">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Please Select Exam  <span class="text-danger">*</span></label>
                                    <select class="select-2 form-control  @error('exme_id') is-invalid @enderror" name="exme_id" id="exme_id" data-target="exam_calender_id" data-url="{{ route('list-exam-calendar') }}">
                                        @foreach ($exams as $single)
                                        <option value="{{$single->id}}">{{$single->exam_title}}</option>
                                        @endforeach
                                    </select>
                                    @error('exme_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Please Select Exam Center<span class="text-danger">*</span></label>
                                    <select class="select-2 form-control  @error('exam_center_id') is-invalid @enderror" name="exam_center_id" id="exam_center_id" data-target="exam_calender_id" data-url="{{ route('list-exam-calendar') }}">
                                        @foreach ($exam_centers as $single)
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
                                    <label>Please Select Exam Date<span class="text-danger">*</span></label>
                                    <select class="select-2 form-control  @error('exam_calender_id') is-invalid @enderror" name="exam_calender_id" id="exam_calender_id" data-target="" data-url="">
                                       
                                    </select>
                                    @error('exam_calender_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Exam Begin time<span class="text-danger">*</span></label>
                                    <input name="exam_begins_at" id="exam_begins_at" type="text" class="form-control @error('exam_begins_at') is-invalid @enderror" placeholder="Please Enter Exam Begins Time" value="{{ old('exam_begins_at') }}" >
                                @error('exam_begins_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Exam End Time<span class="text-danger">*</span></label>
                                    <input name="exam_end_at" id="exam_end_at" type="text" class="form-control @error('exam_end_at') is-invalid @enderror" placeholder="Please Enter Exam End Time" value="{{ old('exam_end_at') }}" >
                                @error('exam_end_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>   
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Arrival Time <span class="text-danger">*</span></label>
                                    <input name="time_from" id="time_from" type="text" class="form-control @error('time_from') is-invalid @enderror" placeholder="Please Enter Arrival Time" value="{{ old('time_from') }}" >
                                @error('time_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Departure Time <span class="text-danger">*</span></label>
                                    <input name="time_to" id="time_to" type="text" class="form-control @error('time_to') is-invalid @enderror" placeholder="Please Enter Departure Time " value="{{ old('time_to') }}" >
                                @error('time_to')
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
       $(document).on('change','#exme_id',function(e){

            var target   = $(this).data('target');
            var url      = $(this).data('url');
            //var exam_id  = $('#exam_id').val();
            //var selected = $(this).find('option:selected');
           
            $.ajax({

                url: url,
                type: "GET",
                data: {
                    exam_id: $(this).val()
                    //exam_center_id: $(this).val()
                },
                cache   : false,
                headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
                },
                success : function(data){

                    var options = '<option value=""></option>';

                    if(data)
                    {
                        $.each(data, function( index, value ) {
                            options += '<option value="'+value.id+'">'+value.name+'</option>';
                        });
                    }

                    console.log(options);

                    $('select[name="'+target+'"]').html(options).attr('disabled', false);
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
        });


        $(document).on('change','#exam_center_id',function(e){

        var target   = $(this).data('target');
        var url      = $(this).data('url');
        //var exam_id  = $('#exam_id').val();

        $.ajax({

            url: url,
            type: "GET",
            data: {
                //exam_id: $(this).val()
                exam_center_id: $(this).val()
            },
            cache   : false,
            headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
            },
            success : function(data){

                var options = '<option value=""></option>';

                if(data)
                {
                    $.each(data, function( index, value ) {
                        options += '<option value="'+value.id+'">'+value.name+'</option>';
                    });
                }

                console.log(options);

                $('select[name="'+target+'"]').html(options).attr('disabled', false);
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
        });
        
    </script>
 @endpush   