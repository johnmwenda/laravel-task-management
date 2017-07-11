<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TaskProgressWasUpdated extends Notification
{
    use Queueable;

    protected $task;
    protected $progress;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($task, $progress)
    {
        $this->task = $task;
        $this->progress = $progress;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $progress_owner = [
            'name' => $this->progress->owner->name,
            'id' => $this->progress->owner->id
        ];

        return [
        'progress_owner' => $progress_owner,
        'progress' => $this->progress,
        'type' => 'update_progress_status',
        'reporter_name' => $this->task->reporter->name,
        'task_name' => $this->task->name,
        'task_id' => $this->task->id,
        ];
    }
}
