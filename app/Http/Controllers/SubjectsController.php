<?php

namespace App\Http\Controllers;

use App\Student;
use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{

    public function show(Subject $subject){

        return view('subjects.show', compact('subject'));
    }
}
