<?php


namespace App\Notifications\Services\Notifier;

use Illuminate\Support\Facades\Config;
use App\Notifications\Services\Notifiable\NotifibleServiceContract;

class NotifierService implements NotifierServiceContract
{
    
    
    private $notifibleServices;
    
    public function __construct()
    {
        ;
        $this->collectNotifiable();
        
    }
    
    private function collectNotifiable()
    {
        $notifiableServises = collect();
        foreach (Config::get('services.notifiable.services') as $notifiableServise) {
            $notifiableServises->push(app($notifiableServise));
        }
        $this->notifibleServices = $notifiableServises;
    }
    
    public function handle($data)
    {
        $this->notifibleServices->each(function (
          NotifibleServiceContract $notifibleService
        ) use ($data) {
            $notifibleService->send($data);
            
        });
    }
    
    
}