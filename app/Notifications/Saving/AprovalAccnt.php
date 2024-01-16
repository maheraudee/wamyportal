<?php

namespace App\Notifications\Saving;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AprovalAccnt extends Notification
{
    use Queueable;
    private $order_id,$sender,$sponsor,$stuats;

    public function __construct($order_id,$sender,$sponsor,$stuats)
    {
        $this->order_id = $order_id;
        $this->sender = $sender;
        $this->sponsor = $sponsor;
        $this->stuats = $stuats;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order_id,
            'sender' => $this->sender,
            'sponsor' => $this->sponsor,
            'stuats' => $this->stuats,
        ];
    }
}
