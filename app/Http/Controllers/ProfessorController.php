<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use App\Models\PlanItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfessorController extends Controller
{
    //
    public function createPlanForm(Request $request)
    {
        return view('professor.create-plan');
    }
    public function createPlan(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['owner_id'] = auth()->id();

        $newPlan = Plan::create($incomingFields);

        return redirect("/professor/plan/{$newPlan->id}")->with('success', 'План ' . $newPlan->title . ' создан');
    }
    public function viewPlan(Plan $plan)
    {
        return view('professor.view-plan', ['plan' => $plan]);
    }
    public function viewPlans(User $user)
    {
        return view('professor.view-plans', ['plans' => $user->plans]);
    }
    public function editPlanForm(Request $request, Plan $plan)
    {
        return view('professor.edit-plan', ['plan'=> $plan]);
    }
    public function editPlan(Request $request, Plan $plan)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'description'=> 'required',
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['owner_id'] = $plan->owner_id;

        $plan->update($incomingFields);

        return redirect("/professor/plan/{$plan->id}")->with('success', 'План ' . $plan->title . ' обновлен');
    }
    public function editPlanItemsForm(Request $request, Plan $plan)
    {
        $plan_items = $plan->items;
        return view('professor.edit-plan-items', ['plan'=> $plan, 'plan_items'=> $plan_items]);
    }
    public function editPlanItems(Request $request, Plan $plan)
    {
        $plan_items_table = json_decode($request->array, true);
        if (empty($plan_items_table)) {
            return response()->json(['success' => false, 'message' => 'Вы не добавили ни одного пункта'], 400);
        }
        $plan->items()->delete();
        foreach ($plan_items_table as $plan_item) {
            $new_plan_item = new PlanItem();
            $new_plan_item->plan_id = $plan->id;
            $new_plan_item->deadline = $plan_item['deadline'];
            $new_plan_item->title = $plan_item['title'];
            $new_plan_item->description = $plan_item['description'];
            
            try {
                $new_plan_item->save();
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
            }
        }
    }
    public function viewStudents(Request $request)
    {
        return view('professor.students', ['users' => auth()->user()->students]);
    }
}
