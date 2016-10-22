<?php

namespace App\Http\Controllers;

use App\Teacher;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Redirect;

class TeachersController extends Controller
{
    public function index(){

        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));
    }

    public function show(Teacher $teacher){

        return view('teachers.show', compact('teacher'));
    }

    public function edit_password(Teacher $teacher){

        return view('teachers.edit_password', compact('teacher'));
    }

    public function change_password(Request $request, Teacher $teacher){

        // Walidacja

        $this->validate($request, [

            'password' => 'required|min:6|max:14'

        ]);

        // Zmiana hasła + zapisanie w formie zaszyfrowanej
        $teacher->update(['password' => Hash::make($request->get('password'))]);
        return Redirect::to("teachers/". $teacher->id);
    }

    public function home(Teacher $teacher){

        if (Auth::guard('teacher')->id() == $teacher->id)
            return view ('teachers.home', compact('teacher'));

        return Redirect::to('/');

    }
}
