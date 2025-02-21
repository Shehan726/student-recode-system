<?php

namespace App\Notifications;

use App\Models\Student;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class StudentRegisteredNotification extends Notification implements ShouldQueue
// {
//     public function via($notifiable)
//     {
//         return ['database']; // Ensure database channel is set
//     }

//     public function toDatabase($notifiable)
//     {
//         return [
//             'message' => 'A new student has registered.',
//             'student_id' => $notifiable->id,
//             'first_name' => $notifiable->first_name
//         ];
//     }
// }

{
    use Queueable;

    protected $student;

    public function __construct($student)
    {
        $this->student = $student;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

//     public function toDatabase($notifiable): DatabaseMessage
// {
//     return new DatabaseMessage([
//         'title' => 'New Student Registered',
//         'body' => 'A new student has been registered.',
//     ]);
// }
}