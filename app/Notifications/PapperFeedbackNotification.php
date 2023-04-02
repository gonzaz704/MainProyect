<?php

namespace App\Notifications;

use App\Papers;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class PapperFeedbackNotification extends Notification
{
    use Queueable;

    protected $feedback;

    public function __construct($feedback)
    {
        $this->feedback = $feedback;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $paper = Papers::find($this->feedback->paper_id);

        if ($this->feedback->user_id == 1) {
            return [
                'message' => "You have a feedback on your summary $paper->titulo",
                'route' => route('paper.view', $paper->id)
            ];
        } else {
            return [
                'message' => "User have reply to your feedback on summary $paper->titulo",
                'route' => route('admin.papers.review', $paper->id)

            ];

        }

    }
}
