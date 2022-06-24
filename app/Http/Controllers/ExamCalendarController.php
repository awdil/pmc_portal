<?php

namespace App\Http\Controllers;

use App\Models\ExamCenter;
use App\Models\ExamCalendar;
use App\Models\Exam;
use Illuminate\Http\Request;
use DataTables;

class ExamCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
        $user = \Auth::user();
        
        if ($request->ajax()) {

            $data = ExamCalendar::with([
                'exam',
                'exam_center'
            ])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '

                      <div class="btn-group">
                        <a class="btn-primary btn btn-xs" href="'.route("edit-exam-calender", ['id' => $row->id]).'">Edit</a>
                        <a class="btn-danger btn btn-xs text-white" data-table="exams-list" ata-table="exam-calender-list" href="'.route("edit-exam-calender", ['id' => $row->id]).'">Delete</a>
                    </div>';

                    return $actionBtn;
                })
                ->addColumn('status', function($row){
                   
                    $color = $row->status == "active" ? "label-primary"  : "label-danger";
                    return '<span class="label  '. $color .'">'.ucfirst($row->status).'</span>';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
      
        $examcenters = ExamCenter::where('status', 'active')->get();
        $exams = Exam::where('status', 'active')->get();
      
        return view('exam_center.exams_calender_list.exams_calender_list', [
            'exams'         => $exams,
            'examcenters'   => $examcenters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $current_date = date('d/m/Y');
        $validated = $request->validate([
            'exam_id'           => ['required', 'integer'],
            'exam_center_id'    => ['required', 'integer'],
            'exam_date'         => ['required', 'date_format:d/m/Y', 'after_or_equal:'.$current_date],
            ],
            [
                'exam_id.required'           => 'The exam name field is required!',
                'exam_center_id.required'    => 'The exam center field is required!',
            ]
        );

        try {

            $input = $request->all();
            $input['status'] = 'active';

            $result = ExamCalendar::create($input);
            if ($result->wasRecentlyCreated) {
                return redirect('exams-calender')->with('success', 'New Exam calender created!');
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
        $examcenters = ExamCenter::where('status', 'active')->get();
        $exams = Exam::where('status', 'active')->get();
        $user = \Auth::user();

        $exam_calendar = ExamCalendar::where([
            'status' => 'active', 
            'id' => $id,
        ])->first();
        //dd($exam_calendar->toArray());
        return view('exam_center.exams_calender_list.exams_calender_list', [
            'exam_calendar' => $exam_calendar,
            'examcenters'   => $examcenters,
            'exams'         => $exams
        ]);
    }

    public function update(Request $request, $id)
    {
        $current_date = date('d/m/Y');
        
        $user = \Auth::user();
        //dd($request->all());
        $validated = $request->validate([
            'exam_id'           => ['required', 'integer'],
            'exam_center_id'    => ['required', 'integer'],
            'exam_date'         => ['required', 'date_format:d/m/Y', 'after_or_equal:'.$current_date],
            ],[
                'exam_id.required'           => 'The exam name field is required!',
                'exam_center_id.required'    => 'The exam center field is required!',
            ]
        );

        try {
            $input = $request->all(); 
            $exam = ExamCalendar::where('id', $id)->first();  
            //dd($exam);
            $updated = $exam->update($input);
            if ($updated) {
                return back()->with('success', 'Your details for the exam calender has been updated Successfully!');
            }else{
                return back()->withErrors($validated->errors());
            }
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function destroy(ExamCalendar $examcalendar)
    {
        //
    }


    public function delete($id)
    {
        $exam = ExamCalendar::find($id);
        if ($exam) {
            $exam->delete();
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('error' => false));
        }
    }
}
