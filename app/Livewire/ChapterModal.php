<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;

class ChapterModal extends ModalComponent
{
    public $chapter, $thesis, $title;
    public function render()
    {
        return view('livewire.chapter-modal');
    }
    public function mount($thesis_id, $chapter_id = -1)
    {
        if ($chapter_id == -1) {
            $this->chapter = null;
            $this->title = "";
        } else {
            $this->chapter = \App\Models\Chapter::find($chapter_id);
            $this->title = $this->chapter->title;
        }
        $this->thesis = \App\Models\Thesis::find($thesis_id);
    }
    public function save()
    {
        if ($this->chapter == null) {
            $chapter = new \App\Models\Chapter([
                'title' => $this->title,
                'thesis_id' => $this->thesis->id,
                'order' => $this->thesis->chapters()->max('order') + 1
            ]);
            $chapter->save();
        } else {
            $this->chapter->title = $this->title;
            $this->chapter->save();
        }
        $this->closeModal();
        return redirect(route('viewThesis', ['thesis' => $this->thesis->id]));
    }
    public function delete()
    {
        $this->closeModal();
    }
}
