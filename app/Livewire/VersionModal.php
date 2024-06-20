<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use App\Models\Media;

class VersionModal extends ModalComponent
{
    public $version, $comment;
    public function render()
    {
        return view('livewire.version-modal');
    }
    public function mount($media_id)
    {
        $this->version = Media::find($media_id);
        $this->comment = $this->version->getCustomProperty('comment');
    }
    public function save()
    {
        $this->version->setCustomProperty('comment', $this->comment);
        $this->version->save();
        $this->comment = "";
        $this->closeModal();
        $this->dispatch('refreshAttachmentsCard');
    }
}
