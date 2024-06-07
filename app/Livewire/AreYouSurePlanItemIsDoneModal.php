<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Notification;

class AreYouSurePlanItemIsDoneModal extends ModalComponent
{
    public $plan_progress;
    public function render()
    {
        return view('livewire.are-you-sure-plan-item-is-done-modal');
    }
    public function mount($plan_progress_id)
    {
        $this->plan_progress = \App\Models\PlanProgress::find($plan_progress_id);
    }
    public function yes()
    {
        if (auth()->user()->status->title == "Научный руководитель") {
            if ($this->plan_progress->confirmed) {
                if (!$this->plan_progress->done_at) {
                    $this->plan_progress->is_done = 0;
                }
                $this->plan_progress->confirmed = 0;
            } else {
                $this->plan_progress->confirmed = 1;
                $this->plan_progress->confirmed_at = now();
                if (!$this->plan_progress->is_done) {
                    $this->plan_progress->is_done = 1;
                }
            }
            $this->plan_progress->save();

            $notif = new \App\Notifications\PlanProgress(auth()->user(), $this->plan_progress);
            Notification::send($this->plan_progress->student, $notif);

            $this->closeModal();
            $this->redirect(route('viewPlanProgressItem', ['user' => $this->plan_progress->user_id, 'plan_progress' => $this->plan_progress->id]));
        } else {
            if ($this->plan_progress->is_done) {
                $this->plan_progress->is_done = 0;
            } else {
                $this->plan_progress->is_done = 1;
                $this->plan_progress->done_at = now();
            }
            $this->plan_progress->save();

            $notif = new \App\Notifications\PlanProgress(auth()->user(), $this->plan_progress);
            Notification::send($this->plan_progress->student->professor, $notif);

            $this->closeModal();
            $this->redirect(route('viewPlanProgressItem', ['user' => $this->plan_progress->user_id, 'plan_progress' => $this->plan_progress->id]));
        }
        
    }
}
