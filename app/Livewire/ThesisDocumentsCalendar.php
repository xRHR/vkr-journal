<?php

namespace App\Livewire;

use App\Models\ThesisDocument;
use Livewire\Component;

class ThesisDocumentsCalendar extends Component
{
    public $thesis_id;
    public $thesis_documents;
    public $isProfessor;
    protected $rules = [
        'thesis_documents.*.due_date' => 'required|date',
    ];

    public function render()
    {
        return view('livewire.thesis-documents-calendar');
    }

    public function mount($thesis_id)
    {
        $this->thesis_id = $thesis_id;
        $this->loadThesisDocuments();
        $this->isProfessor = \App\Models\Thesis::findOrFail($this->thesis_id)->professor_id == \Auth::id();
    }

    public function loadThesisDocuments()
    {
        $this->thesis_documents = ThesisDocument::with('document')
            ->where('thesis_id', $this->thesis_id)
            ->get()
            ->toArray();
    }

    public function updateDueDates()
    {
        $this->validate();

        foreach ($this->thesis_documents as $document) {
            ThesisDocument::where('id', $document['id'])
                ->update(['due_date' => $document['due_date']]);
        }

        session()->flash('message', 'Даты успешно обновлены');
        $this->loadThesisDocuments();
    }
}
