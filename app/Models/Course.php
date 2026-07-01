<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'video',
        'duration',
        'image',
        'teacher_id',

    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }



    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'course_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'course_id');
    }

    public function studentDetails()
    {
        return $this->hasMany(Enrollment::class, 'course_id');
    }

}
