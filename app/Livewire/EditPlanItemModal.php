<?php

namespace App\Livewire;

use App\Models\PlanProgress;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class EditPlanItemModal extends ModalComponent
{
    public $plan, $plan_item, $title, $description, $deadline;
    public function render()
    {
        return view('livewire.edit-plan-item-modal');
    }
    public function mount($plan_id, $plan_item_id = -1)
    {
        $this->plan = \App\Models\Plan::find($plan_id);
        if ($plan_item_id != -1) {
            $this->plan_item = \App\Models\PlanItem::find($plan_item_id);
            $this->title = $this->plan_item->title;
            $this->description = $this->plan_item->description;
            $this->deadline = $this->plan_item->deadline;
        } else {
            $this->title = "";
            $this->description = "";
            $this->deadline = "";
        }
    }
    public function save()
    {
        $existed = true;
        if (!$this->plan_item) {
            $this->plan_item = new \App\Models\PlanItem();
            $existed = false;
        }
        $this->plan_item->plan_id = $this->plan->id;
        $this->plan_item->title = $this->title;
        $this->plan_item->description = $this->description;
        $this->plan_item->deadline = $this->deadline;
        $this->plan_item->save();
        $plan_item = $this->plan_item;
        if (!$existed) {
            DB::table('plan_progress')->insertUsing(['plan_item_id', 'user_id'], function ($query) use ($plan_item) {
                $query->select(DB::raw("{$plan_item->id}, users.id"))
                    ->from('users')
                    ->where('users.plan_id', $plan_item->plan_id);
            });
        }
        $this->closeModal();
        $this->redirect(route('editPlanItemsForm', $this->plan->id));
        
    }
    public function delete()
    {
        $this->plan_item->is_deleted = true;
        $this->plan_item->save();
        PlanProgress::where('plan_item_id', $this->plan_item->id)
            ->where('is_done', false)
            ->delete();
        $this->closeModal();
        $this->redirect(route('editPlanItemsForm', $this->plan->id));
    }
}
