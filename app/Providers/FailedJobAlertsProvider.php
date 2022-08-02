<?php

namespace App\Providers;

use Illuminate\Support\Facades\Queue;
use Illuminate\Http\Request;
use App\Helpers\NotificationHelper;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\ServiceProvider;

class FailedJobAlertsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // ONLY Trigger if the app env is prod or production.
        if(config('app.env') == 'prod' || config('app.env') == 'production') {
            Queue::failing(function (JobFailed $event) {
                Http::post(config('services.discord.webhook'), [
                    'embeds' =>
                        [
                            [
                                'title' => '['.config('app.name').'] Job failed',
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
                    return;
                }
                else{
                    $event->job->release(5 * $event->job->attempts());
                }

            });
        }
    }
}
