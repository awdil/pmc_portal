<?php

namespace App\Http\Controllers;

use App\Exports\CandidatesExport;
use App\Exports\ExaminerExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Role;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\ExamCenter;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ExamRegistration;
use DataTables;
use Illuminate\Support\Carbon;
use App\Models\Permission;
use Laratrust\Helper;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

use File;

class UserController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        
    	$user = User::where(['id'=>$user->id])->with([
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
    }

    public function store(Request $request)
    {
    	$user = \Auth::user();
        $validated = $request->validate([
	        'name'              => ['required', 'string', 'max:255'],
            'gender'            => ['required', 'string', 'max:20'],
            'email'             => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'mobile_number'     => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'cnic_number'       => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'cnic_expire_date'  => ['nullable'],
            'country_id'        => ['required', 'integer'],
            'state_id'          => ['required', 'integer'],
            'city_id'           => ['required', 'integer'],
            'cnic_front_img'    => ['mimes:png,jpg,jpeg', 'max:2048'],
            'cnic_back_img'     => ['mimes:png,jpg,jpeg', 'max:2048'],
        ],[
            'country_id.required'       =>'Country name field is required!',
            'city_id.required'          =>'City name field is required!',
            'state_id.required'         =>'Province name field is required!',
            'cnic_front_img.mimes'      => "You must use the valid file type for CNIC front picture file, png, jpg, jpeg",
            'cnic_front_img.max'        => "Maximum file size to upload is 1MB (2048 KB). If you are uploading a picture, try to reduce its resolution to make it under 1MB",
            'cnic_back_img.mimes'       => "You must use the valid file type for CNIC back picture file, png, jpg, jpeg",
            'cnic_back_img.max'         => "Maximum file size to upload is 1MB (2048 KB). If you are uploading a picture, try to reduce its resolution to make it under 1MB"
        ]);

	    try {

	    	$input = $request->all();
	    	if($request->hasfile('profile_picture')){
	    		$path = public_path().'/uploads/candidates_images/';
		    	if(!File::exists($path)) {
					File::makeDirectory($path, $mode = 0777, true, true);
				}
		    	$filename = $request->profile_picture->getClientOriginalName();
		        $destination_path = public_path('uploads/candidates_images');
		        $new_filename = Str::random(32) . '.' . $request->profile_picture->getClientOriginalExtension();
		        $request->profile_picture->move($destination_path, $new_filename);

		        $input['profile_picture'] = $new_filename;
	    	}
            if($request->hasfile('cnic_front_img')){
	    		$path = public_path().'/uploads/candidates_images/';
		        $destination_path = public_path('uploads/candidates_images');
		        $new_filename = Str::random(32) . '.' . $request->cnic_front_img->getClientOriginalExtension();
		        $request->cnic_front_img->move($destination_path, $new_filename);
		        $input['cnic_front_img'] = $new_filename;
	    	}
            if($request->hasfile('cnic_back_img')){
	    		$path = public_path().'/uploads/candidates_images/';
		        $destination_path = public_path('uploads/candidates_images');
		        $new_filename = Str::random(32) . '.' . $request->cnic_back_img->getClientOriginalExtension();
		        $request->cnic_back_img->move($destination_path, $new_filename);
		        $input['cnic_back_img'] = $new_filename;
	    	}
            //$input['cnic_expire_date'] = Carbon::createFromFormat('d/m/Y', $input['cnic_expire_date'])->format('Y-m-d');
            $user = User::find($user->id);
            $result = $user->update($input);

	        if ($result) {
                return redirect(route('candidate-home'))->with('success', 'Candidate info updataed successfully!');
	        }else{
	        	return back()->withErrors($validated->errors());
	        }

	    } catch (QueryException $exception) {
	        throw new InvalidArgumentException($exception->getMessage());
	    }
    }

	public function edit($id)
    {
        $user = User::where([
            'id' => $id,
        ])->first();
        if($user->hasRole('user')){ //candidates list
            
        }
        if($user->hasRole('examiner')){ //examiners list

        }
        if($user->hasRole('administrator')){ //exam centers list
            
        } 
        //dd($user->toArray());
        return view('exam_center.exams_list.exams_list', compact('exam', $exam));
    }

    public function update(Request $request, $user_id)
    {
        $user = \Auth::user();
        $validated = $request->validate([
            'name'              => ['required', 'string'],
            'urdu_name'         => ['required', 'string'],
            'gender'            => ['required', 'string'],
            'father_name'       => ['required', 'string'],
            'cnic_expire_date'  => ['required', 'string'],
            'email'             => [
                                    'required', 
                                    'string', 
                                    'email', 
                                    'max:255', 
                                    Rule::unique('users')->ignore($user_id)
                                ],
            'phone_number'      => [
                                    'required', 
                                    'string', 
                                    'max:11', 
                                    'min:11', 
                                    Rule::unique('users')->ignore($user_id)
                                ],
            'cnic_number'       => [
                                    'required', 
                                    'string', 
                                    'max:13', 
                                    'min:13', 
                                    Rule::unique('users')->ignore($user_id)
                                ],
            'country_id'    => ['required', 'integer'],
            'state_id'      => ['required', 'integer'],
            'city_id'       => ['required', 'integer']
            ],
            [
                'country_id.required'   =>'Country name field is required!',
                'city_id.required'      =>'City name field is required!',
                'state_id.required'     =>'Province name field is required!',
            ]
        );
    }

	public function examiners(Request $request)
    {
    	$user = \Auth::user();
      	if ($request->ajax()) {

            $country_id = request()->get('country_id', 0);
            $state_id = request()->get('state_id', 0);
            $city_id = request()->get('city_id', 0);
            $search_term = request()->get('search_term', 0);

		    $data = User::whereRoleIs('examiner')->with(['city']);

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
	 	return view('exam_center.examiners_list.examiners_list', [
             'country' => $country 
         ]);
    }

    public function dashboard()
    {
    	$user = \Auth::user();
	 	return view('candidate.dashboard.index', ['user' => $user]);
    }

    public function ExportCandidates(Request $request)
    {
        $user = \Auth::user();
        $country_id = $request->country_id;
        $state_id = $request->state_id;
        $city_id = $request->city_id;
        $exam_center_id = $request->exam_center_id;
        $search_term = $request->search_term;

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
        $now = Carbon::now()->format('Y-m-d');
        return Excel::download(new CandidatesExport($data), $now.'-candidates-list.xlsx');
    }

    public function ExportExaminers(Request $request)
    {
        $country_id = request()->get('country_id', 0);
            $state_id = request()->get('state_id', 0);
            $city_id = request()->get('city_id', 0);
            $search_term = request()->get('search_term', 0);

		    $data = User::whereRoleIs('examiner')->with(['city']);

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
            $now = Carbon::now()->format('Y-m-d');
            return Excel::download(new ExaminerExport($data), $now.'-examiners-list.xlsx');
    }

    public function CandidatetTree()
    {
	 	return view('exam_center.tree_view.tree_view');
    }

    //  delete any kind of user 
    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('error' => false));
        }
    }

    public function examinerExamCenters(Request $request){

        $exam_centers = ExamCenter::where(['status' => 'active'])->get();

        foreach ($exam_centers as $key => $v) {

            if($request->user_id) {
                $check = \DB::table('examiner_exam_centers')->where(['exam_center_id' => $v->id, 'user_id' => $request->user_id])->count();
                $v->checked = $check > 0 ? 'checked' : '';
            }
        }

        return response()->json(['data' => $exam_centers], 200);
    }

    public function profilePictureUpdate(Request $request) {

		$base64_image = $request->image;
		$path = '/uploads/candidates_images/';

		$base64_image = str_replace('data:image/png;base64,', '', $base64_image);
		$base64_image = str_replace(' ', '+', $base64_image);
		$image_name   = Str::random(32) . '.png';

        $candidate_image = public_path().$path.$image_name;

        $result = file_put_contents($candidate_image, base64_decode($base64_image));

		if ($result) {

			$params = array(
		  		'url' =>  asset('uploads/candidates_images/' . $image_name),
		  		'models' => 'nudity,wad,offensive,faces,text-content,face-attributes,text',
		  		'api_user' => '1858089163',
		  		'api_secret' => 'TGRN42aCv6JTErW9jLkP',
			);

        	$query_params = http_build_query($params);
			$url = "https://api.sightengine.com/1.0/check.json?".$query_params;

		    $response = Http::get($url);
		    $resp = $response->object();

		    if($resp->status == 'success' && count($resp->faces) == 1 && $resp->faces[0]->attributes->sunglasses < 0.5){

		    	\Auth::user()->update([
					'profile_picture' => $image_name, 
					'updated_at' => now()
				]);
		    }

			return response()->json($resp, 200);
		}
	}

    // public function serviceDesk(){
    //     return view('candidate.service_desk.service_desk_form');
    // }

    // public function raiseSupportTicket(Request $request){
    //     // dd($request->all());

    //     $validated = $request->validate([
    //         'from_email'        => ['required', 'email'],
    //         'to_email'          => ['required', 'email'],
    //         'email_subject'     => ['required', 'string'],
    //         'email_body'        => ['required', 'string', 'max:255'],
    //     ]);

    //     $result = \Mail::send([], [], function ($message) use($request) {

    //         $message->to($request->to_email)
    //             ->from($request->from_email)
    //             ->subject($request->email_subject)
    //             ->setBody($request->email_body, 'text/html');
    //     });

    //     if ($result == null) {

    //         return redirect(route('service-desk'))->with('success', 'Request received. Our representative will get to you shortly!');
    //     }else{
    //         return redirect(route('service-desk'))->with('error', 'Error sending email!');
    //     }

    //     dd($result);
    // }

    public function smsVerification(Request $request)
    {
    	$user = \Auth::user();
        $input = $request->all();
    
        if($user->mobile_number == $input['mobile_number'] && $user->mobile_verified_at != null){
            // already verified 
        }else{
            $code = mt_rand(1234, 9876);
            $user->mobile_number = $input['mobile_number'];
            $user->mobile_verification_code = $code;
            $user->mobile_verified_at = null;
            $user->save();
            
            $message = "You mobile number verification code is ".$code;

            $user->sendSmsShortcode($message, $input['mobile_number']);
        }

    }
    public function verifyFourDigitCode(Request $request)
    {
    	$user = \Auth::user();
        $input = $request->all();
        if ($user->mobile_verification_code == $input['mobile_verification_code']) {
            $user->mobile_verified_at = now();
            $user->save();
            return response()->json(['status' => 'success', 'msg' => 'Four digit code verified successfully '], 200);
        }else{
            return response()->json(['status' => 'error', 'msg' => 'Four digit code not matched!'], 200);
        }
    }

    public function userRolesPermissionList(Request $request){
        //$roles = User::with(['roles','permissions'])->get();
        //dd($roles->toArray());
        //$count = ($row->permissions->count());
        $modelsKeys = array_keys(Config::get('laratrust.user_models'));
        $modelKey = $request->get('model') ?? $modelsKeys[0] ?? null;
        if ($request->ajax()) {
            $data = User::with(['roles','permissions'])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '

                    <div class="btn-group">
                        <a class="btn-primary btn btn-xs" href="'.route("edit-with-role-permissions", ['id' => $row->id]).'">Edit</a>
                    </div>';

                    return $actionBtn;
                })
                ->addColumn('roles', function($row){
                    $count = ($row->roles->count());
                    return $count;
                })
                ->addColumn('permissions', function($row){
                    $count = ($row->permissions->count());
                    return $count;
                })
                ->rawColumns(['action', 'roles', 'permissions'])
                ->make(true);
        }
        return view('admin.role_permissions_assignment.index',[
            'models' => $modelsKeys,
            'modelKey' => $modelKey,
        ]);
    }
    
    public function editUseRolesPermissions(Request $request, $id){
        //$user = User::where(['id' => $id])->with(['roles','permissions'])->first();
        
        $user = User::query()
            ->with(['roles:id,name', 'permissions:id,name'])
            ->findOrFail($id);
        //$roles = Role::orderBy('display_name', 'ASC')->get();
        $roles = Role::orderBy('name')->get(['id', 'name', 'display_name'])
            ->map(function ($role) use ($user) {
                $role->assigned = $user->roles
                ->pluck('id')
                    ->contains($role->id);
                $role->isRemovable = Helper::roleIsRemovable($role);

                return $role;
            });
        $permissions = Permission::orderBy('name')
        ->get(['id', 'name', 'display_name'])
        ->map(function ($permission) use ($user) {
            $permission->assigned = $user->permissions
                ->pluck('id')
                ->contains($permission->id);

            return $permission;
        });

        //dd($roles->toArray());
        //$permissions = Permission::orderBy('display_name', 'ASC')->get();
        
        //$user_roles = $user->toArray();
        //$data['user'] = $user; 
        //$data['user_roles'] = $user_roles['roles']; 
        //dd($data['user_roles']);
        //$data['user_permissions'] = $user_roles['permissions'];
        //dd($data['user_permissions']);
        //$data['roles'] = $roles;
        //$data['permissions'] = $permissions;

        $data['roles'] = $roles;
        $data['permissions'] = $permissions;
        $data['user'] = $user;

        return view('admin.role_permissions_assignment.edit', $data);
    }

    public function editUseRolesPermissionsNOO(Request $request, $modelId)
    {
        $modelKey = $request->get('model');
       
        $userModel = Config::get('laratrust.user_models')[$modelKey] ?? null;

        // if (!$userModel) {
        //     Session::flash('laratrust-error', 'Model was not specified in the request');
        //     return redirect(route('laratrust.roles-assignment.index'));
        // }

        $user = $userModel::query()
            ->with(['roles:id,name', 'permissions:id,name'])
            ->findOrFail($modelId);

        $roles = $this->rolesModel::orderBy('name')->get(['id', 'name', 'display_name'])
            ->map(function ($role) use ($user) {
                $role->assigned = $user->roles
                ->pluck('id')
                    ->contains($role->id);
                $role->isRemovable = Helper::roleIsRemovable($role);

                return $role;
            });
        if ($this->assignPermissions) {
            $permissions = $this->permissionModel::orderBy('name')
                ->get(['id', 'name', 'display_name'])
                ->map(function ($permission) use ($user) {
                    $permission->assigned = $user->permissions
                        ->pluck('id')
                        ->contains($permission->id);

                    return $permission;
                });
        }


        // return View::make('laratrust::panel.roles-assignment.edit', [
        //     'modelKey' => $modelKey,
        //     'roles' => $roles,
        //     'permissions' => $this->assignPermissions ? $permissions : null,
        //     'user' => $user,
        // ]);

        return view('admin.role_permissions_assignment.edit',[
            'modelKey' => $modelKey,
            'roles' => $roles,
            'permissions' => $this->assignPermissions ? $permissions : null,
            'user' => $user,
        ]);
    }

    public function updateUseRolesPermissions(Request $request, $id)
    {
        $modelKey = 'users';
        $userModel = Config::get('laratrust.user_models')[$modelKey] ?? null;

        if (!$userModel) {
        //'Model was not specified in the request';
        //return redirect()->back()->with('error','Unfortunately not able to update the role assignment');
        }

        $user = $userModel::findOrFail($id);
        $user->syncRoles($request->get('roles') ?? []);        
        $user->syncPermissions($request->get('permissions') ?? []);

        return redirect()->back()->with('success', 'Your details for the user Successfully Updated!');;
    }
}
