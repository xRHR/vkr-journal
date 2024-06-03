<?php

namespace App\Livewire;

use Livewire\Component;

class NotesCard extends Component
{
    public $listeners = ['refreshNotesCard' => '$render'];
    public $noteable;
    public $can_create_notes;
    public $card_title;
    public function render()
    {
        return view('livewire.notes-card');
    }

    public function mount($noteable_type, $noteable_id, $can_create_notes = false, $card_title = 'Заметки')
    {
        $this->card_title = $card_title;
        $this->can_create_notes = $can_create_notes;
        $this->noteable = app($noteable_type)->find($noteable_id);
    }
}
