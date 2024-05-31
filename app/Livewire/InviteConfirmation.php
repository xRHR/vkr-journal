<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Invite;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Notification;

class InviteConfirmation extends ModalComponent
{
    public $inviter, $invitee, $you_already_invited, $you_are_invited, $detach;
    public function render()
    {
        return view('livewire.invite-confirmation');
    }
    public function mount($inviter_id, $invitee_id, $detach = false)
    {
        $this->detach = $detach;
        $this->inviter = User::find($inviter_id);
        $this->invitee = User::find($invitee_id);
        $this->you_already_invited = count(Invite::where('inviter_id', $this->inviter->id)->where('invitee_id', $this->invitee->id)->get());
        $this->you_are_invited = count(Invite::where('inviter_id', $this->invitee->id)->where('invitee_id', $this->inviter->id)->get());
    }
    public function createInvite()
    {
        if ($this->you_are_invited) {
            $student = null;
            if ($this->inviter->status->title == "Студент") {
                $student = $this->inviter;
                Invite::where('invitee_id', $this->inviter->id)->delete();
            } else {
                $student = $this->invitee;
            }
            Invite::where('inviter_id', $student->id)->delete();
            Invite::where('invitee_id', $student->id)->delete();
            $student->professor_id = ($student == $this->inviter ? $this->invitee : $this->inviter)->id;
            $student->save();
        } else {
            $notif = new \App\Notifications\InviteNotification($this->inviter);
            Notification::send($this->invitee, $notif);

            Invite::create([
                'inviter_id' => $this->inviter->id,
                'invitee_id' => $this->invitee->id,
            ]);
        }
        $this->closeModal();
        $this->redirect(route('profile', $this->invitee->id));
    }
    public function cancelInvite()
    {
        if ($this->you_already_invited) {
            Invite::where('inviter_id', $this->inviter->id)->where('invitee_id', $this->invitee->id)->delete();
        }
        $this->closeModal();
        $this->redirect(route('profile', $this->invitee->id));
    }
    public function detach_student()
    {
        $student = null;
        if ($this->inviter->status->title == "Студент") {
            $student = $this->inviter;
        } else {
            $student = $this->invitee;
        }
        $student->professor_id = null;
        $student->save();
        $notif = new \App\Notifications\DetachNotification($this->inviter);
        Notification::send($this->invitee, $notif);
        $this->closeModal();
        $this->redirect(route('profile', $this->invitee->id));
    }
}
