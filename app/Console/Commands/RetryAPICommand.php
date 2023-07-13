<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LogsApiModel;
use App\Models\UserAuthApiModel;
use App\Jobs\RetryAPI;

class RetryAPICommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'retry:api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to retry hit API';

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
        # Call API with response is Null
        $logs = LogsApiModel::whereNotNull('response')
                    ->where('is_retry', true)
                    ->get()
                    ->toArray();

        foreach ($logs as $log) {
            $credentials = UserAuthApiModel::where('id', $log['apps_id_send'])->get()->toArray();
            dispatch(new RetryAPI($log, $credentials[0]));
        }
    }
}
