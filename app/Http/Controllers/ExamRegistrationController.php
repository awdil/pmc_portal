<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\ExamRegistration;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamCenter;
use App\Models\ExamCalendar;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\ExamCalendarTimeslot;
use App\Models\CandidateDocument;
use Illuminate\Support\Facades\Storage;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use DataTables;
use PDF;


class ExamRegistrationController extends Controller
{
    private $MERCHANT_ID = '472210039829';
    private $API_PWD = '626368ed646d96f570fb4e96d93bbbfa';
    private $API_VERSION = '62';
    private $PAYMENT_SITE_URL = 'https://test-mcbpk.mtf.gateway.mastercard.com/';

    public function index(Request $request)
    {

        $user = \Auth::user();
        $country = Country::get();
        $exams = Exam::where(['status' => 'active'])->get();

        return view('candidate.exam_registration.index', compact('exams','country'));
    }

    public function create()
    {
        
    }


    public function store(Request $request)
    {
        $user = \Auth::user();
        $input = $request->all();
        //dd($user);
        $validated = $request->validate([
            'exam_id'                       => ['required', 'integer'],
            'exam_center_id'                => ['required', 'integer'],
            'country_id'                    => ['required', 'integer'],
            'state_id'                      => ['required', 'integer'],
            'city_id'                       => ['required', 'integer'],
            'exam_dates'                    => ['required', 'integer'],
            'exam_calendar_timeslot_id'     => ['required', 'integer'],
        ],[
            'exam_id.required'                  =>'Exam name field is required!',
            'country_id.required'               =>'Country name field is required!',
            'city_id.required'                  =>'City name field is required!',
            'state_id.required'                 =>'Province name field is required!',
            'exam_center_id.required'           =>'Exam center name field is required!',
            'exam_calendar_timeslot_id.required'=>'Available Time Slots field is required!',
        ]);

        // check for already applied on the same exam
        $result = $this->isUserAlreadyRegisteredWithExam($input['exam_id']);
        if($result){
            return back()->with('error', 'Unfortunately you already applied to this exam!');
        }

        try {
            $avalible_seats = ExamCalendarTimeslot::checkSeatAvalibality($request->exam_calendar_timeslot_id, $request->exam_center_id);

            if($avalible_seats && $avalible_seats > 0){                
                $input['challan_number'] = '';
                $input['challan_picture'] = '';
                $input['reg_number'] = '';
                $input['is_paid'] = '';
                $input['paid_date'] = null;
                $input['payment_method'] = '';

                $input['user_id'] = $user->id;
                $input['status'] = 'active';

                $result = ExamRegistration::create($input);
                if ($result->wasRecentlyCreated) {
                    return back()->with('success', 'Your details for the exam registration has been created Successfully!');
                }else{
                    return back()->withErrors($validated->errors());
                }
            } else {
                return back()->with('error', 'Unfortunately this is no available seats for the selected timeslot!');
            }

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    
    public function show(ExamRegistration $examregistration)
    {
        
    }

    
    public function edit($registration_id)
    {
        $user = \Auth::user();
        // $exams = Exam::where(['status' => 'active'])->get();

        $registration = ExamRegistration::where([

            'status' => 'active', 
            'id' => $registration_id,
            // 'user_id' => $user->id
        ])->with([
            'user',
            'exam_center',
            'city.state.country',
            'timeslot.exam_calander.exam',
        ])->first();

        $countries = Country::get();
        $states = State::where('country_id', $registration->city->state->country->id)->get();
        $cities = City::where('state_id', $registration->city->state->id)->get();
        $exam_centers = ExamCenter::where('city_id', $registration->city_id)->get();

        $calendar = ExamCalendar::where('exam_id', $registration->timeslot->exam_calander->exam->id)->get();
        $timeslots = ExamCalendarTimeslot::where('exam_calender_id', $registration->timeslot->exam_calander->id)->get();

        return view('candidate.exam_registration.reschedule', compact('registration', 'exam_centers', 'calendar', 'timeslots', 'countries', 'states', 'cities'));
    }

    
    public function update(Request $request, $exam_registration_id)
    {
        $user = \Auth::user();

        $validated = $request->validate([
            'exam_center_id'              => ['required', 'integer'],
            'city_id'                     => ['required', 'integer'],
            'exam_calendar_timeslot_id'   => ['required', 'integer'],
        ]);

        try {

            $avalible_seats = ExamCalendarTimeslot::checkSeatAvalibality($request->exam_calendar_timeslot_id, $request->exam_center_id);

            if($avalible_seats && $avalible_seats > 0){

                $input = $request->all();
                $input['user_id'] = $user->id;
                $input['status'] = 'active';

                $registration = ExamRegistration::where('id', $exam_registration_id)->first();

                $registration->exam_center_id = $request->exam_center_id;
                $registration->city_id = $request->city_id;
                $registration->exam_calendar_timeslot_id = $request->exam_calendar_timeslot_id;
                $registration->save();


                if ($registration) {
                    return back()->with('success', 'Your details for the exam registration has been updated Successfully!');
                }else{
                    return back()->withErrors($validated->errors());
                }

            } else {
                return back()->with('error', 'Unfortunately this is no avalible seats for the selected timeslot!');
            }

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    
    public function destroy(ExamRegistration $examregistration)
    {
        
    }

    public function examRegistrationHistory(Request $request){
        $user = \Auth::user();
        if ($request->ajax()) {

            $data = ExamRegistration::where(['status' => 'active', 'user_id' => $user->id])->with([
                'user',
                'exam_center',
                'city',
                'timeslot.exam_calander.exam',
            ])->latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btns = '';

                    if($row->registration_status == 'Payment Pending'){


                        if(false){ // check that the paid chalan copy is uploaded by the candiate

                        } else {

                            $btns = '

                                <li>
                                    <a class="dropdown-item" href="'.route("payonline", ["id" => $row->id]).'"> 
                                        <i class="fa fa-file-text-o" aria-hidden="true"> </i> Pay Online
                                    </a>
                                </li>
                            ';
                        }

                        $btns = '

                            <li>
                                <a class="dropdown-item" href="'.route("print-challan", ["id" => $row->id]).'"> 
                                    <i class="fa fa-file-text-o" aria-hidden="true"> </i> Print Challan
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="'.route("reschedule", ["id" => $row->id]).'"> 
                                    <i class="fa fa-edit" aria-hidden="true"> </i> Reschedule
                                </a>
                            </li>
                        ';
                    }


                    if($row->is_paid == 'Y'){

                        $refund_url = 'http://devp.beaconhouse.net/zeeshan/Employee/request-for-refund/initiator.html';

                        $btns = '

                            <li>
                                <a class="dropdown-item" target="_blank" href="'.route("download-exam-slip", ["id" => $row->id]).'"> 
                                    <i class="fa fa-file-text-o" aria-hidden="true"> </i> Print Exam Slip
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="'.$refund_url.'"> 
                                    <i class="fa fa-file-text-o" aria-hidden="true"> </i> Request Refund
                                </a>
                            </li>
                            
                            <li>
                                <a class="dropdown-item" href="'.route("reschedule", ["id" => $row->id]).'"> 
                                    <i class="fa fa-edit" aria-hidden="true"> </i> Reschedule
                                </a>
                            </li>
                        ';
                    }


                    $actionBtn = '

                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Options</button>
                            <ul class="dropdown-menu">
                                '.$btns.'
                            </ul>
                        </div>  
                    ';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('candidate.application_history.index');
    }

    public function ExamRegistrationCandidateList(Request $request){

        $user = \Auth::user();

        if ($request->ajax()) {

            $country_id     = request()->get('country_id', 0);
            $state_id       = request()->get('state_id', 0);
            $city_id        = request()->get('city_id', 0);
            $exam_center_id = request()->get('exam_center_id', 0);
            $search_term    = request()->get('search_term', 0);

            if($user->hasRole('administrator')){

                $data = ExamRegistration::where(['status' => 'active', 'is_paid' => 'Y'])->with([
                    'user',
                    'exam_center',
                    'city',
                    'timeslot.exam_calander.exam',
                ]);

                $data = $data->whereHas('user', function ($query) use ($country_id, $state_id, $city_id, $search_term) {

                    if($country_id > 0){
                        $query->where('country_id', $country_id);
                    }

                    if($state_id > 0){
                        $query->where('state_id', $state_id);
                    }

                    if($city_id > 0){
                        $query->where('city_id', $city_id);
                    }

                    if (!empty($search_term)) {
                        $query->where('name', 'LIKE', '%'. $search_term . '%')
                            ->orWhere('father_name', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('mobile_number', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('email', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('cnic_number', 'LIKE', '%'. $search_term.'%');
                    }
                });

                if ($exam_center_id > 0) {
                    $data = $data->where('exam_center_id', $exam_center_id);
                }

                if (!empty($search_term)) {
                    $data = $data->orWhere('reg_number', 'LIKE', '%'. $search_term . '%')
                                ->orWhere('challan_number', 'LIKE', '%'.$search_term.'%');
                }

                $data = $data->get();

            } else {

                $data = ExamRegistration::where(['status' => 'active', 'is_paid' => 'Y'])->with([
                    'user',
                    'exam_center',
                    'city',
                    'timeslot.exam_calander.exam',
                ]);

                $data = $data->whereHas('user', function ($query) use ($country_id, $state_id, $city_id, $search_term) {

                    if($country_id > 0){
                        $query->where('country_id', $country_id);
                    }

                    if($state_id > 0){
                        $query->where('state_id', $state_id);
                    }

                    if($city_id > 0){
                        $query->where('city_id', $city_id);
                    }

                    if (!empty($search_term)) {
                        $query->where('name', 'LIKE', '%'. $search_term . '%')
                            ->orWhere('father_name', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('mobile_number', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('email', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('cnic_number', 'LIKE', '%'. $search_term.'%');
                    }
                });

                if ($exam_center_id > 0) {
                    $data = $data->where('exam_center_id', $exam_center_id);
                }

                if (!empty($search_term)) {
                    $data = $data->orWhere('reg_number', 'LIKE', '%'. $search_term . '%')
                                ->orWhere('challan_number', 'LIKE', '%'.$search_term.'%');
                }

                $data = $data->get();
            }
            
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('std_name', function($row){
                    return '<a href="'.route('candidate-registration-details', ['id' => $row->id]).'">'.$row->user->name.'</a>';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '

                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Options</button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" target="_blank" href="'.route("download-exam-slip", ["id" => $row->id]).'"> 
                                        <i class="fa fa-file-text-o" aria-hidden="true"> </i> Print Exam Slip
                                    </a>
                                </li> 
                                <li>
                                    <a class="dropdown-item" href="'.route("reschedule", ["id" => $row->id]).'"> 
                                        <i class="fa fa-calendar" aria-hidden="true"> </i> Reschedule                                    
                                    </a>
                                </li>   
                                <li>
                                    <a class="dropdown-item" href="'.route("download-exam-slip", ['id' => $row->id]).'"> 
                                        <i class="fa fa-money" aria-hidden="true"> </i> Request Refund 
                                    </a>
                                </li>                                
                            </ul>
                        </div>  
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'std_name'])
                ->make(true);
        }
        $countries = Country::get();
        return view('exam_center.candidates_list.index', [
            'country' => $countries
        ]);
    }

    public function examSlip($exam_registration_id){

        $data = ExamRegistration::where(['status' => 'active', 'id' => $exam_registration_id])->with([
            'user',
            'exam_center',
            'city',
            'timeslot.exam_calander.exam',
        ])->first();

        // \QrCode::size(500)
        //     ->format('png')
        //     ->generate('ItSolutionStuff.com', public_path('images/qrcode.png'));
        // \QrCode::generate($data->reg_number.'123', 'uploads/qrcodes/qrcode.svg');
        // dd($data->toArray());

        $pdf = PDF::loadView('candidate.exam_registration.roll_number_slip', ['data' => $data]);
        return $pdf->stream('document.pdf');
        // return view('candidate.exam_registration.roll_number_slip', ['data' => $data]);
    }

    public function payOnline($exam_registration_id){

        $user = \Auth::user();

        $registration = ExamRegistration::where([

            'status' => 'active', 
            'id' => $exam_registration_id,
            'user_id' => $user->id
        ])->with([
            'user',
            'exam_center',
            'city',
            'timeslot.exam_calander.exam',
        ])->first();

        //dd($registration);
        if($registration->timeslot->exam_calander->exam->exam_fee){ // need to set amount

            // dd($registration->toArray());

            $amount = $registration->timeslot->exam_calander->exam->exam_fee;

            if($amount && $amount > 0){

                $order_id = $registration->id;

                $params = array(
                    'apiOperation'=>'CREATE_CHECKOUT_SESSION',
                    'interaction' => array(
                        'operation' => 'PURCHASE'
                    ),
                    'order' => array(
                        'id'       => $order_id,
                        'currency' => 'PKR',
                        'amount'    => $amount
                    )
                );

                $url = $this->PAYMENT_SITE_URL.'api/rest/version/'.$this->API_VERSION.'/merchant/'.$this->MERCHANT_ID.'/session';
                $response = Http::withBasicAuth("merchant.".$this->MERCHANT_ID, $this->API_PWD)->post($url, $params);
                $resp = $response->object();

                if($resp && $resp->result == 'SUCCESS'){

                    // dd($response->object());

                    return view('candidate.exam_registration.payonline', [

                        'order_id' => $order_id,
                        'amount' => $amount,
                        'session_id' => $resp->session->id,
                        'site_url' => $this->PAYMENT_SITE_URL,
                        'api_version' => $this->API_VERSION,
                        'merchant_id' => $this->MERCHANT_ID,
                        'merchant' => $resp->merchant
                    ]);

                }else {

                }
            }
        }
    }

    public function payOnlineComplete(Request $request){

        $user = \Auth::user();
        $order_id = $request->order_id;

        $url = $this->PAYMENT_SITE_URL.'api/rest/version/'.$this->API_VERSION.'/merchant/'.$this->MERCHANT_ID.'/order/'.$order_id;            
        $response = Http::withBasicAuth("merchant.".$this->MERCHANT_ID, $this->API_PWD)->get($url);
        $resp = $response->object();

        if($resp && $resp->result == 'SUCCESS'){

            // dd($response->object());

            if($resp->status == 'CAPTURED'){

                $registration = ExamRegistration::where([
                    'status' => 'active', 
                    'id' => $request->order_id,
                    'user_id' => $user->id
                ])->with([
                    'user',
                    'exam_center',
                    'city',
                    'timeslot.exam_calander.exam',
                ])->first();

                // dd($registration);

                $registration->payment_method = 'MCB Online';
                $registration->paid_date = date('Y-m-d H:i:s');
                $registration->is_paid = 'Y';
                $registration->reg_number = $registration->getRegsitrationNo();
                $registration->save();

                $message = "Your payment has been successfully processed on testing. Thank you.";
                $sms = $user->sendSmsShortcode($message, $debug=true);
                return redirect(route('application-history'));

            }else{

            }

        }else {

        }
    }

    public function printChallan($exam_registration_id){

        $data = ExamRegistration::where(['status' => 'active', 'id' => $exam_registration_id])->with([
            'user',
            'exam_center',
            'city',
            'timeslot.exam_calander.exam',
        ])->first();

        $pdf = PDF::loadView('candidate.exam_registration.challan', ['data' => $data]);
        return $pdf->stream('document.pdf');

        // return view('candidate.exam_registration.challan');
    }

    public function candidateRegistrationDetails($registration_id) {

        $registration = ExamRegistration::where([
            'status' => 'active', 
            'id' => $registration_id,
        ])->with([
            'user',
            'exam_center',
            'city',
            'institute',
            'timeslot.exam_calander.exam',
        ])->first();

        // dd($registration->toArray());

        $education = CandidateDocument::where(['status' => 'active', 'user_id'=> $registration->user_id])->get();

        return view('exam_center.candidates_list.candidate_details', [
            'data' => $registration, 
            'education' => $education
        ]);
    }

    public function generateExamCredentials($registration_id) {

        // $exam_password = Str::random(8);
        $exam_password = rand(11111111,99999999);


        $registration = ExamRegistration::where([
            'status' => 'active', 
            'id' => $registration_id,
        ])->first();

        if(is_null($registration->arrived_at)){

            $registration->exam_password = $exam_password;
            $registration->arrived_at = date('Y-m-d H:i:s');
            $registration->save();
        }

        return redirect(route('candidate-registration-details', ['id' => $registration->id]));
    }

    public function examCredentialsSlip($registration_id) {

        $data = ExamRegistration::where(['status' => 'active', 'id' => $registration_id])->with([
            'user',
            'exam_center',
            'city',
            'timeslot.exam_calander.exam',
        ])->first();

        if(is_null($data->seat_no)){

            $seat_no = ExamRegistration::getExamSeatNo();
            $data->seat_no = $seat_no;
            $data->save();
        }

        $pdf = PDF::loadView('exam_center.candidates_list.exam_slip', ['data' => $data]);
        return $pdf->stream('document.pdf');
    }

    public function getReports(){
        return view('exam_center.exam_center_report.index');
    }

    public function nadraVerificationReports(){
        return view('exam_center.nadra_verification.index');
    }

    public function faceCompare(Request $request){

        $candidate_reg_image = $request->candidate_reg_image;

        $base64_image = $request->candidate_cam_image;
        $path = '/uploads/face_compare_images/';

        $base64_image = str_replace('data:image/jpeg;base64,', '', $base64_image);
        $base64_image = str_replace(' ', '+', $base64_image);
        $image_name = Str::random(20) . '.png';

        $candidate_cam_image = public_path().$path.$image_name;
        $candidate_cam_image_url = asset($path.$image_name);

        // $result = Storage::disk('public')->put($path . $image_name, base64_decode($base64_image));
        $result = file_put_contents($candidate_cam_image, base64_decode($base64_image));

        $params = array(
            'api_key' => '4mIkJaeCkyFGNlz0deycBqsDChBDCoZ5',
            'api_secret' => 'FXvVwCnMqc8YOjqRacpOnbnYQSlbXQCX',
            'image_url1' => $candidate_reg_image,
            'image_url2' => $candidate_cam_image_url,
        );

        // dd($params);

        $query_params = http_build_query($params);

        $url = 'https://api-us.faceplusplus.com/facepp/v3/compare?'.$query_params;
        $response = Http::post($url, $params);
        $resp = $response->json();
        return response()->json($resp);

    }

    public function isUserAlreadyRegisteredWithExam($pram=NULL){
        $user = \Auth::user();
        //DB::enableQueryLog(); // Enable query log
        $registered = ExamRegistration::where([
            'user_id' => $user->id
        ])->with([
            'timeslot.exam_calander.exam'
        ])->first();
        $user_exam_exist = ($registered->timeslot->exam_calander->exam->id) ? $registered->timeslot->exam_calander->exam->id :NULL;  
        //dd(DB::getQueryLog()); // Show results of log

        if(isset($user_exam_exist) && $user_exam_exist  == $pram){
            return true;
        }else{
            return false;
        }
        
    }
}
