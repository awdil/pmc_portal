<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CandidateDocument;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\StoreFileRequest;
use App\Models\Institution;
use Illuminate\Support\Str;
use DataTables;
use File;

class CandidateDocumentController extends Controller
{
    //
    public function index(Request $request)
    {
    	$user = \Auth::user();
        $documents = CandidateDocument::where(['status' => 'active', 'user_id'=> $user->id])->with(['institute'])->get();
        //dd($documents->toArray());
        $institutions = Institution::where(['status' => 'active'])->get();
    	

	 	return view('candidate.documents_upload.index', ['user' => $user, 'documents' => $documents, 'institutions' => $institutions]);
    }

    public function store(Request $request)
    {
    	$user = \Auth::user();
        $candidate_id =  $user->id;
    	$user = User::where(['id'=>$user->id]);
        
        $validated = $request->validate([
	        'academic_achievement'          => ['required', 'string', 'max:100'],
            'institute_id'        		    => ['required', 'string', 'max:100'],
            'roll_number'        			=> ['required', 'string', 'max:50'],
            'total_marks' 					=> ['required', 'integer', 'min:'.$request->obtain_marks],
            'obtain_marks'   				=> ['required', 'integer', 'min:0', 'max:'.$request->total_marks],
            'grade'        					=> ['required', 'alpha', 'max:1'],
            'passing_year'       		 	=> ['required', 'integer'],
            'document'                      => ['required', 'mimes:pdf,png,jpg', 'max:1000'],
		]);

	    try {

	    	$input = $request->all();
            $input['user_id'] = $candidate_id;
	    	if($request->hasfile('document')){

	    		$path = public_path().'/uploads/candidates_documents/';
		    	if(!File::exists($path)) {
					File::makeDirectory($path, $mode = 0777, true, true);
				}

		    	$filename = $request->document->getClientOriginalName();
		        $destination_path = public_path('uploads/candidates_documents');
		        $new_filename = Str::random(32) . '.' . $request->document->getClientOriginalExtension();
		        $request->document->move($destination_path, $new_filename);

                $input['document'] = $new_filename;
	    	}

            $input['status'] = 'active';

            $result = CandidateDocument::create($input);
            if ($result->wasRecentlyCreated) {
                return back()->with('success', 'Your details and file is submitted Successfully');
	        }else{
                return back()->withErrors($validated->errors());
            }

	    } catch (QueryException $exception) {
	        throw new InvalidArgumentException($exception->getMessage());
	    }
    }

    public function viewDocument($document_name)
    {
        return response()->download(public_path().'/uploads/candidates_documents/'.$document_name, $document_name, [], 'inline');
    }

	public function delete($id)
    {
        $isdelete = CandidateDocument::find($id);
        if ($isdelete) {
            $isdelete->delete();
            return redirect(route('documents-upload'))->with('success', 'Your record and file is deleted Successfully!');
        } else {
            return redirect(route('documents-upload'))->with('success', 'Your record and file is deleted Successfully!');
        }
    }
}
