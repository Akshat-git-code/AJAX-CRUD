<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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

    // login ajax
    public function check(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if(Auth::attempt(array('email' => $email, 'password' => $password)))
        {
            if(auth()->user()->role === 'Admin')
            {
                return response()->json([1]);
            }
            else
            {
                return response()->json([2]);
            }
        }
        else
        {
            return response()->json([3]);
        }
    }

    // simple
    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credential = array('email' => $input['email'], 'password' => $input['password']);
        if(Auth::attempt($credential)) {
            if(auth()->user()->role === 'Admin')
            {
                return redirect()->route('dashboard')->with('success','Welcome back!');
            }
            else
            {
                return redirect()->route('employee-dashboard')->with('success','Welcome back!');
            }
        }
        else{
            return redirect()->route('login')->with('error','Email-Address Or Password Are Wrong.');
        }
    }
}
