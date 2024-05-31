<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;

class NoteModal extends ModalComponent
{
    public $noteable, $note, $body = '';
    public function render()
    {
        return view('livewire.note-modal');
    }
    public function mount($noteable_type, $noteable_id, $note_id = -1)
    {
        
        if ($noteable_id == -1) {
            $this->noteable = null;
        } else {
            $this->noteable = app($noteable_type)->find($noteable_id);
        }

        if ($note_id == -1) {
            $this->note = null;
        } else {
            $this->note = \App\Models\Note::find($note_id);
            $this->body = $this->note->body;
        }
    }
    public function save()
    {
        if ($this->note == null) {
            $this->note = $this->noteable->notes()->create([
                'author_id' => auth()->user()->id,
                'body' => $this->body,
            ]);
            $this->note->save();
        } else {
            if ($this->note->body != $this->body) {
                $this->note->body = $this->body;
                $this->note->save();
            }
        }
        $this->closeModal();
        $this->dispatch('refreshNotesCard');
    }
    public function delete()
    {
        $this->note->delete();
        $this->closeModal();
        $this->dispatch('refreshNotesCard');
    }
}
