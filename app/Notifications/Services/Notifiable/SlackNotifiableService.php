<?php


namespace App\Notifications\Services\Notifiable;

use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Request;



class SlackNotifiableService implements NotifibleServiceContract
{
    use Notifiable;
    
    private $slackNotification;
    
    /**
     * SlackNotifiableService constructor.
     *
     * @param $slackNotification
     */
    public function __construct(Notification $slackNotification)
    {
        $this->slackNotification = $slackNotification;
    }
    
    public function send($data) {
        $user = app(\App\Components\User\Models\UserContract::class)->find($data['user_id']);
        $user = $user->first_name . ' ' . $user->last_name;
    
        $sendData['title'] = 'A new adv has been created';
        $sendData['content'] = [
          'User:'  => $user,
         
        ];
        $sendData['url'] = url('https://baraholka.provectus.com/adv/'.$data['id']);
        $sendData['post_title'] = $data['title'];
        $this->notify(app(\App\Notifications\NotifyToSlackChannel::class,
          ['data' => $sendData]));
    }
    
    
    public function routeNotificationForSlack()
    {
        return config('services.notifiable.webhooks.slack');
    }
    
}