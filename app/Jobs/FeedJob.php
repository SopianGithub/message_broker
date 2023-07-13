<?php

namespace App\Jobs;


use Telegram\Bot\Laravel\Facades\Telegram;

class FeedJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected array $data;

    public function __construct(array $response)
    {
        $this->data = $response;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Telegram::bot('hits_api_bot')->sendMessage([
            'chat_id' => '-906762156',
            'text' => 'Terdapat error pada integrasi ke aplikasi ['.$this->data['send_to'].'] '.chr(10).'Pada endpoint: '.$this->data['url'].chr(10).'payload yang dikirimkan : '.chr(10).$this->data['payload'].chr(10).chr(10).'Dengan respon : '.$this->data['response']
        ]);

        return $response;
    }
}
