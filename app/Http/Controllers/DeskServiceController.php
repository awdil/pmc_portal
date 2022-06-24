<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeskService;
use DataTables;

class DeskServiceController extends Controller
{
    public function index(Request $request)
    {
        return view('candidate.service_desk.service_desk_form');
    }

    public function create(Request $request)
    {
        $user = \Auth::user();
        $validated = $request->validate([
            'from_email'        => ['required', 'email'],
            'to_email'          => ['required', 'email'],
            'email_subject'     => ['required', 'string'],
            'email_body'        => ['required', 'string', 'max:255'],
        ]);

        $result = \Mail::send([], [], function ($message) use($request) {

            $message->to($request->to_email)
                ->from($request->from_email)
                ->subject($request->email_subject)
                ->setBody($request->email_body, 'text/html');
        });
        $input = $request->all();
        if ($result == null) {
            $input['status'] = 'active';
            $input['user_id'] = $user->id;
            $result = DeskService::create($input);
            return redirect(route('service-desk'))->with('success', 'Request received. Our representative will get to you shortly!');
        }else{
            return redirect(route('service-desk'))->with('error', 'Error sending email!');
        }

        dd($result);
    }

    public function store(Request $request)
    {}

    public function edit($id)
    {}

    public function show(Request $request)
    {}

    public function delete(Request $request)
    {}
}
