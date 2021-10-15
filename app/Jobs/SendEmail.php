<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\Tracking_mails;
use Illuminate\Support\Facades\DB;
class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $id_email;
    protected $to;
    public function __construct($to, $id_email)
    {
        $this->to = $to;
        $this->id_email = $id_email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Mail::send('admin.mail', array(), 
                function($message){
                    $message->to($this->to)
                            ->subject('Voucher App');
                }
            );
           
            DB::table('tracking_mails')->where('id',$this->id_email)->update(['status'=> 'Done']); 
        } catch (\Exception $ex) {
            DB::table('tracking_mails')->where('id',$this->id_email)->update(['status'=> 'Error']); 
        }
    }
}
