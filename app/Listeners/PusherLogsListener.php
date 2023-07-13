<?php

namespace App\Listeners;

use App\Models\LogsApiModel;
use App\Events\PusherLogsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class PusherLogsListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PusherLogsEvent  $event
     * @return void
     */
    public function handle(PusherLogsEvent $event)
    {
        $res = LogsApiModel::whereId($event->message->payload_id)->update([
            'response' => json_encode($event->message->response),
            'is_done' => $event->message->is_done ? $event->message->is_done : false,
            'is_retry' => $event->message->is_retry ? $event->message->is_retry : false,
            'is_feedback' => $event->message->is_feedback ? $event->message->is_feedback : false
        ]);

        Log::info('Response Event :'. json_encode($event->message->payload_id) );
    }
}
