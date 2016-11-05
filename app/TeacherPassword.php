<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherPassword extends Model
{
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
