<?php

namespace App\Http\Controllers;

use App\Student;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

class StudentsController extends Controller
{
    public function index(){

        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function show(Student $student){

        return view('students.show', compact('student'));
    }

    public function showSubjects(Student $student){

        return view ('students.show_subjects', compact('student'));

    }

    public function editPassword(Student $student){

        return view('students.edit_password', compact('student'));
    }

    public function changePassword(Request $request, Student $student){

        // Walidacja

        $this->validate($request, [

            'password' => 'required|min:6|max:14'

        ]);

        // Zmiana hasła + zapisanie w formie zaszyfrowanej
        $student->update(['password' => Hash::make($request->get('password'))]);

        Session::flash('success', 'You are succesfully changed your password!!');

        return Redirect::to('students/'. $student->id . '/home');
    }

    public function home(Student $student){

        if (Auth::guard('student')->id() == $student->id)
            return view ('students.home', compact('student'));

        Session::flash('error', 'Something went wrong. You are back to homepage!!');

        return back();
    }
}
