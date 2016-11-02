<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Student;
use Auth;
use Illuminate\Support\Facades\Input;
use Session;

class GradesController extends Controller
{

    public function assign(){

        // value from selected option

        $grade = (double)Input::get('grade');
        $form_of_classes = Input::get('form_of_classes');
        $description = Input::get('description');
        $subject_id = (integer)Input::get('subject');
        $student_id = (integer)Input::get('student');

        // Check whether this student attending to this subject !!!
        if (Student::find($student_id)->subjects->contains('id', $subject_id)){

            $assignedGrade = new Grade();
            $assignedGrade->grade = $grade;
            $assignedGrade->form_of_classes = $form_of_classes;
            $assignedGrade->description = $description;
            $assignedGrade->subject_id = $subject_id;
            $assignedGrade->student_id = $student_id;
            $assignedGrade->teacher_id = Auth::guard('teacher')->id();

            $assignedGrade->save();

            Session::flash('success', 'You have assigned a new grade to student');
            return back();

        }

        Session::flash('error', 'This student are not attending to this subject');
        return back();

    }

    public function delete($grade_id){

        // Search the file in database
        $grade = Grade::where('id', '=', $grade_id)->firstOrFail();
        // Remove from database
        $grade->delete();

        Session::flash('success', 'You have correctly removed that grade' );
        return back();
    }
}
