<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserRegisterController extends Controller
{
    private function checkPasswordStrength($password)
    {
        if (strlen($password) < 8) {
            return 'Password must be at least 8 characters.';
        }
        if (!preg_match('/[A-Z]/', $password)) {
            return 'Password must include at least one uppercase letter.';
        }
        if (!preg_match('/[a-z]/', $password)) {
            return 'Password must include at least one lowercase letter.';
        }
        if (!preg_match('/\d/', $password)) {
            return 'Password must include at least one digit.';
        }
        if (!preg_match('/[@$!%*?&]/', $password)) {
            return 'Password must include at least one special character.';
        }
        return true;
    }

    public function showRegisterForm()
    {
        return view('user.auth.register');
    }
    public function register( Request $request)
    {
        $user= User::where('email',$request->email)->first();
        $pass = $request->password;
        $con_pass = $request->confirm_password;
        if ($user){
            return redirect()->back()->with('error','email already exist');
        }
        if (!$request->name | !$request->email | !$request->password | !$request->confirm_password){
            $message = [];

            if (!$request->name){
                $message[]="name";
            }
            if(!$request->email){
                $message[]="email";
            }
            if(!$request->password){
                $message[]="password";
            }
            if(!$request->confirm_password){
                $message[]="confirm_password";
            }
            $error_message = "";
            $fields = implode(',',$message);
            if (count($message)>1){

                $error_message = sprintf(" Fields %s are required to fill",$fields);
            }
            if(count($message)==1){
                $error_message = sprintf("Field %s is required to fill",$fields);
            }

            return redirect()->back()->with('error',$error_message);
        }
        if ($pass != $con_pass)
        {
            return redirect()->back()->with('error','password did not match');
        }
        $pass_check = $this->checkPasswordStrength($request->password);
        
        if ($pass_check !== true){
            return redirect()->back()->with('error',$pass_check);
        }
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $request->image,
            'phone_number' => $request->phone_number,
            'about' => $request->about,
            'password' => $request->password

        ]);

        return redirect(route('user.login'));
    }
    //
}
