<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordLink;
use App\Mail\ResetPasswordWithNew;
use App\Student;
use App\Teacher;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use Redirect;
use Session;

class AuthController extends Controller
{

    public function login(){

        return view ('auth.login');

    }

    public function handleLogin(Request $request){

        $data1 = $request->only('email', 'password');
        $data2 = $request['choice']; // value from selected radio button

        if ($data2 === 'student'){

            if (Auth::guard('student')->attempt($data1))
                return Redirect::intended('/students/'. Auth::guard('student')->user()->id . '/home');

        }
        elseif ($data2 === 'teacher'){

            if (Auth::guard('teacher')->attempt($data1))
                return Redirect::intended('/teachers/'. Auth::guard('teacher')->user()->id . '/home');

        }
        elseif ($data2 === 'admin'){

            if (Auth::guard('admin')->attempt($data1))
                return Redirect::intended('/admins/'. Auth::guard('admin')->user()->id . '/home');

        }

        Session::flash('error', 'Incorrect email or password. Try again');
        return Redirect::intended('/login')->withInput();
    }

    public function handleLogout(){

        if (Auth::guard('student')->check()){

            Auth::guard('student')->logout();
            return Redirect::to('/');
        }
        elseif (Auth::guard('teacher')->check()){

            Auth::guard('teacher')->logout();
            return Redirect::to('/');
        }
        elseif (Auth::guard('admin')->check()){

            Auth::guard('admin')->logout();
            return Redirect::to('/');
        }
    }

    public function resetPasswordPanel(){

        return view ('auth.passwords.password_reset');
    }

    public function resetPasswordEmail(){

        AuthController::$email = Input::get('email');
        $secureString = $this->random_str(50); // 50 characters

        // Send email
        $this->sendEmailLink(AuthController::$email, $secureString);

        Session::flash('success', 'Check your email adress. We sent you link to submit reset password');
        return Redirect::to('/');
    }

    public function resetPasswordTemp($email){

        return view ('auth.passwords.password_reset_confirm', compact('email'));
    }

    public function resetPasswordNew($email){

        // New password

        $newPassword = $this->random_str(40);

        if (Student::all()->contains('email', $email)){

            $student = Student::where('email', $email)->first();
            $student->password = Hash::make($newPassword);
            $student->save();

            // Inform about new password

            // Send email
            $this->sendEmailWithPassword($email, $newPassword);

            Session::flash('success', 'Check your email adress. We sent on your address your new password. Keep it');
            return Redirect::to('/');
        }
        elseif (Teacher::all()->contains('email', $email)){

            $teacher = Teacher::where('email', $email)->first();
            $teacher->password = Hash::make($newPassword);
            $teacher->save();

            // Inform about new password

            // Send email
            $this->sendEmailWithPassword($email, $newPassword);

            Session::flash('success', 'Check your email adress. We sent on your address your new password. Keep it');
            return Redirect::to('/');
        }
    }

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

    private function sendEmailLink($email, $secureString){

        Mail::to($email)
            ->send(new ResetPasswordLink($email, $secureString));
    }

    private function sendEmailWithPassword($email, $newPassword){

        Mail::to($email)
            ->send(new ResetPasswordWithNew($email, $newPassword));
    }
}
