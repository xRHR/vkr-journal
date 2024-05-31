<?php

namespace App\Livewire;

use Livewire\Component;

class TestComponent extends Component
{
    public $message;
    public function render()
    {
        return view('livewire.test-component');
    }
    public function mount($message)
    {
        $this->message = $message;
    }
}
