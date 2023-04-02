<?php

namespace App\Notifications;


use App\Papers;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VoteNotification extends Notification
{
    use Queueable;
    protected $user;
    protected $papers;

    public function __construct($user, $papers)
    {
        $this->user = $user;
        $this->papers = $papers;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line($this->user->name . ' has voted you')
            ->line('Thank you');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->user->name.' has voted for your publication ' . $this->papers->id
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            $this->user->name,
            $this->papers->id,
        ];
    }
}
