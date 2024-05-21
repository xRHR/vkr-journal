<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\PlanProgress;
use App\Models\User;
use App\Models\PlanItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

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

        return redirect()->route('viewPlan', $newPlan->id)->with('success', 'План ' . $newPlan->title . ' создан');
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
        return view('professor.edit-plan', ['plan' => $plan]);
    }
    public function editPlan(Request $request, Plan $plan)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['owner_id'] = $plan->owner_id;

        $plan->update($incomingFields);

        return redirect()->route('viewPlan', $plan->id)->with('success', 'План ' . $plan->title . ' обновлен');
    }
    public function editPlanItemsForm(Request $request, Plan $plan)
    {
        return view('professor.edit-plan-items', ['plan' => $plan, 'plan_items' => $plan->items]);
    }
    public function editPlanItems(Request $request, Plan $plan)
    {
        $plan_items_table = json_decode($request->array, true);
        if (empty($plan_items_table)) {
            return response()->json(['success' => false, 'message' => 'Вы не добавили ни одного пункта'], 400);
        }
        $deleted_plan_items = PlanItem::where('plan_id', $plan->id)->get();
        foreach ($plan_items_table as $plan_item) {
            if (isset($plan_item['id'])) {
                # updating existing plan item
                $existing_plan_item = PlanItem::where('id', $plan_item['id'])->first();
                $existing_plan_item->deadline = $plan_item['deadline'];
                $existing_plan_item->title = $plan_item['title'];
                $existing_plan_item->description = $plan_item['description'];
                try {
                    $existing_plan_item->save();
                } catch (\Exception $e) {
                    return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
                }
                $deleted_plan_items->forget($deleted_plan_items->search($existing_plan_item));
            } else {
                # creating new plan item
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
                # creating new plan progress items
                foreach ($plan->participants as $participant) {
                    PlanProgress::create([
                        'plan_item_id' => $new_plan_item->id,
                        'user_id' => $participant->id
                    ]);
                }
            }
        }
        # deleting deleted plan items
        foreach ($deleted_plan_items as $deleted_plan_item) {
            $deleted_plan_item->is_deleted = true;
            $deleted_plan_item->save();
        }
    }
    public function viewStudents(Request $request)
    {
        return view('professor.students', ['users' => auth()->user()->students, 'plans' => auth()->user()->plans]);
    }
    public function appointPlan(Request $request, Plan $plan)
    {
        $student_ids = json_decode($request->array, true);
        foreach ($student_ids as $student_id) {
            $user_student = User::where('id', $student_id)->first();
            if ($user_student->professor->id == auth()->user()->id || auth()->user()->status->title == 'Администратор') {
                $past_progress = PlanProgress::where('user_id', $user_student->id)->get();
                foreach ($past_progress as $progress) {
                    if (!$progress->confirmed) {
                        $progress->delete();
                    }
                }
                $user_student->plan_id = $plan->id;
                foreach ($plan->items as $plan_item) {
                    PlanProgress::create([
                        'plan_item_id' => $plan_item->id,
                        'user_id' => $user_student->id
                    ]);
                }
                $user_student->save();
            }
            // $notif = new \App\Notifications\InviteNotification($user_student);
            // Notification::send($user_student, $notif);
            // $notif_id = $notif->toArray($user_student)['id'];
            // dd($notif_id);
        }
    }
}
