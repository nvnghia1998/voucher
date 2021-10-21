<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use Carbon\Carbon;
class EditPostController extends Controller
{
    protected $user;
    
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function check_permission($id)
    {

        DB::beginTransaction(); 
        try {
            $this->user->events()->attach($id,['expire_time'=> Carbon::now()->addMinutes(5)]);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'You can editing this post',
                'code' => 200
            ],200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'status' => 'fail',
                'message' => 'Sorry, You haven\'t permision editting this post',
                'code' => 409
            ], 409);
        }
    }

    public function release($id)
    {
        $event = DB::table('event_user')->where('event_id', $id)->first();
        DB::beginTransaction(); 
        try {
            if ($event->expire_time < now()) {
                DB::table('event_user')->delete($event->id);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Permision editing release',
                    'code' => 200
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'You can\'t relese',
                    'time_out' => date("i:s",strtotime($event->expire_time) - strtotime("now")),
                    'code' => 202
                ],202);
            }
            DB::commit();
            
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Sorry, You haven\'t permision editting this post'
            ], 409);
        }
    }

    public function extend_time($id)
    {
        $event = DB::table('event_user')->where('event_id', $id)->first();
        
        DB::beginTransaction(); 
        try {
            if ($event) {
                if ($event->expire_time < now()) {
                    $extend = Carbon::now()->addMinutes(5);
                    $time_out = 0;
                } else {
                    $extend = Carbon::parse($event->expire_time)->addMinutes(5);
                    $time_out = date("i:s",strtotime($extend) - strtotime("now"));
                }
                DB::table('event_user')->where('event_id',$id)->update(['expire_time'=> $extend]);
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'You have been extend time success',
                    'time_out' => $time_out,
                    'code' => 200
                ],200);
            
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Sorry, You haven\'t permision editting this post'
            ], 409);
        }
    }


}
