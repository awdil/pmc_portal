<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamCenter;
use App\Models\ExamCalendarTimeslot;
use App\Models\ExamCalendar;
use App\Models\Time;
use DataTables;

class ExamCalendarTimeSlotController extends Controller
{
    public function index(Request $request)
    {
        $user = \Auth::user();

        if ($request->ajax()) {

            $data = ExamCalendarTimeslot::with([
                'exam_calander.exam'
            ])->latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '

                        <div class="btn-group">
                            <a class="btn-primary btn btn-xs" href="'.route("edit-exam-calender-time-slot", ['id' => $row->id]).'">Edit</a>
                            <a class="btn-danger btn btn-xs text-white">Delete</a>
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

        $exams = Exam::where('status', 'active')->get();
        $examCenters = ExamCenter::where('status', 'active')->get();

        return view('exam_center.exams_calender_time_slot.exams_calender_time_slots', [
            'exams' => $exams,
            'exam_centers' => $examCenters,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'exam_calender_id'          => ['required', 'integer'],
            'time_from'                 => ['required', 'string'],
            'time_to'                   => ['required', 'string'],
            'exam_begins_at'            => ['required', 'string'],
            'exam_end_at'               => ['required', 'string'],
            ],
            [
                'exam_calender_id.required'           => 'The exam name field is required!',
            ]
        );

        try {

            $input = $request->all();
            $input['status'] = 'active';

            $result = ExamCalendarTimeslot::create($input);
            if ($result->wasRecentlyCreated) {
                //return view('exam_center.exam_centers.index');
                return redirect('exams-calender-time-slots')->with('success', 'New Exam calender timeslot created!');
            }else{
                return back()->withErrors($validated->errors());
            }

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $exams = Exam::where('status', 'active')->get();
        $examcenters = ExamCenter::where('status', 'active')->get();

        $timeslot = ExamCalendarTimeslot::where([
            'id' => $id,
        ])->with([
            'exam_calander.exam_center'
        ])->first();

        $examcalendar = ExamCalendar::where([
            'exam_center_id' =>$timeslot->exam_calander->exam_center_id,
            'exam_id' => $timeslot->exam_calander->exam_id
        ])->get();

        return view('exam_center.exams_calender_time_slot.exams_calender_time_slots', [
            'exams' => $exams,
            'exam_centers' => $examcenters,
            'exam_calendar' => $examcalendar,
            'timeslot' => $timeslot
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = \Auth::user();

        $validated = $request->validate([
            'exam_calender_id'          => ['required', 'integer'],
            'time_from'                 => ['required', 'string'],
            'time_to'                   => ['required', 'string'],
            'exam_begins_at'            => ['required', 'string'],
            'exam_end_at'               => ['required', 'string'],
            ],
            [
                'exam_calender_id.required'           => 'The exam name field is required!',
            ]
        );

        try {
            $input = $request->all(); 
            $exam = ExamCalendarTimeslot::where('id', $id)->first();  
            //dd($exam);
            $updated = $exam->update($input);
            if ($updated) {
                return back()->with('success', 'Your details for the exam calander time slots has been updated Successfully!');
            }else{
                return back()->withErrors($validated->errors());
            }
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        $xamcalendarimeslot = ExamCalendarTimeslot::find($id);
        if ($xamcalendarimeslot) {
            $examcenter->delete();
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('error' => false));
        }
    }
}
