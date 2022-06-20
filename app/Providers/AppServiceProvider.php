<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Queue;
use ConsoleTVs\Charts\Registrar as Charts;
use App\Charts\DailyProcurement;

use App\Helpers\NotificationHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
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
                            'description' => 'Job failed: ' . $event->connectionName . ' - ' . $event->job->getName(),
                            'color' => '7506394',
                            'timestamp' => now()->toISOString(),
                            'fields' => [
                                [
                                    'name' => 'Message',
                                    'value' => $event->exception->getMessage(),
                                    'inline' => false,
                                ],
                                [
                                    'name' => 'File',
                                    'value' => $event->exception->getFile(),
                                    'inline' => false,
                                ],
                                [
                                    'name' => 'Class',
                                    'value' => $event->job->resolveName(),
                                    'inline' => false,
                                ],
                                [
                                    'name' => 'Attempts',
                                    'value' => $event->job->attempts(),
                                    'inline' => true,
                                ],                                
                                [
                                    'name' => 'Line',
                                    'value' => $event->exception->getLine(),
                                    'inline' => true,
                                ],                                
                            ],                            
                        ]
                    ]
            ]);        

            app(NotificationHelper::class)->notifyAllAdmins('Job failed', 'Job failed: ' . $event->connectionName . ' - ' . $event->job->getName() . ' - ' . $event->exception->getMessage(), 'APP');

            if ($event->job->attempts() == 2) {
                $event->job->delete();
            }
            else{
                $event->job->release(5 * $event->job->attempts());
            }

        });
    }
}
