<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('users.index',compact('users'));
    }
    
    public function getform() {
        $user = new User();
        return view('users.create', compact('user'));
    }
    public function create(UserFormRequest $request)
    {
        if (!$request->id) {
            $user = new User();
            $user->name     = $request->txtName;
            $user->email    = $request->txtEmail;
            $user->password = bcrypt($request->txtPass);
            $user->level    = $request->level;
            $user->save();
            return redirect('admin/users')->with('message','Create sucessfully');
        } else {
            $data = [
                'name' => $request->txtName,
                'email' => $request->txtEmail,
                'password'=> bcrypt($request->txtPass),
                'level' => $request->level
            ];

            DB::table('users')->where('id',$request->id)->update($data);
            return redirect('admin/users')->with('message','Update Sucessfully');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =User::find($id);
        return view('users.create',compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =User::find($id);
        $user->delete();
        return redirect('admin/users')->with('message','Deleted sucessfully');
    }
}
