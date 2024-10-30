<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TaskNotification extends Notification
{
    use Queueable;

    protected $transaction;
    protected $newStatus;

    public function __construct($transaction, $newStatus)
    {
        $this->transaction = $transaction;
        $this->newStatus = $newStatus;
    }

    public function via($notifiable)
    {
        return ['mail']; // or any other channel you're using
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Transaction Status Update')
            ->line('Your transaction status has changed to: ' . $this->newStatus)
            ->action('View Transaction', url('/transactions/'.$this->transaction->id))
            ->line('Thank you for your continued support!');
    }
}
