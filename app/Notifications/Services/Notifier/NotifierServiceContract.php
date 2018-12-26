<?php


namespace App\Notifications\Services\Notifier;


interface NotifierServiceContract
{
    public function handle($data);
}