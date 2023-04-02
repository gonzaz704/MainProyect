<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Action;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;

class ConfirmMatchData extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($news_data)
    {
        $this->paper = $news_data->paper;
        $this->news_data = $news_data;

        $this->author = User::where('email',$this->paper->author)->first();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if($this->author){
            return ['database','mail'];
        }
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $user = Auth::user();
        if($this->author){
            return (new MailMessage)
                ->line("$user->name want to publish your papers so they could be seen by other researchers and they could
                    also be used to complement the information of some news.
                ")
                ->action('View', route('papers.confirm.index'));
        }
        return (new MailMessage)
            ->markdown("mail.confirmdata",[
                'user' => $user,
                'paper' => $this->paper,
                'news_data' => $this->news_data
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $user = Auth::user();
        return [
            'message' => "$user->name has requested your paper for complementing news",
            'route' => route('papers.confirm.index')
        ];
    }
}
