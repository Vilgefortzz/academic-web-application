<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'login', 'password', 'first_name', 'second_name', 'degree', 'email'
    ];

    public function subjects(){

        return $this->belongsToMany(Subject::class)->withTimestamps();
    }
}
