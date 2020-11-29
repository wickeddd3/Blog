<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserCreatedPost extends Notification
{
    use Queueable;

    protected $author;
    protected $post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($author, $post)
    {
        $this->author = $author;
        $this->post = $post;
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'author' => $this->author->full_name,
            'title' => $this->post->title,
            'featured' => $this->post->featured,
            'link' => $this->post->path()
        ];
    }
}
