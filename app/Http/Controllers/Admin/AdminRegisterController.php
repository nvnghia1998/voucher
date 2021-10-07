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
    		'txtEmail' => 'unique:users,email'
    	],[
    		"txtEmail.unique"    => "Email đã tồn tại",
    	]);

		$user           = new User;
		$user->name     = $request->txtName;
		$user->email    = $request->txtEmail;
		$user->password = bcrypt($request->txtPassword);
		//$user->level    = $request->rdoQuyen;
    	if ($user->save()) {
            return redirect()->back()->with('status', 'Đăng ký thành công');
        } else {
            return redirect()->back()->with('status', 'Đăng ký không thành công');
        }
       
    	//return redirect('admin/user/them')->with('message','Thêm thành công');
        //var_dump($request);
        //return view('admin.register');
        
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);
    }
}
