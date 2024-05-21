<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class RealTimeNotifications extends Component
{
    public $user;
    public $isShow;

    public function mount($id)
    {
        $this->user = User::find($id);
        $this->isShow = false;
    }
    public function toggleShow() {
        $this->isShow = !$this->isShow;
        $this->render();
    }
    public function markAsRead() {
        $this->user->unreadNotifications->markAsRead();
    }
    public function render()
    {
        return view('livewire.real-time-notifications');
    }
    public function handleClickAway() 
    {
        $this->isShow = false;
        $this->render();
    }
}
