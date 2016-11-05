<?php

namespace App\Http\Controllers;

use App\Message;
use App\Student;
use Auth;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

class StudentsController extends Controller
{

    public function showSubjects(Student $student){

        return view ('students.show_subjects', compact('student'));

    }

    public function editPassword(Student $student){

        return view('students.edit_password', compact('student'));
    }

    public function changePassword(Request $request, Student $student){

        // Validation

        $this->validate($request, [

            'old_password' => 'required',
            'password' => 'required|min:6|max:14|confirmed',
            'password_confirmation' => 'required'
        ]);

        $old = $request->input('old_password');
        $new = $request->input('password');

        if (password_verify($old, $student->password)){

            // Zmiana hasła + zapisanie w formie zaszyfrowanej
            $student->update(['password' => Hash::make($new)]);

            Session::flash('success', 'You are succesfully changed your password!!');
            return Redirect::to('students/'. $student->id . '/home');
        }

        Session::flash('error', 'You havent changed your password - incorrectly old password. Try again');
        return back();
    }

    public function home(Student $student){

        if (Auth::guard('student')->id() == $student->id)
            return view ('students.home', compact('student'));

        Session::flash('error', 'Something went wrong. You are back to homepage!!');

        return Redirect::to('/students/'. $student->id .'/home');
    }

    public function showGrades(Student $student){

        if (Auth::guard('student')->id() == $student->id){

            return view ('students.show_grades', compact('student'));
        }

        Session::flash('error', 'Something went wrong. You are back to homepage!!');

        return Redirect::to('/students/'. $student->id .'/home');
    }

    public function showMessages(Student $student){

        if (Auth::guard('student')->id() == $student->id){

            $currentDate = Carbon::now();
            $messagesFromMonth = Message::whereBetween('created_at', array($currentDate->subMonth(), Carbon::now()))->get();

            return view ('students.show_messages', compact('student', 'currentDate', 'messagesFromMonth'));
        }

        Session::flash('error', 'Something went wrong. You are back to homepage!!');

        return Redirect::to('/students/'. $student->id .'/home');
    }
}
