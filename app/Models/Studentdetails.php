<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studentdetails extends Model
{
    protected $table = 'studentdetails';

   protected $fillable = [
    'student_id',
    'course_id',
    'enroll_date',
    'complete_date'
];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
