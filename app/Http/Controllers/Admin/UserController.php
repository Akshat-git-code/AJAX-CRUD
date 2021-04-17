<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role','Employee')->get();
        return view('Admin.employee.index', compact('users'));
    }

    public function create()
    {
        return view('Admin.employee.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'bail|required|alpha',
            'email' => 'bail|required|regex:/^[a-zA-Z0-9._]+@[a-zA-Z0-9._]+\.[a-zA-Z]{2,4}$/|unique:users,email',
            'phone' => 'bail|required|digits:10',
            'dob' => 'bail|required|date',
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make('12345678');
        $user->phone = $request->input('phone');
        $user->dob = $request->input('dob');
        $user->role = 'Employee';
        $status = $user->save();
        if($status){
            return response()->json([1]);
        }
        else{
            return back()->with('error', 'Something Want to Wrong!');
        }
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        return view('Admin.employee.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|alpha',
            'email' => 'bail|required|regex:/^[a-zA-Z0-9._]+@[a-zA-Z0-9._]+\.[a-zA-Z]{2,4}$/',
            'phone' => 'required|digits:10',
            'dob' => 'required|date',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->dob = $request->input('dob');
        $status = $user->save();
        if($status){
            return response()->json([1]);
            // return Redirect()->route('user.index')->with('success', 'Employee Updated Successfully!');
        }
        else{
            return back()->with('error', 'Something Want to Wrong!');
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Employee Remove Successfully!');
    }
}
