<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;

class DeletePlanModal extends ModalComponent
{
    public $plan;
    public function render()
    {
        return view('livewire.delete-plan-modal');
    }
    public function mount($plan_id)
    {
        $this->plan = \App\Models\Plan::find($plan_id);
    }
    public function yes()
    {
        $owner_id = $this->plan->owner_id;
        \App\Models\PlanItem::where('plan_id', $this->plan->id)->update(['is_deleted' => true]);
        $this->plan->is_deleted = true;
        $this->plan->save();
        $this->closeModal();
        $this->redirect(route('viewPlans', $owner_id));
    }
}
