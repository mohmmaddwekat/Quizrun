<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;
    protected $title;
    protected $body;
    protected $sender_type;
    protected $sender;
    protected $action;
    protected $icon;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title, $body, $sender_type, $sender, $action, $icon = '')
    {
        //
        $this->title = $title;
        $this->body = $body;
        $this->sender_type =  $sender_type;
        $this->sender = $sender;
        $this->action = $action;
        $this->icon = $icon;
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
        // return (new MailMessage)
        //     ->line('The introduction to the notification.')
        //     ->action('Notification Action', url('/'))
        //     ->line('Thank you for using our application!');
    }
    /**
     * Build the Database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            "title" => $this->title,
            "body" => $this->body,
            "sender_type" => $this->sender_type,
            "sender" => $this->sender,
            "action" => $this->action,
            "icon" => $this->icon,
        ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
