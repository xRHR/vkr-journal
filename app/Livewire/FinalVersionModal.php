<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Notification;

class FinalVersionModal extends ModalComponent
{
    public $chapter, $version;
    public function render()
    {
        return view('livewire.final-version-modal');
    }
    public function mount($chapter_id, $version_id)
    {
        $this->chapter = \App\Models\Chapter::find($chapter_id);
        $this->version = \App\Models\Media::find($version_id);
    }
    public function yes()
    {
        if (auth()->user()->id == $this->chapter->thesis->professor_id) {
            $this->chapter->final_version_id = $this->version->id;
            $this->chapter->save();
            $this->dispatch('refreshAttachmentsCard');
            
            $notif = new \App\Notifications\FinalVersion(auth()->user(), $this->chapter);
            Notification::send($this->chapter->thesis->student, $notif);
        }

        else if (auth()->user()->id == $this->chapter->thesis->student_id) {
            $notif = new \App\Notifications\FinalVersion(auth()->user(), $this->chapter);
            Notification::send($this->chapter->thesis->professor, $notif);
        }
        $this->closeModal();
    }
}
