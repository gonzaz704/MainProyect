<?php

namespace App\Notifications;

use App\Papers;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PeerReview extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Papers $paper)
    {
        $this->paper = $paper;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $created = $this->paper->createdBy;
        return (new MailMessage)
                    ->line("$created->name has requested you to review his/her paper.Please click on link below to visit the paper")
                    ->action('View Paper', route('papers.reviews.index'))
                    ->line('Thank you for cooperation.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $created = $this->paper->createdBy;
        return [
            'message' => "$created->name has requested you to review his/her paper.",
            'route' => route('papers.reviews.index')
        ];
    }
}
