@extends('candidate.layouts.candidate_main')

@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Exam Reschedule</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Exam Reschedule</strong>
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
        <div class="col-md-8">                    
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Exam Reschedule</h5>
                </div>
                <div class="ibox-content">
                <form class="m-t" role="form" action="{{ route('reschedule-update', ['id' => $registration->id]) }}" method="POST" >
                    @csrf
                    <div class="row"> 
                        
                        <input type="hidden" name="exam_id" id="exam_id" value="">
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Country <span class="text-danger">*</span></label>
                                <select class="load_select form-control  @error('country_id') is-invalid @enderror" name="country_id" id="country_id" data-target="state_id" data-url="{{ route('list-states') }}">
                                    @foreach ($countries as $single)
                                        <option {{ $single->id == $registration->city->state->country->id ? 'selected' : '' }} value="{{$single->id}}">{{$single->name}}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Province <span class="text-danger">*</span></label>
                                <select class="load_select form-control  @error('state_id') is-invalid @enderror" name="state_id" id="state_id" data-target="city_id" data-url="{{ route('list-cities') }}">
                                    @foreach ($states as $single)
                                        <option {{ $single->id == $registration->city->state->id ? 'selected' : '' }}  value="{{$single->id}}">{{$single->name}}</option>
                                    @endforeach
                                </select>
                                @error('state_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>City <span class="text-danger">*</span></label>
                                <select class="load_select form-control  @error('city_id') is-invalid @enderror" name="city_id" id="city_id" data-target="exam_center_id" data-url="{{ route('list-exam-centers') }}">
                                    @foreach ($cities as $single)
                                        <option {{ $single->id == $registration->city->id ? 'selected' : '' }} value="{{$single->id}}">{{$single->name}}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>  
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Exam Centers <span class="text-danger">*</span></label>
                                <select class="select-2 form-control  @error('exam_center_id') is-invalid @enderror" name="exam_center_id" id="exam_center_id" data-target="exam_dates" data-url="{{ route('list-exam-calendar') }}">
                                    @foreach ($exam_centers as $single)
                                        <option {{ $single->id == $registration->exam_center_id ? 'selected' : '' }} value="{{$single->id}}">{{$single->name}}</option>
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
                                <label>Exam Dates <span class="text-danger">*</span></label>
                                <select class="select-2 form-control  @error('exam_dates') is-invalid @enderror" name="exam_dates" id="exam_dates" data-target="exam_calendar_timeslot_id" data-url="{{ route('list-time-slots') }}">
                                    @foreach ($calendar as $single)
                                        <option {{ $single->id == $registration->timeslot->exam_calander->id ? 'selected' : '' }} value="{{$single->id}}">{{$single->name}}</option>
                                    @endforeach
                                </select>
                                @error('exam_dates')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Available Time Slots <span class="text-danger">*</span></label>
                                <select class="form-control  @error('exam_calendar_timeslot_id') is-invalid @enderror" id="exam_calendar_timeslot_id" name="exam_calendar_timeslot_id" >
                                    @foreach ($timeslots as $single)
                                        <option data-avalible_seats="{{ $single->avalible_seats }}" {{ $single->id == $registration->exam_calendar_timeslot_id? 'selected' : '' }} value="{{$single->id}}">{{$single->name}}</option>
                                    @endforeach
                                </select>
                                 @error('exam_calendar_timeslot_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                    </div>       
                        
                        
                        
                       
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <h3 style="display: none;" id="avalible_seats_txt">Avalible Seats:</h3>
                            </div>
                            <div class="col-sm-8 text-right">
                                <button class="btn btn-white btn-sm" type="reset">Cancel</button>
                                <button class="btn btn-primary btn-sm" type="submit">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><strong>Note! </strong>Important Instructions!</h5>
            </div>
            <div class="ibox-content">
            <p><strong>Step 1:</strong> Select the exam you want to apply for.</p>
            <p><strong>Step 2:</strong> After the selection of exam, You need to select your examination center.</p>
            <p><strong>Step 3:</strong> After selection of the examination center, you will get the list of available time slots of the examination center. Please chose time slot as per avalibality and convinance.</p>

            </div>
        </div>  
    </div>
</div>
@endsection

@push('footer_scripts')
    <script>
        $(document).on('change','#exam_id',function(e){

            var exam_start = $(this).find(':selected').data('exam_start');
            var exam_end   = $(this).find(':selected').data('exam_end');

            var minDate = new Date(exam_start.valueOf());
            var maxDate = new Date(exam_end.valueOf());

            // console.log(minDate, maxDate);

            $('#exam_date').datepicker('setStartDate', minDate);
            $('#exam_date').datepicker('setEndDate', maxDate);
        });

        $(document).on('change','#exam_center_id',function(e){

            var target   = $(this).data('target');
            var url      = $(this).data('url');
            var exam_id  = $('#exam_id').val();

            $.ajax({

                url: url,
                type: "GET",
                data: {
                    exam_id: exam_id,
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

                },
                complete   : function () {

                }
            });
        });

        $(document).on('change','#exam_dates',function(e){

            var target   = $(this).data('target');
            var url      = $(this).data('url');

            $.ajax({

                url: url,
                type: "GET",
                data: {
                    exam_calender_id: $(this).val()
                },
                cache   : false,
                headers: {
                  'X-CSRF-Token': '{{ csrf_token() }}',
                },
                success : function(data){

                    var options = '<option value="">Please select</option>';

                    if(data)
                    {
                        $.each(data, function( index, value ) {
                            options += '<option data-avalible_seats="'+value.avalible_seats+'" value="'+value.id+'">'+value.name+'</option>';
                        });
                    }

                    $('select[name="'+target+'"]').html(options).attr('disabled', false);
                },
                error : function(){

                },
                beforeSend : function(){
                    $('#avalible_seats_txt').hide();
                },
                complete   : function () {

                }
            });
        });

        $(document).on('change','#exam_calendar_timeslot_id',function(e){        

            $('#avalible_seats_txt').text('Avalible Seats: '+$(this).find(":selected").data('avalible_seats')).show();

        });

    </script> 
@endpush
