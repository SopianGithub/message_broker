<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\InvoiceModel;
use App\Events\InvoiceEvent;
use App\Events\PusherLogsEvent;
use App\Listeners\InvoiceListener;
use App\Jobs\InvoiceProcess;

use App\Services\TransportAPIService;

use Ixudra\Curl\Facades\Curl;

use Telegram\Bot\Laravel\Facades\Telegram;

class Invoices extends Controller
{
    

    public function index()
    {
        $item = new InvoiceModel(['item1' => 'Test']);

        // $ev = event(new InvoiceEvent($item));

        return $item;
    }

    public function reader()
    {
        dispatch(new InvoiceProcess());

        return "InvoiceProcess Jobs sedang dijalankan!";
    }

    public function testAPI()
    {
        // $response = TransportAPIService::endPoint($this->log['url'])
        //                 ->payload(json_decode($this->log['payload'], true))
        //                 ->credentials(json_decode($this->credential['credentials']))
        //                 ->method($this->log['method'])
        //                 ->typeOfAuth($this->credential['type_auth'])
        //                 ->typeOfData('application/json')
        //                 ->exec();

        // $response = TransportAPIService::endPoint('https://numero-be.telkom.co.id/public/jsonApi/mitra.php')
        //                 ->method('GET')
        //                 ->typeOfAuth('None')
        //                 ->typeOfData('application/json')
        //                 ->exec();

        // $response = json_encode(['status' => true]);
        // # Call Event Update Pusher
        $item = new InvoiceModel(['payload_id' => 1, 'response' => 'Test', 'is_done' => false, 'is_retry' => true]);
        
        event(new PusherLogsEvent($item));

        // return $response->content;

    }

    public function telegram()
    {
        // $response = Telegram::bot('hits_api_bot')->getMe();

        $response = Telegram::bot('hits_api_bot')->sendMessage([
            'chat_id' => '-906762156',
            'text' => 'Hello World'
        ]);

        return $response;
    }


}
