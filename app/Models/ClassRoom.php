<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',     // Dropdown (Online/Offline)
        'subject',
        
    ];

    // public function students()
    // {
    //     return $this->belongsToMany(Student::class, 'classroom_student');
    // }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'classroom_student', 'classroom_id', 'student_id');
    }

    // public function student()
    // {
    //     return $this->belongsTo(Student::class);
    // }   


}
