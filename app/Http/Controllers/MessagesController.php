<?php

namespace App\Http\Controllers;

use App\Message;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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

            Session::flash('success', 'You have added a new message');
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

}
