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

use App\Jobs\NotifyAllAdmins;
use Illuminate\Queue\Events\JobFailed;

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

        Queue::failings(function (JobFailed $event) {
            NotifyAllAdmins::dispatch('Job failed', "Job $event->getName() has failed", 'APP');            
        });
    }
}
