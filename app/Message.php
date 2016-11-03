<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'header', 'content', 'subject_id', 'teacher_id'
    ];

    public function subject(){

        return $this->belongsTo(Subject::class);
    }

    public function teacher(){

        return $this->belongsTo(Teacher::class);
    }
}
