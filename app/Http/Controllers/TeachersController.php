<?php

namespace App\Http\Controllers;

use App\Message;
use App\Student;
use App\Teacher;
use Auth;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Redirect;
use Session;

class TeachersController extends Controller
{

    public function showSubjects(Teacher $teacher){

        return view ('teachers.show_subjects', compact('teacher'));

    }

    public function editPassword(Teacher $teacher){

        return view('teachers.edit_password', compact('teacher'));
    }

    public function changePassword(Request $request, Teacher $teacher){

        // Validation

        $this->validate($request, [

            'old_password' => 'required',
            'password' => 'required|min:6|max:14|confirmed',
            'password_confirmation' => 'required'
        ]);

        $old = $request->input('old_password');
        $new = $request->input('password');

        if (password_verify($old, $teacher->password)){

            // Zmiana hasła + zapisanie w formie zaszyfrowanej
            $teacher->update(['password' => Hash::make($new)]);

            Session::flash('success', 'You are succesfully changed your password!!');
            return Redirect::to('teachers/'. $teacher->id . '/home');
        }

        Session::flash('error', 'You havent changed your password - incorrectly old password. Try again');
        return back();
    }

    public function home(Teacher $teacher){

        if (Auth::guard('teacher')->id() == $teacher->id)
            return view ('teachers.home', compact('teacher'));

        Session::flash('error', 'Something went wrong. You are back to homepage!!');

        return Redirect::to('/teachers/'. $teacher->id .'/home');

    }

    public function showGradesPanel(Teacher $teacher){

        if (Auth::guard('teacher')->id() == $teacher->id){

            return view ('teachers.show_grades_panel', compact('teacher'));
        }

        Session::flash('error', 'Something went wrong. You are back to homepage!!');

        return Redirect::to('/teachers/'. $teacher->id .'/home');
    }

    public function showMessagesPanel(Teacher $teacher){

        if (Auth::guard('teacher')->id() == $teacher->id){

            $currentDate = Carbon::now();
            $messagesFromMonth = Message::whereBetween('created_at', array($currentDate->subMonth(), Carbon::now()))->get();

            return view ('teachers.show_messages_panel', compact('teacher', 'currentDate', 'messagesFromMonth'));
        }

        Session::flash('error', 'Something went wrong. You are back to homepage!!');

        return Redirect::to('/teachers/'. $teacher->id .'/home');
    }
}
