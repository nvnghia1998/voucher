<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Tracking_mails;
use Carbon\Carbon;
use App\Jobs\SendEmail;
class GetListOfEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:get_list {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send drip e-mails to a user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->argument('user') === 'user') {
            $user_not_login = User::select('name','email')->where('level',0)->whereRaw('datediff(now(), date_login) >= ?', 1)->get();
                $data = [];
                foreach($user_not_login as $item) {
                   $data[] = [
                       'to' => $item["email"], 
                       'subject' => "User hasn't logged in for 1 day",
                       'content' => '',
                       'type' => 0,
                       'user_id' => $item['id'],
                       'time' => now()
                   ];
                    // Mail::send('admin.mail', array('name'=> $item['name'],'email'=>$item["email"]), function($message)use ($item){
                    //     $message->to($item["email"], 'Visitor')->subject('Visitor Feedback!');
                    // });
                }
               
                DB::table('tracking_mails')->insert($data);
                
        } else if($this->argument('user') === 'admin') {
            
            $admins = User::select('email')->where('level',1)->get();
            $post_not_read = Post::select('post_id','title','created_at')->where('view_count',0)->whereRaw('datediff(now(), updated_at) >= ?', 1)->get();
            
            $data = [];
            foreach($post_not_read as $item) {
                foreach($admins as $admin) {
                    $data[] = [
                        'to' => $admin['email'], 
                        'subject' => "The post isn't view ",
                        'content' => '',
                        'type' => 1,
                        'post_id' => $item['post_id'],
                        'time' => now()
                    ];
                }
            
                    // Mail::send('admin.post_email', array('post_id'=> $item['post_id'],'title'=>$item["title"], 'created_at'=>$item["created_at"]), 
                    //     function($message) use ($admins){
                    //         $message->to($admins, 'Visitor')
                    //                 ->subject('Visitor Feedback!');
                    //     }
                    // );   

            }
            DB::table('tracking_mails')->insert($data);
        }
    
    }
}
