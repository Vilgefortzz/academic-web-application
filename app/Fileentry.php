<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fileentry extends Model
{

    protected $fillable = [
        'subject_id', 'teacher_id', 'filename', 'mime', 'original_filename'
    ];

    public function teacher(){

        return $this->belongsTo(Teacher::class);
    }

    public function subject(){

        return $this->belongsTo(Subject::class);
    }
}
