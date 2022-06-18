<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('fee:payment')->everyMinute()->appendOutputTo('fee_payment.log');

        // $schedule->command('inspire')->hourly();
        // $schedule->command('unity:availability')
        // ->everyMinute()
        // ->onOneServer()
        // ->appendOutputTo('unity.log')
        // ->runInBackground() f you have mutiple job you want to run at the same time
        // ->evenInMaintenanceMode()
        // ->withoutOverlapping();

        // $schedule->call(function () {
        //     // $formatted_date = Carbon::now()->subMinutes(5)->toDateTimeString();
        //     // where('created_at', '<=', $formatted_date)->
        //     return TemporaryFile::create(['folder' => Str::random(10), 'filename' => Str::random(10).'.web']);
        // })->everyMinute()
        // ->appendOutputTo('unity.log');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
