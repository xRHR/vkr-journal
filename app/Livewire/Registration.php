<?php

namespace App\Livewire;

use Livewire\Component;

class Registration extends Component
{
    public $statuses, $chosen_status, $groups;
    public function render()
    {
        return view('livewire.registration');
    }
    public function mount($chosen_status = null)
    {
        if (auth()->user()->status->title == 'Администратор') {
            $this->statuses = \App\Models\Status::all();
            if ($chosen_status) {
                $this->chosen_status = \App\Models\Status::find($chosen_status);
                if ($this->chosen_status->title == 'Студент') {
                    $this->groups = \App\Models\Group::all();
                }
            }
        } else {
            $this->groups = \App\Models\Group::all();
            $this->chosen_status = \App\Models\Status::where('title', 'Студент')->first();
        }
    }
    public function chooseStatus($status_id)
    {
        $this->chosen_status = \App\Models\Status::find($status_id);
        if ($this->chosen_status->title == 'Студент') {
            $this->groups = \App\Models\Group::all();
        } else {
            $this->groups = null;
        }
        $this->setUrl();
    }
    public function setUrl()
    {
        $this->dispatch('setUrl', route('registerForm', ['chosen_status' => $this->chosen_status]));
    }
}
