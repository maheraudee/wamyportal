<?php

namespace App\Notifications\Saving;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddWithdraw extends Notification
{
    use Queueable;

    private $order_id,$sender;

    public function __construct($order_id,$sender)
    {
        $this->order_id = $order_id;
        $this->sender = $sender;
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
        ];
    }
}
