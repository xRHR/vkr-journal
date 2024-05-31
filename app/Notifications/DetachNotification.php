<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DetachNotification extends Notification
{
    use Queueable;
    public $detacher;
    /**
     * Create a new notification instance.
     */
    public function __construct($detacher)
    {
        $this->detacher = $detacher;
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
        if ($this->detacher->status->title == "Научный руководитель") {
            $description = "Вы были откреплены от руководителя". $this->detacher->fullnameShort(). ".";
        } else {
            $description = "Студент ". $this->detacher->fullnameShort() . " открепился от Вас.";
        }
        return [
            'link' => route('profile', $this->detacher->id),
            'description' => $description,
            'id'     =>  $this->id,
        ];
    }
}
