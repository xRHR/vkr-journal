<?php

namespace App\Livewire;

use Livewire\Component;

class EditPlanItemModal extends Component
{
    public $title, $desciption, $deadline;
    public function render()
    {
        return view('livewire.edit-plan-item-modal');
    }
    public function mount($title, $description, $deadline)
    {
        $this->title = $title;
        $this->desciption = $description;
        $this->deadline = $deadline;
    }
}
