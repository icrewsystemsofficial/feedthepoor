<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use ConsoleTVs\Charts\Registrar as Charts;
use App\Charts\DailyProcurement;

use Spatie\Health\Facades\Health;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\ScheduleCheck;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\CpuLoadHealthCheck\CpuLoadCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;

use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Queue;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Health::checks([
            UsedDiskSpaceCheck::new(),
            DatabaseCheck::new(),
            ScheduleCheck::new(),
            CacheCheck::new(),
            OptimizedAppCheck::new(),
            //EnvironmentCheck::new(),
            CpuLoadCheck::new()
                ->failWhenLoadIsHigherInTheLast5Minutes(3.5)
                ->failWhenLoadIsHigherInTheLast15Minutes(4.0),
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts)
    {
        Schema::defaultStringLength(191);
        $charts->register([
            DailyProcurement::class,
        ]);        

        Queue::failing(function (JobFailed $event) {
            
            Http::post(env('DISCORD_WEBHOOK_URL'), [
                'embeds' => 
                    [
                        [
                            'title' => '[FeedThePoor] Job failed',
                            'description' => 'Job failed: ' . $event->connectionName . ' / ' . $event->job->getName() . ' / ' . $event->exception->getMessage(),
                            'color' => '7506394',
                            'timestamp' => now()->toISOString(),
                            'fields' => [
                                [
                                    'name' => 'Class',
                                    'value' => $event->job->resolveName(),
                                    'inline' => true,
                                ],
                                [
                                    'name' => 'Attempts',
                                    'value' => $event->job->attempts(),
                                    'inline' => true,
                                ],
                                [
                                    'name' => 'File',
                                    'value' => $event->exception->getFile(),
                                    'inline' => false,
                                ],
                                [
                                    'name' => 'Line',
                                    'value' => $event->exception->getLine(),
                                    'inline' => true,
                                ],
                                [
                                    'name' => 'Code',
                                    'value' => $event->exception->getCode(),
                                    'inline' => false,
                                ]
                            ],                            
                        ]
                    ]
            ]);        

            app(NotificationHelper::class)->notifyAllAdmins('Job failed', 'Job failed: ' . $event->connectionName . ' / ' . $event->job->getName() . ' / ' . $event->exception->getMessage(), 'APP');

            if ($event->job->attempts() == 2) {
                return;
            }
            else{
                $event->job->release(5 * $event->job->attempts());
            }

        });
    }
}
