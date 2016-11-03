<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name', 'ECTS'
    ];

    public function students(){

        return $this->belongsToMany(Student::class)->withTimestamps();
    }

    public function teachers(){

        return $this->belongsToMany(Teacher::class)->withTimestamps();
    }

    public function fileentries(){

        return $this->hasMany(Fileentry::class);
    }

    public function grades(){

        return $this->hasMany(Grade::class);
    }

    public function messages(){

        return $this->hasMany(Message::class);
    }
}
