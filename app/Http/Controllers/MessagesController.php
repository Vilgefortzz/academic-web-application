<?php

namespace App\Http\Controllers;

use App\Mail\EmailMessage;
use App\Message;
use App\Student;
use App\Subject;
use App\Teacher;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use Session;

class MessagesController extends Controller
{
    public function add(){

        // value from selected option

        $header = Input::get('header');
        $content = Input::get('content');
        $subject_id = (integer)Input::get('subject');

        $destination = Input::get('destination');

        if ($destination === "proj"){

            $message = new Message();
            $message->header = $header;
            $message->content = $content;
            $message->subject_id = $subject_id;
            $message->teacher_id = Auth::guard('teacher')->id();

            // Array of selected groups
            $groupsString = "";
            $toProjGroups = Input::get('project');
            foreach ($toProjGroups as $projGroup){

                $groupsString .= $projGroup. "|";
            }

            $message->to_proj_groups = $groupsString;
            $message->save();

            // Objects needed to set information in emails
            $subject = Subject::find($subject_id);
            $teacher = Teacher::find(Auth::guard('teacher')->id());

            // Retrive a collection of students
            foreach ($toProjGroups as $toProjGroup){

                $students = Student::where('pr_group', $toProjGroup)->get();

                // Send emails
                $this->sendEmail($students, $header, $content, $subject, $teacher);
            }

            Session::flash('success', 'You have added a new message');
            return back();
        }
        elseif ($destination === "lab"){

            $message = new Message();
            $message->header = $header;
            $message->content = $content;
            $message->subject_id = $subject_id;
            $message->teacher_id = Auth::guard('teacher')->id();

            // Array of selected groups
            $groupsString = "";
            $toLabGroups = Input::get('laboratory');
            foreach ($toLabGroups as $labGroup){

                $groupsString .= $labGroup. "|";
            }

            $message->to_lab_groups = $groupsString;
            $message->save();


            // Objects needed to set information in emails
            $subject = Subject::find($subject_id);
            $teacher = Teacher::find(Auth::guard('teacher')->id());

            // Retrive a collection of students
            foreach ($toLabGroups as $toLabGroup){

                $students = Student::where('lab_group', $toLabGroup)->get();

                // Send emails
                $this->sendEmail($students, $header, $content, $subject, $teacher);
            }

            Session::flash('success', 'You have added a new message and send emails to students');
            return back();

        }

        Session::flash('error', 'Cant create message :(');
        return back();
    }

    public function delete($message_id){

        // Search the file in database
        $message = Message::where('id', '=', $message_id)->firstOrFail();
        // Remove from database
        $message->delete();

        Session::flash('success', 'You have correctly removed that message' );
        return back();
    }

    private function sendEmail($students, $header, $content, $subject, $teacher){

        Mail::to($students)
            ->send(new EmailMessage($header, $content, $subject, $teacher));
    }

}
