<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        if (empty($request->contacts)) {
            $posts = Post::paginate(3);
            return view("admin.post.index",compact('posts'));
        } else {
            
        }

    }

    public function getform() {
        $post = new Post();
        $cate =  Category::all();
       //dd($cate->toArray());
        return view('admin.post.create',compact('post','cate'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        // if ($id && !$request) {
        $post = new Post();
        //     dd($post);
           return view('admin.post.create',compact('$post'));
        // }

        // if(!$id && $request) {
            
        //     Post::create($request);
        //     return view('admin.post.create');
        // } 

        // if(!$id && !$request) {
        //     die('FFF');
        //     return view('admin.post.create');
        // }
        
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
        $coupon = Post::find($id);
    	$coupon->delete();

    	return redirect('admin/posts')->with('message','Xóa thành công');
    }
}
