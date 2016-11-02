<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'grade', 'form_of_classes', 'description', 'subject_id', 'student_id', 'teacher_id'
    ];

    public function subject(){

        return $this->belongsTo(Subject::class);
    }

    public function student(){

        return $this->belongsTo(Student::class);
    }

    public function teacher(){

        return $this->belongsTo(Teacher::class);
    }
}
