<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tracker;
use App\Models\User;
use App\Models\Vouchers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    //
    public function index()
    {
        $posts = Post::all();
        // $a = Category::where('category_id',1)->post;
        // dd($a->toArray());
        $cates = Category::all();
        return view('home',compact('posts','cates'));
    }

    public function filterListVoucher(Request $request) {
       
        $posts = DB::table('category_post')
            ->leftJoin('post', 'category_post.post_id', '=', 'post.post_id')
            ->where('category_post.category_id', $request->category_id)
            ->get();
        $cates = Category::all();
        return view('home',compact('posts','cates'));
    }

    public function randomString($length = 10) {
        // Set the chars
        $chars='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
        // Count the total chars
        $totalChars = strlen($chars);
    
        // Get the total repeat
        $totalRepeat = ceil($length/$totalChars);
    
        // Repeat the string
        $repeatString = str_repeat($chars, $totalRepeat);
    
        // Shuffle the string result
        $shuffleString = str_shuffle($repeatString);
    
        // get the result random string
        return substr($shuffleString,1,$length);
    }

    public function detail($id){
        
       
        $post = Post::where('post_id',$id)->first();
        
        if(Auth::check()) {
           
            // Save count view
            $tracker  = new Tracker();
            $tracker->user_id = Auth::user()->id;
            $tracker->post_id = $id;
            $tracker->save();

            // Get voucher code của user
            $code = User::find(Auth::user()->id)->vouchers;
            Post::where('post_id',$id)->update(['view_count'=>$post->view_count + 1]);
           
            return view('detail_post',compact('post','code'));
        }
        return view('detail_post',compact('post'));
    }

    public function create_voucher($id, Request $request) {
        if(Auth::check()) {
            DB::beginTransaction(); 
            $voucher = [];
            try { 
                $post = (array)DB::table('post')->select('voucher_quantity')->where('post_id',$id)->where('voucher_quantity','>',0)->first();
                if ($post) {
                    $voucher = [
                        'user_id' => Auth::user()->id,
                        'post_id' => $id,
                        'code' => $this->randomString(8),
                        'created_at' => now()
                    ];
                    DB::table('vouchers')->insert($voucher); 
                    DB::table('post')->where('post_id',$id)->update(['voucher_quantity'=> $post['voucher_quantity'] - 1]); 
                    DB::commit();
                    return json_encode(['success'=> true,'code' => $voucher['code'],'message' => 'Voucher is created']);
                } else  {
                    return json_encode(['success'=> false,'message' => 'There is no more available voucher']);
                }
                
            } catch (\Exception $e) { 
                DB::rollBack();
            }
        } else {
            return json_encode(['success'=> false,'message' => 'Please login before get vouche code']);
        }
        
    }
}
