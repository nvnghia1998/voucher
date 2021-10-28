<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PortFormRequest;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const NUMBER_POST_OF_PAGE = 5;

    public function index(Request $request)
    {
        $posts = Post::paginate(self::NUMBER_POST_OF_PAGE);
        return view("admin.post.index",compact('posts'));
    }

    public function getform() {
        $post = new Post();
        $cate =  Category::all();
        return view('admin.post.create',compact('post','cate'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PortFormRequest $request)
    {
        if (!$request->id) {

            $post = new Post();
            $post->title     = $request->title;
            $post->slug_name     = $request->slug_name;
            $post->detail     = $request->detail;
            $post->image     = $request->image;
            $post->voucher_enabled     = $request->voucher_enabled;
            $post->voucher_quantity     = $request->voucher_quantity;
            $post->code     = $request->code;

            $post->save();
            Post::find($post->id)->category()->attach($request->category_id);

            return redirect('admin/posts')->with('message','Create sucessfully');

        }  else {
            $post = Post::where("id",$request->id)->first();
            $data = $request->all();
            unset($data['_token']);
            unset($data['category_id']);

            DB::table('post')->where('id',$request->id)->update($data);
            DB::table('category_post')->where('post_id',$request->id)->update(['category_id'=>$request->category_id]);
            
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
        $post = Post::where("id",'=', $id)->first();
        $cate = Category::all();
        return view('admin.post.create',compact('post','cate'));
    }

    public function destroy($id)
    {
        $post = Post::where("id",'=', $id)->delete();
    	return redirect('admin/posts')->with('message','Xóa thành công');
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
}
