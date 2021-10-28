<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DeletePermissionEdit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deleted:edit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deleted permission edit';

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
        echo now();
        DB::table('event_user')->where('expire_time', '<', Carbon::now())->delete();
        $this->info('success');
    }
}
