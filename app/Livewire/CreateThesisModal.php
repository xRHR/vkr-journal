<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use Carbon\Carbon;

class CreateThesisModal extends ModalComponent
{
    public $user, $thesis, $title, $description, $defense_date;
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
            $this->defense_date = date(now()->year . '-06-20');
        } else {
            $this->thesis = \App\Models\Thesis::find($thesis_id);
            $this->title = $this->thesis->title;
            $this->description = $this->thesis->description;
            $this->defense_date = $this->thesis->defense_date;
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
            $this->thesis->defense_date = $this->defense_date;
        } else {
            $this->thesis = \App\Models\Thesis::create([
                'title' => $this->title,
                'student_id' => $this->user->id,
                'description' => $this->description,
                'professor_id' => $this->user->professor_id,
                'defense_date' => $this->defense_date
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

        if ($this->thesis->documents->count() == 0) {
            $this->addDocuments();
        }

        $this->closeModal();
        $this->redirect(route('viewThesis', ['thesis' => $this->thesis->id]));
    }
    public function addDocuments()
    {
        $deadlines = \App\Models\Deadline::all();
        $defense_date = Carbon::parse($this->thesis->defense_date);

        foreach ($deadlines as $deadline) {
            $dueDate = $defense_date->copy()->sub('days', $deadline->days_prior);
            \App\Models\ThesisDocument::create([
                'thesis_id' => $this->thesis->id,
                'document_id' => $deadline->document_id,
                'due_date' => $dueDate,
            ]);
        }
    }
    public function delete()
    {
        $this->closeModal();
        $this->redirect(route('deleteThesis', $this->thesis->id));
    }
}
