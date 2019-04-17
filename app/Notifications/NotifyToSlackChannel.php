<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyToSlackChannel extends Notification
{
    
    use Queueable;
    
    private $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function via($notifiable)
    {
        return ['slack'];
    }
    
    public function toMail($notifiable)
    {
        return (new MailMessage)
          ->line('The introduction to the notification.')
          ->action('Notification Action', url('/'))
          ->line('Thank you for using our application!');
    }
    
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
    
    public function toSlack($notifiable)
    {
        $data = $this->data;
     
        return (new \Illuminate\Notifications\Messages\SlackMessage())->image('/storage/images/bar_logo')
                                                                      ->content($data['title'])
                                                                      ->attachment(function (
                                                                        $attachment
                                                                      ) use (
                                                                        $data
                                                                      ) {
                                                                          $attachment
                                                                            ->fields(
                                                                              $data['content']
                                                                            );
                                                                      });
    }
    
}
