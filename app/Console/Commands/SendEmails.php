<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Tracking_mails;
use Carbon\Carbon;
use App\Jobs\SendEmail;
class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $mails = Tracking_mails::all();
        foreach($mails as $mail) {
            
            DB::table('tracking_mails')->where('id',$mail['id'])->update(['status'=> 'Sending']);
                $sendEmailJob = new SendEmail($mail['to'], $mail['id']);
                dispatch($sendEmailJob);//->delay(Carbon::now()->addMinutes(1));
        }
    }
}
