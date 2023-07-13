<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LogsApiModel;
use App\Models\UserAuthApiModel;
use App\Jobs\PushAPI;

class PusherAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pusher:api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command To Push API';

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
        $logs = LogsApiModel::whereNull('response')
                    ->where('is_done', false)
                    ->get()
                    ->toArray();

        foreach ($logs as $log) {
            $credentials = UserAuthApiModel::where('id', $log['apps_id_send'])->get()->toArray();
            dispatch(new PushAPI($log, $credentials[0]));
        } 
    }
}
