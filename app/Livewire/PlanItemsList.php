<?php

namespace App\Livewire;

use App\Models\Plan;
use Livewire\Component;

class PlanItemsList extends Component
{
    public $plan;
    public $listeners = ["refreshPlanItemsList" => "render"];
    public function render()
    {
        return view('livewire.plan-items-list');
    }
    public function mount($plan_id)
    {
        $this->plan = Plan::find($plan_id);
    }
}
