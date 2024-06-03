<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ChapterVersions extends Component
{
    use WithFileUploads;
    public $chapter, $newAttachment = null;
    public $listeners = ['refreshAttachmentsCard' => 'refreshAttachments'];
    public function refreshAttachments()
    {

    }
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
        //dd($this->newAttachment->getMimeType());
        $this->validate([
            'newAttachment' => 'required|mimes:txt,jpg,jpeg,png,gif,pdf,doc,docx|max:10240', // Allowed file types and max size 10MB
        ], [
            'newAttachment.required' => 'Выберите файл',
            'newAttachment.mimes' => 'Тип файла не поддерживается или файл слишком короткий (поддерживаемые типы: txt, jpg, jpeg, png, gif, pdf, doc, docx)',
            'newAttachment.max' => 'Файл слишком большой (максимальный размер - 10МБ)',
        ]);
        $tmp = $this->chapter
            ->addMedia($this->newAttachment)
            ->toMediaCollection('versions');
        $this->newAttachment = null;
        $this->refreshAttachments();
        $this->js("Livewire.dispatch('openModal', {component: 'version-modal', arguments: {'media_id': " . $tmp->id . "}})");
    }

    function getFileMimeType($file) {
        if (function_exists('finfo_file')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $type = finfo_file($finfo, $file);
            finfo_close($finfo);
        } else {
            require_once 'upgradephp/ext/mime.php';
            $type = mime_content_type($file);
        }
    
        if (!$type || in_array($type, array('application/octet-stream', 'text/plain'))) {
            $secondOpinion = exec('file -b --mime-type ' . escapeshellarg($file), $foo, $returnCode);
            if ($returnCode === 0 && $secondOpinion) {
                $type = $secondOpinion;
            }
        }
    
        if (!$type || in_array($type, array('application/octet-stream', 'text/plain'))) {
            require_once 'upgradephp/ext/mime.php';
            $exifImageType = exif_imagetype($file);
            if ($exifImageType !== false) {
                $type = image_type_to_mime_type($exifImageType);
            }
        }
    
        return $type;
    }
}
