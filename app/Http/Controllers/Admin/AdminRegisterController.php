<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class AdminRegisterController extends Controller
{
    public function getRegister() {
        return view('admin.register');
    }

    public function postRegister(Request $request) {
        
        $this->validate($request,[
    		'txtEmail' => 'unique:users,email',
            'txtName' => 'required',
            'txtPassword' => 'required',
            'txtEmail' => 'required'
    	],[
    		"txtEmail.unique"    => "Email is exist",
            "txtPassword.required"    => "Password can't empty",
            "txtName.required" => "Name can't empty",
            "txtEmail.required" => "Email can't empty"
    	]);

		$user           = new User;
		$user->name     = $request->txtName;
		$user->email    = $request->txtEmail;
		$user->password = bcrypt($request->txtPassword);
		
    	if ($user->save()) {
            return redirect()->back()->with('status', 'Register sucessfully');
        } else {
            return redirect()->back()->with('status', 'Registration failed');
        }
    }
}
