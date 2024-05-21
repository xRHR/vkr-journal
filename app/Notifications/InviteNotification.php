<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InviteNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $inviter;
    public function __construct($inviter)
    {
        $this->inviter = $inviter;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $description = "";
        if ($this->inviter->status->title == "Научный руководитель") {
            $description = "Вас пригласили прикрепиться к научному руководителю ". $this->inviter->fullnameShort();
        } else {
            $description = "Студент ". $this->inviter->fullnameShort() . " запросил прикрепление к Вам.";
        }
        return [
            'link' => route('profile', $this->inviter->id),
            'description' => $description,
            'id'     =>  $this->id,
        ];
    }
}
