<?php

return [
	    'bots' => [
	        'hits_api_bot' => [
	            'token'       => env('TELEGRAM_API_TOKEN')
	        ],

	        'anotherbot' => [
	            'token' => '654321:DEF-GHI5678jkL-mno34pqr9stu456vwx',
	            'commands' => ['admin', 'help', 'info'],
	        ],

	        'default' => 'hits_api_bot'
	    ]
];

?>