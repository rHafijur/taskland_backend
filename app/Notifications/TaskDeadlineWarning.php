<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TaskDeadlineWarning extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private $task)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Task Deadline Approaching')
            ->line('The deadline for the task "' . $this->task->title . '" is approaching.')
            ->line('Deadline: ' . Carbon::parse($this->task->due_date)->timezone('Asia/Dhaka'))
            ->line('Please take necessary action before the deadline.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
