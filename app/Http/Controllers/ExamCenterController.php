<?php

namespace App\Http\Controllers;
use App\Models\ExamCenter;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DataTables;

class ExamCenterController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $country    = Country::get();

        if ($request->ajax()) {
            
            $data = ExamCenter::with(['city'])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '

                    <div class="btn-group">
                        <a class="btn-primary btn btn-xs" href="'.route("edit-exam-center", ['id' => $row->id]).'">Edit</a>
                        <a class="btn-danger btn btn-xs text-white" data-table="exam-centers" href="'.route("delete-exam-center", ['id' => $row->id]).'">Delete</a>
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


        return view('exam_center.exam_centers.index', compact('country'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    	
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validated = $request->validate([
            'name'          => ['required', 'string'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:exam_centers'],
            'phone_number'  => ['required', 'string', 'max:11', 'min:11', 'unique:exam_centers'],
            'country_id'    => ['required', 'integer'],
            'state_id'      => ['required', 'integer'],
            'city_id'       => ['required', 'integer'],
            'capacity'      => ['required', 'integer'],
            'address'       => ['required' , 'string'],
            ],
            [
                'country_id.required' =>'Country name field is required!',
                'city_id.required' =>'City name field is required!',
                'state_id.required' =>'Province name field is required!',
            ]
        );

        try {

            $input = $request->all();
            $input['status'] = 'active';

            $result = ExamCenter::create($input);
            if ($result->wasRecentlyCreated) {
                //return view('exam_center.exam_centers.index');
                return redirect('exam-centers')->with('success', 'Exam center created!');
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
     * @param  \App\Models\ExamCenter  $ExamCenter
     * @return \Illuminate\Http\Response
     */
    public function show(ExamCenter $ExamCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamCenter  $ExamCenter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $examcenter = ExamCenter::where([
            'id' => $id,
        ])->with([
            'city.state.country'
        ])->first();
       
        $countries    = Country::get();
        $states      = State::get();
        $cities       = City::get();
       
        return view('exam_center.exam_centers.index', [
            'examcenter' => $examcenter, 
            'countries' => $countries, 
            'states' => $states, 
            'cities' => $cities, 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExamCenter  $ExamCenter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamCenter $ExamCenter, $id)
    {

         $validated = $request->validate([
            'name'          => ['required', 'string'],
            'email'         => [
                                'required', 
                                'string', 
                                'email', 
                                'max:255',
                                Rule::unique('exam_centers')->ignore($id),
                               ],
            'phone_number'  => [
                                'required', 
                                'string', 
                                'max:11', 
                                'min:11', 
                                Rule::unique('exam_centers')->ignore($id),
                                ],
            'country_id'    => ['required', 'integer'],
            'state_id'      => ['required', 'integer'],
            'city_id'       => ['required', 'integer'],
            'address'       => 'required',
            ],[
                'country_id.required'   =>'Country name field is required!',
                'city_id.required'      =>'City name field is required!',
                'state_id.required'     =>'Province name field is required!',
            ]
        );
        try {
            $examcenter = ExamCenter::findOrFail($id);
            $input = $request->all();
            $update = $examcenter->update($input);
            if ($update) {
                return redirect('exam-centers')->with('success', 'Exam center update Successfully!');
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
     * @param  \App\Models\ExamCenter  $ExamCenter
     * @return \Illuminate\Http\Response
     */

    public function destroy(ExamCenter $ExamCenter)
    {
        //
    }

    public function delete($id)
    {
        $examcenter = ExamCenter::find($id);
        if ($examcenter) {
            $examcenter->delete();
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('error' => false));
        }
    }

    

    public function getExamCeter(Request $request, ExamCenter $examcenter)
    {
        $data = $examcenter->getData();

        return \DataTables::of($data)
            ->addColumn('Actions', function($data) {
                return '<a class="btn btn-success btn-sm" href="'.url('edit-exam-center/'.$data->id).'" ><i class="fa fa-edit text-green"></i> Edit </a>
                        <a class="btn btn-danger btn-sm"  href="'.url('edit-exam-center/delete/'.$data->id).'"><i class="fa fa-trash text-red"></i> Delete </a>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }


}
