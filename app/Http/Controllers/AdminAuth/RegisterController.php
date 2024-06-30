<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }

    public function register(Request $request)
    {
        // print_r($request->input('name'));
        $admin= Admin::where('email',$request->email)->first();
        $pass = $request->password;
        $con_pass = $request->confirm_password;
        if ($admin){
            return redirect()->back()->with('error','Email already exist');
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
        
        try {
            Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'image' => $request->image,
                'phone_number' => $request->phone_number,
                'about' => $request->about,
                'password' => $request->password
            ]);
    
            return redirect(route('admin.login'));
        } catch (\Exception $e) {
            return redirect()->back()->withError(['error'=>$e]);
        }
        
    }
    //
}
