<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\ClearTempFiles::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('queue:work')->everyMinute()->description('Runs queue worker');
        $schedule->command('ClearTempFiles')->hourly()->description('Clear existing temporary files from campaigns/tmp folder');
        $schedule->command(\Spatie\Health\Commands\RunHealthChecksCommand::class)->hourly();


        //One caveat with this is after every new deployment we need to run queue:restart so that the daemon worker will restart
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
