<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LogsApiModel;
use App\Models\UserAuthApiModel;
use App\Jobs\FeedJob;

class FeedAPICommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to inform developer when debug on hit API';

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
     * @return mixed
     */
    public function handle()
    {
        $logs = LogsApiModel::whereNotNull('response')
                    ->where('is_feedback', true)
                    ->get()
                    ->toArray();

        foreach ($logs as $log) {
            dispatch(new FeedJob($log));
        }
    }
}
