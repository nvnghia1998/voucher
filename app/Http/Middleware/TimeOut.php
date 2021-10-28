<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Session\Store;
use JWTAuth;
use Session;
class TimeOut
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    protected $session;
    protected $timeout=30;
    public function __construct(Store $session){
        $this->session=$session;
    }
    public function handle(Request $request, Closure $next)
    {
       
        // $user = JWTAuth::parseToken()->authenticate();
        // DB::table('event_user')->delete(17);die;
        // var_dump($this->session->get('time_out'));die;
        // if(! $this->session->has('time_out')) {
        //     $this->session->put('time_out', time());
        //     var_dump($this->session->get('time_out'));
        //     //return $next($request);
        // }
        // else if( time() - $this->session->get('time_out') > $this->time_out){
        //     $this->session->forget('time_out');
        //     DB::table('event_user')->delete(18);
        //     var_dump(time());
        //     var_dump($this->session->get('time_out'));
        //     //$this->user->events()->attach($id);
            
        //     //return redirect($this->getRedirectUrl())->with([ $this->getSessionLabel() => 'You have been inactive for '. $this->timeout/60 .' minutes ago.']);
        // }
        
        if (!Session::has('lastActivityTime')) {
            Session::put('lastActivityTime', time());
            var_dump('gg');
            
        } elseif (time() - Session::get('lastActivityTime') > 30) {
            Session::forget('lastActivityTime');
            DB::table('event_user')->delete(22);
            var_dump(time() - Session::get('lastActivityTime'));
        }
        //var_dump(Session::has('lastActivityTime'));
        //Session::put('lastActivityTime', time());//f5 browser
        return $next($request);
        //$this->session->put('time_out',time());
        
        // $this->session->put('lastActivityTime',time());
       
        
    }
}
