<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ChapterVersions extends Component
{
    use WithFileUploads;
    public $chapter, $newAttachment = null;
    public function render()
    {
        return view('livewire.chapter-versions');
    }
    public function mount($chapter_id)
    {
        $this->chapter = \App\Models\Chapter::find($chapter_id);
    }
    public function addAttachment()
    {
        $this->validate([
            'newAttachment' => 'required|mimes:txt,jpg,jpeg,png,gif,pdf,doc,docx|max:10240', // Allowed file types and max size 10MB
        ], [
            'newAttachment.required' => 'Выберите файл',
            'newAttachment.mimes' => 'Тип файла не поддерживается (поддерживаемые типы: txt, jpg, jpeg, png, gif, pdf, doc, docx)',
            'newAttachment.max' => 'Файл слишком большой (максимальный размер - 10МБ)',
        ]);
        $this->chapter
            ->addMedia($this->newAttachment)
            ->toMediaCollection('attachments');
        $this->newAttachment = null;
        $this->refreshAttachments();
    }
}
