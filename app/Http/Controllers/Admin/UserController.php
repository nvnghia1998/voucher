<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(3);
        return view('users.index',compact('users'));
    }
    
    public function getform() {
        return view('users.create');
    }
    public function create(Request $request)
    {
       
        $this->validate($request,[
    		'txtEmail' => 'unique:users,email',
            'txtName' => 'required',
            'txtPass' => 'required',
            'level' => 'required',
            'txtEmail' => 'required',
    	],[
    		"txtEmail.unique"    => "Email đã tồn tại",
            "txtName.required" => "Name can't empty",
            "txtPass.required" => "Password can't empty",
            "level.required" => "Level can't empty",
            "txtEmail.required" => "Email can't empty"
    	]);

		$user           = new User;
        $user->name     = $request->txtName;
		$user->email    = $request->txtEmail;
		$user->password = bcrypt($request->txtPass);
		$user->level    = $request->level;
    	$user->save();
    	return redirect('admin/users')->with('message','Thêm thành công');
        
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
