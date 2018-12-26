<?php

namespace App\Listeners;

use App\Events\PostNotifier;
use App\Notifications\Services\Notifier\NotifierServiceContract;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostNotifierListener
{
   private $notifierService;
    
    
    public function __construct(NotifierServiceContract $notifierService)
    {
        $this->notifierService = $notifierService;
    }

    /**
     * Handle the event.
     *
     * @param  PostNotifier  $event
     * @return void
     */
    public function handle(PostNotifier $event)
    {
        
        $this->notifierService->handle($event->getData());
    }
}
