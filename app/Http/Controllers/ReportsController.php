<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Exam;
use App\Models\ExamCenter;
use App\Models\User;
use App\Models\ExamRegistration;
use App\Models\ExamCalendar;
use DataTables;
use Illuminate\Support\Carbon;

class ReportsController extends Controller
{
    public function examCenters(Request $request){

		$user = \Auth::user();
      	if ($request->ajax()) {

            $country_id = request()->get('country_id', 0);
            $state_id = request()->get('state_id', 0);
            $city_id = request()->get('city_id', 0);
            $exam_center_id = request()->get('exam_center_id', 0);
            $search_term = request()->get('search_term', 0);

            $data = ExamCenter::with([
		    	'city.state.country'
		    ]);
           
            if($country_id > 0){
                $data = $data->where('country_id', $country_id);
            }

            if($state_id > 0){
                $data = $data->where('state_id', $state_id);
            }

            if($city_id > 0){
                $data = $data->where('city_id', $city_id);
            }

            if($exam_center_id > 0){
                $data = $data->where('id', $exam_center_id);
            }
    

            if (!empty($search_term)) {
                $data = $data->where('name', 'LIKE', '%'. $search_term . '%')
                            ->orWhere('capacity', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('phone_number', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('email', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('address', 'LIKE', '%'. $search_term.'%');
            }

            $data = $data->get();
            //dd($data->toArray());
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '

                        <div class="btn-group">
                            <a class="btn-primary btn btn-xs" href="'.route("edit-examiner", ['id' => $row->id]).'">Edit</a>
                            <a class="btn-warning btn btn-xs text-white assign-exam-center-modal" data-user_id="'.$row->id.'" data-examiner_name="'.ucfirst($row->name).'">Assign Exam Center</a>
                            <a class="btn-danger btn btn-xs text-white" data-table="examiners-list" href="'.route("delete-examiner", ['id' => $row->id]).'">Delete</a>
                        </div>
                    ';

                    return $actionBtn;
                })
                ->addColumn('status', function($row){
                   
                    $color = $row->status == "active" ? "label-primary"  : "label-danger";
                    return '<span class="label  '. $color .'">'.ucfirst($row->status).'</span>';
                })
                
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        $country = Country::get();
        $exams = Exam::get();

	 	return view('admin.reports.exam_centers_report', [
         	'country' => $country,
         	'exams' => $exams,
     	]);
    }

	public function candidateStates(Request $request){

		$user = \Auth::user();
      	if ($request->ajax()) {

            $country_id = request()->get('country_id', 0);
            $state_id = request()->get('state_id', 0);
            $city_id = request()->get('city_id', 0);
            $search_term = request()->get('search_term', 0);

		    //$data = User::whereRoleIs('user')->with(['city']);

            $data = ExamRegistration::with([
		    	'user', 
		    	'exam_center', 
		    	'city.state.country', 
		    	'timeslot.exam_calander.exam'
		    ]);

            if($country_id > 0){
                $data = $data->where('country_id', $country_id);
            }

            if($state_id > 0){
                $data = $data->where('state_id', $state_id);
            }

            if($city_id > 0){
                $data = $data->where('city_id', $city_id);
            }
           

            if (!empty($search_term)) {
                $data = $data->where('name', 'LIKE', '%'. $search_term . '%')
                            ->orWhere('father_name', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('mobile_number', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('email', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('cnic_number', 'LIKE', '%'. $search_term.'%');
            }

            $data = $data->get();
            //dd($data->toArray());
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '

                        <div class="btn-group">
                            <a class="btn-primary btn btn-xs" href="'.route("edit-examiner", ['id' => $row->id]).'">Edit</a>
                            <a class="btn-warning btn btn-xs text-white assign-exam-center-modal" data-user_id="'.$row->id.'" data-examiner_name="'.ucfirst($row->name).'">Assign Exam Center</a>
                            <a class="btn-danger btn btn-xs text-white" data-table="examiners-list" href="'.route("delete-examiner", ['id' => $row->id]).'">Delete</a>
                        </div>
                    ';

                    return $actionBtn;
                })
                ->addColumn('status', function($row){
                   
                    $color = $row->status == "active" ? "label-primary"  : "label-danger";
                    return '<span class="label  '. $color .'">'.ucfirst($row->status).'</span>';
                })
                
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        $country = Country::get();
        $exams = Exam::get();
        //dd($exams);
	 	return view('admin.reports.candidate_status_report', [
             'country' => $country,
             'exams' => $exams   
     	]);
	}

	public function candidateRegistrations(Request $request){

		$user = \Auth::user();
      	if ($request->ajax()) {

            $country_id = request()->get('country_id', 0);
            $state_id = request()->get('state_id', 0);
            $city_id = request()->get('city_id', 0);
            $exam_center_id = request()->get('exam_center_id', 0);
            $exam_id = request()->get('exam_id', 0);
            $search_term = request()->get('search_term', 0);

		    $data = ExamRegistration::with([
		    	'user', 
		    	'exam_center', 
		    	'city.state.country', 
		    	'timeslot.exam_calander.exam'
		    ]);

            if($country_id > 0){
                $data = $data->whereHas('user', function ($query) use($request) {
				    return $query->where('country_id', $request->country_id);
				});
            }

            if($state_id > 0){
                $data = $data->whereHas('user', function ($query) use($request) {
				    return $query->where('state_id', $request->state_id);
				});
            }

            if($city_id > 0){
                $data = $data->whereHas('user', function ($query) use($request) {
				    return $query->where('city_id', $request->city_id);
				});
            }

            if($exam_center_id > 0){
                $data = $data->where('exam_center_id', $exam_center_id);
            }

            if($exam_id > 0){
                $data = $data->whereHas('timeslot.exam_calander.exam', function ($query) use($request) {
				    return $query->where('exam_id', $request->exam_id);
				});
            }
           

            if (!empty($search_term)) {
                $data = $data->where('name', 'LIKE', '%'. $search_term . '%')
                            ->orWhere('father_name', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('mobile_number', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('email', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('cnic_number', 'LIKE', '%'. $search_term.'%');
            }

            $data = $data->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '

                        <div class="btn-group">
                            <a class="btn-primary btn btn-xs" href="'.route("edit-examiner", ['id' => $row->id]).'">Edit</a>
                            <a class="btn-warning btn btn-xs text-white assign-exam-center-modal" data-user_id="'.$row->id.'" data-examiner_name="'.ucfirst($row->name).'">Assign Exam Center</a>
                            <a class="btn-danger btn btn-xs text-white" data-table="examiners-list" href="'.route("delete-examiner", ['id' => $row->id]).'">Delete</a>
                        </div>
                    ';

                    return $actionBtn;
                })
                ->addColumn('status', function($row){
                   
                    $color = $row->status == "active" ? "label-primary"  : "label-danger";
                    return '<span class="label  '. $color .'">'.ucfirst($row->status).'</span>';
                })
                
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        $country = Country::get();
        $exams = Exam::get();
        //$ExamCenters = ExamCenter::get();
        
	 	return view('admin.reports.candidate_registrations_report', [
     		'country' => $country,
            'exams' => $exams  
     	]);
	}

	public function attendanceStatus(Request $request){

		$user = \Auth::user();
      	if ($request->ajax()) {

            $country_id = request()->get('country_id', 0);
            $state_id = request()->get('state_id', 0);
            $city_id = request()->get('city_id', 0);
            $exam_center_id = request()->get('exam_center_id', 0);
            $exam_id = request()->get('exam_id', 0);
            $search_term = request()->get('search_term', 0);

		    $data = ExamRegistration::with([
		    	'user', 
		    	'exam_center', 
		    	'city.state.country', 
		    	'timeslot.exam_calander.exam'
		    ]);

            if($country_id > 0){
                $data = $data->whereHas('user', function ($query) use($request) {
				    return $query->where('country_id', $request->country_id);
				});
            }

            if($state_id > 0){
                $data = $data->whereHas('user', function ($query) use($request) {
				    return $query->where('state_id', $request->state_id);
				});
            }

            if($city_id > 0){
                $data = $data->whereHas('user', function ($query) use($request) {
				    return $query->where('city_id', $request->city_id);
				});
            }

            if($exam_center_id > 0){
                $data = $data->where('exam_center_id', $exam_center_id);
            }

            if($exam_id > 0){
                $data = $data->whereHas('timeslot.exam_calander.exam', function ($query) use($request) {
				    return $query->where('exam_id', $request->exam_id);
				});
            }

            if (!empty($search_term)) {

            	$data = $data->whereHas('user', function ($query) use($request) {
				    return $query->where('name', 'LIKE', '%'. $search_term . '%')
                            ->orWhere('father_name', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('mobile_number', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('email', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('cnic_number', 'LIKE', '%'. $search_term.'%');
				});
            }

            $data = $data->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '

                        <div class="btn-group">
                            <a class="btn-primary btn btn-xs" href="'.route("edit-examiner", ['id' => $row->id]).'">Edit</a>
                            <a class="btn-warning btn btn-xs text-white assign-exam-center-modal" data-user_id="'.$row->id.'" data-examiner_name="'.ucfirst($row->name).'">Assign Exam Center</a>
                            <a class="btn-danger btn btn-xs text-white" data-table="examiners-list" href="'.route("delete-examiner", ['id' => $row->id]).'">Delete</a>
                        </div>
                    ';

                    return null;
                })
                ->addColumn('attendance', function($row){

                	if(false){

                	}else{
                    	return $row->arrived_at == null ? '<span class="label label-danger">Absent</span>' : '<span class="label label-primary">Present</span>';
                	}
                })
                ->rawColumns(['action', 'attendance'])
                ->make(true);
        }

        $country = Country::get();
        $exams = Exam::get();

	 	return view('admin.reports.attendance_status', [
         	'country' => $country,
         	'exams' => $exams
     	]);
	}

	public function paymentStatus(Request $request){

		$user = \Auth::user();
      	if ($request->ajax()) {

            $country_id = request()->get('country_id', 0);
            $state_id = request()->get('state_id', 0);
            $city_id = request()->get('city_id', 0);
            $exam_id = request()->get('exam_id', 0);
            $exam_center_id = request()->get('exam_center_id', 0);
            $search_term = request()->get('search_term', 0);

		    //$data = User::whereRoleIs('user')->with(['city']);

            $data = ExamRegistration::with([
		    	'user', 
		    	'exam_center', 
		    	'city.state.country', 
		    	'timeslot.exam_calander.exam'
		    ]);

            if($country_id > 0){
                $data = $data->whereHas('user', function ($query) use($request) {
				    return $query->where('country_id', $request->country_id);
				});
            }

            if($state_id > 0){
                $data = $data->whereHas('user', function ($query) use($request) {
				    return $query->where('state_id', $request->state_id);
				});
            }

            if($city_id > 0){
                $data = $data->whereHas('user', function ($query) use($request) {
				    return $query->where('city_id', $request->city_id);
				});
            }

            if($exam_center_id > 0){
                $data = $data->where('exam_center_id', $exam_center_id);
            }

            if($exam_id > 0){
                $data = $data->whereHas('timeslot.exam_calander.exam', function ($query) use($request) {
				    return $query->where('exam_id', $request->exam_id);
				});
            }
           

            if (!empty($search_term)) {
                $data = $data->where('name', 'LIKE', '%'. $search_term . '%')
                            ->orWhere('father_name', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('mobile_number', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('email', 'LIKE', '%'. $search_term.'%')
                            ->orWhere('cnic_number', 'LIKE', '%'. $search_term.'%');
            }

            $data = $data->get();
            //dd($data->toArray());
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '

                        <div class="btn-group">
                            <a class="btn-primary btn btn-xs" href="'.route("edit-examiner", ['id' => $row->id]).'">Edit</a>
                            <a class="btn-warning btn btn-xs text-white assign-exam-center-modal" data-user_id="'.$row->id.'" data-examiner_name="'.ucfirst($row->name).'">Assign Exam Center</a>
                            <a class="btn-danger btn btn-xs text-white" data-table="examiners-list" href="'.route("delete-examiner", ['id' => $row->id]).'">Delete</a>
                        </div>
                    ';

                    return $actionBtn;
                })
                ->addColumn('is_paid', function($row){
                   
                    $color = $row->is_paid == "Y" ? "text-navy"  : "text-danger";
                    return '<p class="'. $color .'">'.ucfirst($row->is_paid = ($row->is_paid)=='Y' ? 'Paid' : 'Pending' ).'</p>';
                })
                //paid_date
                ->rawColumns(['action', 'is_paid'])
                ->make(true);
        }

        $country = Country::get();
        $exams = Exam::get();
        return view('admin.reports.payment_status_report', [
         	'country' => $country,
            'exams' => $exams,
     	]);
	}
}
