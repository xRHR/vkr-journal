<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;

class CreateThesisModal extends ModalComponent
{
    public $user, $thesis, $title, $description;
    public function render()
    {
        return view('livewire.create-thesis-modal');
    }
    public function mount($user_id, $thesis_id = -1)
    {
        $this->user = \App\Models\User::find($user_id);
        if ($thesis_id == -1) {
            $this->thesis = null;
            $this->title = "";
            $this->description = "";
        } else {
            $this->thesis = \App\Models\Thesis::find($thesis_id);
            $this->title = $this->thesis->title;
            $this->description = $this->thesis->description;
        }
    }
    public function save()
    {
        $this->validate([
            'title' => 'required'
        ]);
        if ($this->thesis) {
            $this->thesis->title = $this->title;
            $this->thesis->description = $this->description;
            $this->thesis->professor_id = $this->user->professor_id;
        } else {
            $this->thesis = \App\Models\Thesis::create([
                'title' => $this->title,
                'student_id' => $this->user->id,
                'description' => $this->description,
                'professor_id' => $this->user->professor_id,
            ]);
            \App\Models\Chapter::create([
                'thesis_id' => $this->thesis->id,
                'title' => 'Глава 1',
                'order' => 1,
            ]);
            \App\Models\Chapter::create([
                'thesis_id' => $this->thesis->id,
                'title' => 'Глава 2',
                'order' => 2,
            ]);
            \App\Models\Chapter::create([
                'thesis_id' => $this->thesis->id,
                'title' => 'Глава 3',
                'order' => 3,
            ]);
        }
        $this->thesis->save();
        $this->closeModal();
        $this->redirect(route('viewThesis', ['thesis' => $this->thesis->id]));
    }
    public function delete()
    {
        $this->closeModal();
        $this->redirect(route('deleteThesis', $this->thesis->id));
    }
}
