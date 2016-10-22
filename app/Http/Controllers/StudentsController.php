<?php

namespace App\Http\Controllers;

use App\Student;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

    public function change_password(Request $request, Student $student){

        // Walidacja

        $this->validate($request, [

            'password' => 'required|min:6|max:14'

        ]);

        // Zmiana hasła + zapisanie w formie zaszyfrowanej
        $student->update(['password' => Hash::make($request->get('password'))]);
        return Redirect::to("students/". $student->id);
    }

    public function home(Student $student){

        if (Auth::guard('student')->id() == $student->id)
            return view ('students.home', compact('student'));

        return Redirect::to('/');
    }
}
