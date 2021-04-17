<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        return view('admin.profile.index');
    }

    public function profile_update(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->dob = $request->input('dob');
        $status = $user->update();
        if($status){
            return Redirect()->back()->with('success', 'Profile Updated Successfully!');
        }
        else{
            return back()->with('error', 'Something Want to Wrong!');
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'min:6'],
            'new_password' => ['required', 'string', 'min:6'],
            'confirm_password' => ['required', 'string', 'min:6','same:new_password'],
        ]);
        if (!Hash::check($request->current_password, Auth()->user()->password))
        {
            return redirect()->back()->with('error','Old Password Does not Match!');
        }
        else{
            $password = Hash::make($request->new_password);
            User::find(Auth()->user()->id)->update(['password'=>$password]);
            return redirect()->back()->with('success','Password Update Successfully!');
        }

    }

    public function send_mail($email)
    {
        $mail =[
        'body' => 'Happy Birthday! ',
        ];
        Mail::send('admin.mail.index', $mail, function($message) use ($email){
            $message->to($email);
            $message->from('hungryworld1noreply@gmail.com','Employee Management')->subject('Happy birthday!');
        });

        return redirect()->back()->with('success','Mail Sent successfully!');
    }

    public function logout(){
        FacadesSession::forget('user');
        FacadesAuth::logout();
        return redirect()->route('login')->with('success','Logout Successfully!');
    }
}
