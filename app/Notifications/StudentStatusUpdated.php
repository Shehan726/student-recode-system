<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentStatusUpdated extends Notification
{
    use Queueable;

    public $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $message = match ($this->status) {
            'approved' => 'Your application has been approved. You can now access your dashboard.',
            'rejected' => 'Your application has been rejected. Please resubmit your details.',
            default => 'Your application is still under review.',
        };


        
        return (new MailMessage)
            ->subject('Application Status Update')
            ->line($message)
            ->action('Login to Check', url('/login'));
    }
}
