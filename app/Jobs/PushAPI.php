<?php

namespace App\Jobs;

use App\Models\InvoiceModel;
use App\Services\TransportAPIService;
use App\Events\PusherLogsEvent;

use Log;

class PushAPI extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected array $log;
    protected array $credential;

    public function __construct(array $log, array $credential)
    {
        $this->log = $log;
        $this->credential = $credential;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        # Execute Jobs to hit API
        $response = TransportAPIService::endPoint($this->log['url'])
                        ->payload(json_decode($this->log['payload'], true))
                        ->credentials(json_decode($this->credential['credentials'], true))
                        ->method($this->log['method'])
                        ->typeOfAuth($this->credential['type_auth'])
                        ->typeOfData('application/json')
                        ->timeout(10)
                        ->exec();

        if($response->status == 200){
            Log::info('Response from Jobs :'. json_encode($response->content) );

            $item = new InvoiceModel(['payload_id' => $this->log['id'], 'response' => json_encode($response->content), 'is_done' => true]);

            event(new PusherLogsEvent($item));
        }else{
            Log::error('Errors : '. $response->error );

            $item = new InvoiceModel(['payload_id' => $this->log['id'], 'response' => $response->error, 'is_done' => 0, 'is_retry' => 1]);

            event(new PusherLogsEvent($item));
        }
        
        return $response;
    }
}
