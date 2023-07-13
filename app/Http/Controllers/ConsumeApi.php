<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LogsApiModel;

class ConsumeApi extends Controller
{
    
    public function storeAPI(Request $request)
    {
        $logs = new LogsApiModel;

        $logs->send_to = $request->input('send_to');
        $logs->id_apps = $request->input('id_apps');
        $logs->url = $request->input('url');
        $logs->method = $request->input('method');
        $logs->payload = json_encode($request->input('payload'));
        $logs->apps_id_send = $request->input('apps_id_send');

        $res = $logs->save();

        return $res;
    }
}
