<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

use App\Jobs\InvoiceProcess;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\PusherAPI::class,
        \App\Console\Commands\RetryAPICommand::class,
        \App\Console\Commands\FeedAPICommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->job(new InvoiceProcess)->everyTenMinutes();

        // $schedule->command('queue:work')->everyMinute();
    }
}
