<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = \Auth::user();
        if($user){

            if ($user->hasRole(['administrator'])) {
                return view('exam_center.admin_dashboard.index');
            } else if($user->hasRole(['examiner'])) {
                return view('exam_center.admin_dashboard.index');
            } else {
                
                $user = User::where('id', $user->id)->with([
                    'city.state.country',
                ])->first();

                $countries = Country::get();
                $states = State::where('country_id', $user->city->state->country->id)->get();
                $cities = City::where('state_id', $user->city->state->id)->get();

                return view('candidate.update_profile.index', [
                    'user' => $user,
                    'countries' => $countries,
                    'states' => $states,
                    'cities' => $cities
                ]);
                //return view('candidate.update_profile.index', ['user' => $user]);
            }
        } else {
            return redirect(route('login'));
        }
    }
    
    /*public function candidate()
    {
        return view('candidate.dashboard.index');
    }
    
    public function exam_center()
    {
        return view('exam_center.dashboard.index');
    }

    public function admin(Request $request)
    {   
        if ($request->ajax()) {

            $data = User::where('status', 'active')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '

                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Options</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="'.route("edit-candidate", ['id' => $row->id]).'">Edit</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a href="'.route("delete-candidate", ['id' => $row->id]).'" class="dropdown-item delete-record" data-table="exam-centers">Delete</a></li>
                            </ul>
                        </div>  
                    ';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.candidates.index');
    }

    */
    public function getAdminDashboardView(){
        return view('exam_center.admin_dashboard.admin_dashboard');
    }

    public function getExaminerDashboardView(){
        return view('exam_center.examiners_dashboard.examiners_dashboard');
    }
    
}
