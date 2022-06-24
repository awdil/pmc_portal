<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request) 
	{
	    /// this method is overriden form Illuminate\Foundation\Auth\AuthenticatesUsers; class
	    $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
	        ? $this->username()
	        : 'username';

	    return [
	        $field => $request->get($this->username()),
	        'password' => $request->password,
	    ];
	}

    /*protected function redirectTo()
    {
        $user = \Auth::user();

        $user = User::where(['id' => $user->id])->with(['roles'])->first();
        dd($user->toArray());


        dd($user->hasRole(['administrator', 'examiner']));

        if ($user->hasRole(['administrator', 'examiner']))
        {
            return '/admin-home';  // admin dashboard path
        } else {
            return '/candidate-home';  // member dashboard path
        }
    }*/
}
