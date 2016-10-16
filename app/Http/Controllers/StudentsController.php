<?php

namespace App\Http\Controllers;

use App\Student;
use Hash;
use Illuminate\Http\Request;
use Redirect;

class StudentsController extends Controller
{
    public function index(){

        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function show(Student $student){

        return view('students.show', compact('student'));
    }

    public function edit_password(Student $student){

        return view('students.edit_password', compact('student'));

    }

    public function update_password(Request $request, Student $student){

        // Zmiana hasła + zapisanie w formie zaszyfrowanej
        $student->update(['password' => Hash::make($request->get('password'))]);
        return Redirect::to("students/". $student->id);
    }
}
