<?php

namespace App\Notifications\Saving;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddOrder extends Notification
{
    use Queueable;

    private $order_id,$sender,$sponsor;

    public function __construct($order_id,$sender,$sponsor)
    {
        $this->order_id = $order_id;
        $this->sender = $sender;
        $this->sponsor = $sponsor;
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
        ];
    }
}
