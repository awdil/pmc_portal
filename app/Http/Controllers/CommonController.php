<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamCenter;
use App\Models\ExamCalendar;
use App\Models\ExamCalendarTimeslot;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class CommonController extends Controller
{	
	public function listExamCalendar(Request $request)
    {	
		$where = [];

		if( $request->exam_id){
			$where['exam_id'] = $request->exam_id;
		}

		if( $request->exam_center_id){
			$where['exam_center_id'] = $request->exam_center_id;
		}

    	$data = ExamCalendar::where($where)->get();
		
		return response()->json($data);
    }

	public function listStates(Request $request)
    {	
    	$data = State::where('country_id', $request->id)->get();
		return response()->json($data);
    }

    public function listCities(Request $request)
    {	
    	$data = City::where('state_id', $request->id)->get();
		return response()->json($data);
    }

    public function listExamCenters(Request $request)
    {	
    	$data = ExamCenter::where('city_id', $request->id)->get();
		return response()->json($data);
    }

	public function listExamCalendarByExam(Request $request)
    {	
    	$data = ExamCalendar::where([
    		//'exam_id' => $request->exam_id,
			'exam_center_id' => $request->exam_center_id,
    	])->get();
		
		return response()->json($data);
    }

    public function listTimeSlots(Request $request)
    {	
    	$data = ExamCalendarTimeslot::where([
    		'exam_calender_id' => $request->exam_calender_id
    	])->get();
		return response()->json($data);
    }

	public function getRoleName()
    {	
		// $userid = Auth::user()->name
    	// $userrole = User::where(['id' => $userid])->with(['roles'])->first();
		// return $userrole;
    }
}

