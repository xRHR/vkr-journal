<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    //
    public function viewPlanProgress(Request $request, User $user)
    {
        return view('student.plan-progress', ['user' => $user]);
    }
}
