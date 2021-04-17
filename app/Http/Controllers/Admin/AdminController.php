<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $emp_total = User::where('role','Employee')->count();
        $users_today = User::where('role','Employee')
        ->whereMonth('dob', '=', Carbon::now())
        ->whereDay('dob', '=', Carbon::now())
        ->get();

        $users_month = User::where('role','Employee')
        ->whereMonth('dob', '=', Carbon::now())
        ->whereDay('dob', '>', Carbon::now())
        ->orderBy('dob','ASC')
        ->get();
        return view('Admin.dashboard.index',compact('users_today','users_month','emp_total'));
    }
}
