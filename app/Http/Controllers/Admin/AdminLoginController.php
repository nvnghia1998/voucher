<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Auth;
class AdminLoginController extends Controller
{
    public function getLogin()
    {
        return view('admin.login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $login = [
            'email' => $request->txtEmail,
            'password' => $request->txtPassword,
            // 'level' => 1,
            // 'status' => 1
        ];
        if (Auth::attempt($login)) {
            
            $id = Auth::user()->id;
            $user = User::find($id);
            $user->status = 1;
            $user->date_login = now();
            $user->save();
            
            return redirect()->intended('admin/dasboard');
        }
        else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }

    public function getLogout()
    {
        if(Auth::check())
        {
            $id = Auth::user()->id;
            $user = User::find($id);
            $user->status = 0;
            $user->save();
            Auth::logout();
            return redirect('admin/login');
        }
    }
}
