<?php

namespace App\Models;

// use App\Observers\StudentObserver;

use App\Notifications\StudentStatusUpdated;
use App\Observers\StudentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\HasDatabaseNotifications;
use Illuminate\Notifications\Notifiable;

// #[ObservedBy([StudentObserver::class])]
//#[ObservedBy([StudentObserver::class])]

class Student extends Model
{
    use HasFactory, Notifiable, HasDatabaseNotifications; 

    
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'contact_no',
        'nic',
        'type',
        'address',
        'date_of_birth',
        'image',
        'pdf',
        'status',
       
         
    ];

    // Check if student is approved
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    // Check if student is rejected
    public function isRejected()
    {
        return $this->status === 'rejected';
    }


    protected static function boot()
    {
        parent::boot();

        static::updated(function ($student) {
            if ($student->isDirty('status')) {
                $student->notify(new StudentStatusUpdated($student->status));
            }
        });
    }
    
    // public function classrooms()
    // {
    //     return $this->belongsToMany(ClassRoom::class, 'classroom_student');
    // }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_student', 'student_id', 'classroom_id');
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

}
