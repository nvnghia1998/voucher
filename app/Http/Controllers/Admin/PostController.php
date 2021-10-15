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
        //var_dump($cate);
       //dd($cate->toArray());
        return view('admin.post.create',compact('post','cate'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      
        if (!$request->post_id) {
           
            $post = new Post();
            $post->title     = $request->title;
            $post->slug_name     = $request->slug_name;
            //$post->category_id     = $request->category_id;
            $post->detail     = $request->detail;
            $post->image     = $request->image;
            $post->voucher_enabled     = $request->voucher_enabled;
            $post->code     = $request->code;
            $post->save();
           
            return redirect('admin/posts')->with('message','Create sucessfully');
        }  else {
            $post = Post::where("post_id",$request->post_id)->get();
            
            $post[0]->title     = $request->title;
            //dd($post->title);
            $post[0]->save();
            return redirect('admin/posts')->with('message','Update Sucessfully');
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
       
        $post = Post::where("post_id",'=', $id)->first();
        $cate = Category::all();
        return view('admin.post.create',compact('post','cate'));
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
       
        $post = Post::where("post_id",'=', $id)->delete();
    	//$post->delete();

    	return redirect('admin/posts')->with('message','Xóa thành công');
    }
}
