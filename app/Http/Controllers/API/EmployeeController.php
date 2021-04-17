<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = array(
            "name" => "required|alpha",
            "email" => "required|email",
            "phone" => "required|digits:10",
        );
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails())
        {
            return $validator->errors();
        }
        else
        {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make('12345678');
            $user->phone = $request->input('phone');
            $user->dob = $request->input('dob');
            $user->role = 'Employee';
            $status = $user->save();
            if ($status == 1) {
                return response()->json(['success' => true, 'data' => $user, 'message' => 'success']);
            }else {
                return response()->json(['error' => 'Error in Issue'], 401);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return User::get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rule = array(
            "name" => "required|alpha",
            "email" => "required|email",
            "phone" => "required|digits:10",
        );
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails())
        {
            return $validator->errors();
        }
        else
        {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->dob = $request->input('dob');
            $status = $user->save();
            if ($status == 1) {
                return response()->json(['success' => true, 'data' => $user, 'message' => 'success']);
            }else {
                return response()->json(['error' => 'Error in Issue'], 401);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}
