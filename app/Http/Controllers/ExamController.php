<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$data = Exam::where('status', 'active')->get();
        $user = \Auth::user();
        if ($request->ajax()) {

            $data = Exam::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '

                    <div class="btn-group">
                        <a class="btn-primary btn btn-xs" href="'.route("edit-exam", ['id' => $row->id]).'">Edit</a>
                        <a class="btn-danger btn btn-xs text-white" data-table="exams-list">Delete</a>
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
        return view('exam_center.exams_list.exams_list');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request->all());
        $validated = $request->validate([
            'exam_title'          => ['required', 'string'],
            'exam_fee'            => ['required', 'integer'],
            'exam_start_date'     => ['required', 'date_format:d/m/Y', 'before_or_equal:exam_end_date'],
            'exam_end_date'       => ['required', 'date_format:d/m/Y'],
            'exam_reg_start_date' => ['required', 'date_format:d/m/Y', 'before_or_equal:exam_reg_end_date'],
            'exam_reg_end_date'   => ['required', 'date_format:d/m/Y']
            ]);

        try {

            $input = $request->all();
            $input['status'] = 'active';

            // $input['exam_start_date'] = Carbon::createFromFormat('d/m/Y', $input['exam_start_date'])->format('Y-m-d');
            // $input['exam_end_date'] = Carbon::createFromFormat('d/m/Y', $input['exam_end_date'])->format('Y-m-d');

            $result = Exam::create($input);
            if ($result->wasRecentlyCreated) {
                //return view('exam_center.exam_centers.index');
                return redirect('exam-list')->with('success', 'New Exam created!');
            }else{
                return back()->withErrors($validated->errors());
            }

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit($examname_id)
    {
        $exam = Exam::where([
            'status' => 'active', 
            'id' => $examname_id,
        ])->first();
        //dd($exam->toArray());
        return view('exam_center.exams_list.exams_list', compact('exam', $exam));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam, $id)
    {
        //
        $user = \Auth::user();
        //dd($request->all());
        $validated = $request->validate([
            'exam_title'          => ['required', 'string'],
            'exam_fee'            => ['required', 'integer'],
            'exam_start_date'     => ['required', 'date_format:d/m/Y', 'before_or_equal:exam_end_date'],
            'exam_end_date'       => ['required', 'date_format:d/m/Y'],
            'exam_reg_start_date' => ['required', 'date_format:d/m/Y', 'before_or_equal:exam_reg_end_date'],
            'exam_reg_end_date'   => ['required', 'date_format:d/m/Y'],
            ]);

        try {
            $input = $request->all(); 
            $exam = Exam::where('id', $id)->first();  
            //dd($exam);
            $updated = $exam->update($input);
            if ($updated) {
                return back()->with('success', 'Your details for the exam has been updated Successfully!');
            }else{
                return back()->withErrors($validated->errors());
            }
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     * 
     **/

    public function destroy($id)
    {
        $exam = Exam::find($id);
        if ($exam) {
            $exam->delete();
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('error' => false));
        }
    }
}
