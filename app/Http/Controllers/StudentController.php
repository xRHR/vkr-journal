<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Thesis;
use App\Models\PlanProgress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    //
    public function viewPlanProgress(Request $request, User $user)
    {
        return view('student.plan-progress', ['user' => $user]);
    }
    public function viewPlanProgressItem(Request $request, User $user, PlanProgress $plan_progress)
    {
        return view('student.plan-progress-item', ['user' => $user, 'plan_progress' => $plan_progress]);
    }
    public function viewTheses(Request $request, User $user)
    {
        return view('student.theses-list', ['user' => $user]);
    }
    public function viewThesis(Request $request,Thesis $thesis)
    {
        return view('student.thesis', ['thesis' => $thesis]);
    }
    public function deleteThesis(Request $request, Thesis $thesis)
    {
        $thesis->is_deleted = true;
        $thesis->save();
        return redirect(route('viewTheses', $thesis->student->id));
    }
    public function viewChapter(Request $request, Thesis $thesis, $order)
    {
        return view('student.chapter', ['thesis' => $thesis, 'chapter' => $thesis->chapters()->where('order', $order)->first()]);
    }
}
