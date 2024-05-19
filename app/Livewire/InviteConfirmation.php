<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use App\Models\User;
use App\Models\Invite;

class InviteConfirmation extends ModalComponent
{
    public $inviter, $invitee;
    public function render()
    {
        return view('livewire.invite-confirmation');
    }
    public function mount($inviter_id, $invitee_id)
    {
        $this->inviter = User::find($inviter_id);
        $this->invitee = User::find($invitee_id);
    }
    public function createInvite()
    {
        Invite::create([
            'inviter_id' => $this->inviter->id,
            'invitee_id' => $this->invitee->id,
            'accepted' => 0
        ]);
        $this->invitee->notify(new \App\Notifications\InviteNotification($this->inviter));
        $this->closeModal();
    }
}
