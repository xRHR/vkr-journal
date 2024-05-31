<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AttachmentsCard extends Component
{
    use WithFileUploads;

    public $model_exists;
    public $attachable;
    public $attachments;
    public $can_attach;
    public $newAttachment = null;
    public $card_title;
    public $cnt;
    protected $listeners = ['refreshAttachmentsCard' => 'refreshAttachments'];
    public function render()
    {
        return view('livewire.attachments-card');
    }
    public function refreshAttachments()
    {
        $this->cnt++;
        $this->attachments = $this->attachable->getMedia('attachments');
    }
    public function mount($attachable_type, $attachable_id, $can_attach, $card_title = 'Вложения')
    {
        $this->cnt = 0;
        if ($attachable_id == -1) {
            $this->model_exists = false;
            $this->can_attach = false;
            $this->attachable = null;
            $this->card_title = $card_title;
            $this->attachments = collect();
        } else {
            $this->model_exists = true;
            $this->can_attach = $can_attach;

            $this->card_title = $card_title;

            $this->attachable = app($attachable_type)->find($attachable_id);

            $this->attachments = $this->attachable->getMedia('attachments');
        }
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
        $this->attachable
            ->addMedia($this->newAttachment)
            ->withCustomProperties(['uploaded_by' => auth()->user()->id])
            ->toMediaCollection('attachments');
        $this->newAttachment = null;
        $this->refreshAttachments();
    }
    public function deleteAttachment($attachment_id)
    {
        $attachment = Media::find($attachment_id);

        if ($attachment) {
            $attachment->delete();
        }
    }
}
