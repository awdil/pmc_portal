
<div class="wrapper wrapper-content pb-0">
    <div class="row">   
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add New Exam Center</h5>
                </div>
                <div class="ibox-content pb-1">
                    <form class="m-t" role="form" method="post" action="{{ route('save-exam-center') }}" id="form_exam_center">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Exam Center Name <span class="text-danger">*</span></label>
                                    <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Please Enter Exam Center Name" value="{{ old('name') }}" >
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                             </div>   
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input name="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Please Enter Exam Center Email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone Number <span class="text-danger">*</span></label>
                                    <input name="phone_number" id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Please Enter Exam Center Phone Number" value="{{ old('phone_number') }}">
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Country <span class="text-danger">*</span></label>
                                    <select class="load_select form-control  @error('country_id') is-invalid @enderror" name="country_id" id="country_id" data-target="state_id" data-url="{{ route('list-states') }}">
                                        <option value="">Select Country</option>
                                        @foreach ($country as $single)
                                        <option value="{{$single->id}}">{{$single->name}}</option>
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
                                        <option value="">Select Province</option>
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
                                        <option value="">Select City</option>
                                    </select>
                                    @error('city_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Capacity <span class="text-danger">*</span></label>
                                    <input name="capacity" id="capacity" type="number" class="form-control @error('capacity') is-invalid @enderror" placeholder="Please Enter Exam Center Capacity" value="{{ old('capacity') }}" >
                                @error('capacity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input name="longitude" id="longitude" type="text" class="form-control @error('longitude') is-invalid @enderror" placeholder="Please Enter Exam Center Longitude" value="{{ old('longitude') }}" >
                                @error('longitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input name="latitude" id="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror" placeholder="Please Enter Exam Center Latitude" value="{{ old('latitude') }}" >
                                @error('latitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control  @error('address') is-invalid @enderror" placeholder="Please Enter Exam Center Address" name="address" id="address">{{ old('address') }}</textarea>
                                @error('address')
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