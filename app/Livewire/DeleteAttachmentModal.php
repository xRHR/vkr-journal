<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DeleteAttachmentModal extends ModalComponent
{
    public $attachment;
    public function render()
    {
        return view('livewire.delete-attachment-modal');
    }
    public function mount($attachment_id)
    {
        $this->attachment = Media::find($attachment_id);
    }
    public function yes()
    {
        $this->attachment->delete();
        $this->dispatch('refreshAttachmentsCard');

        $this->closeModal();
    }
}
