<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'password', 'first_name', 'second_name', 'degree', 'email'
    ];

    public function subjects(){

        return $this->belongsToMany(Subject::class)->withTimestamps();
    }

    public function fileentries(){

        return $this->hasMany(Fileentry::class);
    }

    public function grades(){

        return $this->hasMany(Grade::class);
    }
}
