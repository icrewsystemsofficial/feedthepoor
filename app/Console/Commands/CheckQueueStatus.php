<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CheckQueueStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if queue worker is running and restarts it if not';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        $command = "ps aux | grep 'queue:work' | grep -v grep";
        $output = shell_exec($command);
        $discord = config('services.discord.webhook');
        if (strlen($output) == 0) {
            $command = "php artisan queue:work";
            shell_exec($command);

            Http::post($discord, [
                'username' => 'Queue Worker',
                'content' => 'Queue worker restarted',
            ]);
        }
        else {
            echo "Queue worker is running\n";


            Http::post($discord, [
                'username' => 'Queue Worker',
                'content' => 'Queue worker is already running',
            ]);
        }
    }
}
