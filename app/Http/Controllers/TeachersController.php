<?php

namespace App\Http\Controllers;

use App\Teacher;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Session;

class TeachersController extends Controller
{
    public function index(){

        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));
    }

    public function show(Teacher $teacher){

        return view('teachers.show', compact('teacher'));
    }

    public function showSubjects(Teacher $teacher){

        return view ('teachers.show_subjects', compact('teacher'));

    }

    public function editPassword(Teacher $teacher){

        return view('teachers.edit_password', compact('teacher'));
    }

    public function changePassword(Request $request, Teacher $teacher){

        // Walidacja

        $this->validate($request, [

            'password' => 'required|min:6|max:14'

        ]);

        // Zmiana hasła + zapisanie w formie zaszyfrowanej
        $teacher->update(['password' => Hash::make($request->get('password'))]);

        Session::flash('success', 'You are succesfully changed your password!!');

        return Redirect::to('teachers/'. $teacher->id . '/home');
    }

    public function home(Teacher $teacher){

        if (Auth::guard('teacher')->id() == $teacher->id)
            return view ('teachers.home', compact('teacher'));

        Session::flash('error', 'Something went wrong. You are back to homepage!!');

        return back();

    }


}
