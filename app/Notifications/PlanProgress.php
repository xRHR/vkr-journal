<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PlanProgress extends Notification
{
    use Queueable;

    protected $user, $plan_progress;
    /**
     * Create a new notification instance.
     */
    public function __construct($user, $plan_progress)
    {
        $this->user = $user;
        $this->plan_progress = $plan_progress;
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
        if ($this->user->status->title == "Научный руководитель") {
            if ($this->plan_progress->confirmed) {
                $description = $this->user->fullnameShort() . ' подтвердил выполнение пункта плана "' . $this->plan_progress->plan_item->title . '".';
            } else {
                $description = $this->user->fullnameShort() . ' отменил подтверждение выполнения пункта плана "' . $this->plan_progress->plan_item->title . '".';
            }
        } else
        if ($this->user->status->title == "Студент") {
            if ($this->plan_progress->is_done) {
                $description = $this->user->fullnameShort() . ' выполнил пункта плана "' . $this->plan_progress->plan_item->title . '". Вы можете проверить и подтвердить выполнение.';
            } else {
                $description = $this->user->fullnameShort() . ' отметил невыполненным пункта плана "' . $this->plan_progress->plan_item->title . '".';
            }
        }
        return [
            'link' => route('viewPlanProgressItem', ['user' => $this->plan_progress->user_id, 'plan_progress' => $this->plan_progress->id]),
            'description' => $description,
            'id'     =>  $this->id,
        ];
    }
}
