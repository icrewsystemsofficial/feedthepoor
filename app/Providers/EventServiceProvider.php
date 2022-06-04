<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\Donations\AddDonation;
use App\Listeners\Donations\AddDonationListener;
use App\Events\Donations\DonationReceived;
use App\Listeners\Donations\DonationReceivedListener;
use App\Events\Mission\MissionCreateOrUpdate;
use App\Listeners\Mission\MissionCreateOrUpdateListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // AddDonation::class => [
        //     AddDonationListener::class,
        // ],
        DonationReceived::class => [
            DonationReceivedListener::class,
            // AddDonationListener::class,
        ],
        MissionCreateOrUpdate::class => [
            MissionCreateOrUpdateListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
