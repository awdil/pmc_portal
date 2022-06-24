<?php

namespace App\Http\Controllers;

use App\Models\ExamCenter;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Validation\Rule;
use DataTables;

class ExaminerExamCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
    public function show()
    {
        //
    }

    public function edit()
    {
       
    }

    public function update(Request $request)
    {
       
        try {

            $input = $request->all();
            $input['status'] = 'active';
            $user = User::findOrFail($request->user_id);

            $result = $user->examiner_exam_centers()->sync($request->exam_center_id);

            if ($result) {
                return response()->json(['status' => 'success', 'msg' => 'Exam center is assigned to the examiner!'], 200);
            }else{
                return response()->json(['status' => 'error', 'msg' => 'Exam center is not assigned to the examiner!'], 200);
            }

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function destroy()
    {
        
    }

    public function assignExamCenter(Request $request, $id)
    {
        $examcenters = ExamCenter::all();
        $user = User::find($id);
        return view('exam_center.assign_examcenter.assign_examcenter', [
            'user'          => $user,
            'examcenters'   => $examcenters,
        ]);
    }

    
}
