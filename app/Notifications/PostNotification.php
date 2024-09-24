<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostNotification extends Notification
{
    use Queueable;

    public $post;
    protected $sender;
    /**
     * Create a new notification instance.
     */
    public function __construct($post, $sender)
    {
        $this->post = $post;
        $this->sender = $sender;
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
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New Post Notification',
            'userid' => auth()->id(),
            'sender_name' => $this->sender->name,
            'body'  => $this->post->post_body,
            'link'  => 'website.post.store/'.$this->post->id,
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'New Post Notification',
            'userid' => auth()->id(),
            'sender_name' => $this->sender->name,
            'body'  =>$this->post->post_body,
            'link' =>'website.post.store/'.$this->post->id,
        ];
    }
}
