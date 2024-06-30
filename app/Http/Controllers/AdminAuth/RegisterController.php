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
        print($request->name);
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
