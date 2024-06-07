<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FinalVersion extends Notification
{
    use Queueable;

    public $user;
    public $chapter;
    /**
     * Create a new notification instance.
     */
    public function __construct($user, $chapter)
    {
        $this->user = $user;
        $this->chapter = $chapter;
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
        if ($this->chapter->thesis->professor_id == $this->user->id) {
            $description = $this->user->fullnameShort() . ' утвердил финальную версию главы ВКР "' . $this->chapter->title . '".';
        } else {
            $description = $this->user->fullnameShort() . ' запросил утвердить финальную версию главы ВКР "' . $this->chapter->title . '".';
        }
        return [
            'link' => route('viewChapter', ['thesis' => $this->chapter->thesis, 'order' => $this->chapter->order]),
            'description' => $description,
            'id'     =>  $this->id,
        ];
    }
}
