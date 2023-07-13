<?php

    'connections' => [

        'sync' => [
            'driver' => 'sync',
        ],

        'database' => [
            'driver' => 'database',
            'table' => 'jobs',
            'queue' => 'default',
            'expire' => 60,
        ],

        'beanstalkd' => [
            'driver' => 'beanstalkd',
            'host'   => 'localhost',
            'queue'  => 'default',
            'ttr'    => 60,
        ],

        'sqs' => [
            'driver' => 'sqs',
            'key'    => 'your-public-key',
            'secret' => 'your-secret-key',
            'queue'  => 'your-queue-url',
            'region' => 'us-east-1',
        ],

        'iron' => [
            'driver'  => 'iron',
            'host'    => 'mq-aws-us-east-1.iron.io',
            'token'   => 'your-token',
            'project' => 'your-project-id',
            'queue'   => 'your-queue-name',
            'encrypt' => true,
        ],

        'redis' => [
            'driver' => 'redis',
            'queue'  => 'gk',
            'expire' => 60,
        ],

        'rabbitmq' => [
		    'driver' => 'rabbitmq',
		    'queue' => env('RABBITMQ_QUEUE', 'invoice.fanout'),
		    'connection' => PhpAmqpLib\Connection\AMQPLazyConnection::class,
		    'hosts' => [
		        [
		            'host' => env('RABBITMQ_HOST', '10.35.42.29'),
		            'port' => env('RABBITMQ_PORT', 5672),
		            'user' => env('RABBITMQ_USER', 'admin'),
		            'password' => env('RABBITMQ_PASSWORD', 'admin'),
		            'vhost' => env('RABBITMQ_VHOST', '/'),
		        ],
		    ],
		    'options' => [
		        'queue' => [
		            'exchange' => 'invoice.fanout',
		            'exchange_type' => 'fanout',
		            'prioritize_delayed_messages' =>  false,
		            'queue_max_priority' => 10,
		            'job' => VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Jobs\RabbitMQJob::class,
		        ],
		        'exchange' => [
		            'name' => env('RABBITMQ_EXCHANGE_NAME', 'invoice.fanout'),
		            'declare' => env('RABBITMQ_EXCHANGE_DECLARE', true),

		            'type' => 'fanout',
		            'passive' => env('RABBITMQ_EXCHANGE_PASSIVE', false),
		            'durable' => env('RABBITMQ_EXCHANGE_DURABLE', true),
		            'auto_delete' => env('RABBITMQ_EXCHANGE_AUTODELETE', false),
		            'arguments' => env('RABBITMQ_EXCHANGE_ARGUMENTS'),
		        ],
		        'ssl_options' => [
		            'cafile' => env('RABBITMQ_SSL_CAFILE', null),
		            'local_cert' => env('RABBITMQ_SSL_LOCALCERT', null),
		            'local_key' => env('RABBITMQ_SSL_LOCALKEY', null),
		            'verify_peer' => env('RABBITMQ_SSL_VERIFY_PEER', true),
		            'passphrase' => env('RABBITMQ_SSL_PASSPHRASE', null),
		        ],
		    ],

    ],

?>