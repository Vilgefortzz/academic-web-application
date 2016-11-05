<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Student;
use App\StudentPassword;
use App\Subject;
use App\Teacher;
use App\TeacherPassword;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Session;

class AdminsController extends Controller
{

    public function home(Admin $admin){

        if (Auth::guard('admin')->id() == $admin->id)
            return view ('admins.home', compact('admin'));

        Session::flash('error', 'Something went wrong. You are back to homepage!!');
        return Redirect::to('/admins/'. $admin->id .'/home');
    }

    public function addStudentPanel(){

        $students = Student::all();

        return view('admins.add_student', compact('students'));
    }

    public function addTeacherPanel(){

        $teachers = Teacher::all();

        return view('admins.add_teacher', compact('teachers'));

    }

    public function addSubjectPanel(){

        $subjects = Subject::all();

        return view('admins.add_subject', compact('subjects'));

    }

    public function addStudent(Request $request){

        // Validation

        $this->validate($request, [

            'album_number' => 'required|size:6',
            'first_name' => 'required',
            'second_name' => 'required',
            'email' => 'required|unique:students,email',
            'pr_group' => 'required',
            'lab_group' => 'required',
        ]);

        $albumNumber = Input::get('album_number');

        $password = $this->random_str(20);

        $firstName = Input::get('first_name');
        $secondName = Input::get('second_name');
        $email = Input::get('email');
        $prGroup = Input::get('pr_group');
        $labGroup = Input::get('lab_group');

        $student = new Student();
        $student->album_number = $albumNumber;
        $student->password = Hash::make($password);
        $student->first_name = $firstName;
        $student->second_name = $secondName;
        $student->email = $email;
        $student->pr_group = $prGroup;
        $student->lab_group = $labGroup;

        $student->save();

        $studentPassword = new StudentPassword();
        $studentPassword->student_id = $student->id;
        $studentPassword->generated_password = $password;
        $studentPassword->save();

        Session::flash('success', 'You have correctly created new student');
        return back();
    }

    public function deleteStudent($student_id){

        // Search the student in database
        $student = Student::where('id', '=', $student_id)->firstOrFail();
        $studentPassword = StudentPassword::where('student_id', '=', $student_id)->firstOrFail();
        // Remove from database
        $student->delete();
        $studentPassword->delete();

        Session::flash('success', 'You have correctly removed that student' );
        return back();
    }

    public function addTeacher(Request $request){

        // Validation

        $this->validate($request, [

            'first_name' => 'required',
            'second_name' => 'required',
            'degree' => 'required',
            'email' => 'required|unique:students,email',
        ]);

        $password = $this->random_str(20);

        $firstName = Input::get('first_name');
        $secondName = Input::get('second_name');
        $degree = Input::get('degree');
        $email = Input::get('email');

        $teacher = new Teacher();
        $teacher->password = Hash::make($password);
        $teacher->first_name = $firstName;
        $teacher->second_name = $secondName;
        $teacher->degree = $degree;
        $teacher->email = $email;

        $teacher->save();

        $teacherPassword = new TeacherPassword();
        $teacherPassword->teacher_id = $teacher->id;
        $teacherPassword->generated_password = $password;
        $teacherPassword->save();

        Session::flash('success', 'You have correctly created new teacher');
        return back();
    }

    public function deleteTeacher($teacher_id){

        // Search the teacher in database
        $teacher = Teacher::where('id', '=', $teacher_id)->firstOrFail();
        $teacherPassword = TeacherPassword::where('teacher_id', '=', $teacher_id)->firstOrFail();
        // Remove from database
        $teacher->delete();
        $teacherPassword->delete();

        Session::flash('success', 'You have correctly removed that teacher' );
        return back();
    }

    public function addSubject(Request $request){

        // Validation

        $this->validate($request, [

            'name' => 'required',
            'ects' => 'required',
        ]);

        $name = Input::get('name');
        $ECTS = (integer)Input::get('ects');

        $subject = new Subject();
        $subject->name = $name;
        $subject->ECTS = $ECTS;

        $subject->save();

        Session::flash('success', 'You have correctly created new subject');
        return back();
    }

    public function deleteSubject($subject_id){

        // Search the teacher in database
        $subject = Subject::where('id', '=', $subject_id)->firstOrFail();
        // Remove from database
        $subject->delete();

        Session::flash('success', 'You have correctly removed that subject' );
        return back();
    }

//    public function bindStudentSubject(){
//
//        // Zabezpieczenie przed zduplikowanymi tabelami
//        if (Student::find($request->id)!= null && !$subject->students->contains($request->id)) {
//            $subject->students()->attach($request->id);
//        }
//
//        return back();
//
//    }
//
//    public function bindTeacherSubject(){
//
//        // Zabezpieczenie przed zduplikowanymi tabelami
//        if (Teacher::find($request->id)!= null && !$subject->teachers->contains($request->id)) {
//            $this->teachers()->attach($request->id);
//        }
//
//        return back();
//
//    }

    //    Generate a random string, using a cryptographically secure pseudorandom number generator
    private function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }
}
