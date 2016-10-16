<?php

namespace App\Http\Controllers;

use App\Student;
use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function index(){

        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    public function show(Subject $subject){

        return view('subjects.show', compact('subject'));
    }

    public function addStudent(Request $request, Subject $subject){

        // Zabezpieczenie przed zduplikowanymi tabelami
        if (Student::find($request->id)!= null && !$subject->students->contains($request->id)) {
            $subject->students()->attach($request->id);
        }

        return back();
    }

    public function addTeacher(Request $request, Subject $subject){

        // Zabezpieczenie przed zduplikowanymi tabelami
        if (Teacher::find($request->id)!= null && !$subject->teachers->contains($request->id)) {
            $this->teachers()->attach($request->id);
        }

        return back();
    }
}
