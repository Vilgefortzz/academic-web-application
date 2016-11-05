<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $fillable = [
        'album_number', 'password', 'first_name', 'second_name', 'email', 'pr_group', 'lab_group'
    ];

    public function subjects(){

        return $this->belongsToMany(Subject::class)->withTimestamps();
    }

    public function grades(){

        return $this->hasMany(Grade::class);
    }

    public function generatedPassword()
    {
        return $this->hasOne(StudentPassword::class);
    }
}
