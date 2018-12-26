<?php


namespace App\Notifications\Services\Notifiable;


interface NotifibleServiceContract
{
    public function send($data);
}