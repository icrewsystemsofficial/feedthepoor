<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;

class QueueRunnerAPIController extends Controller
{
    public function run() {

        //Since we're getting errors while runing cron jobs via cPanel, this
        //is a work around.
        $discord = config('services.discord.webhook');

        Http::post($discord, [
            'username' => config('app.name') .' ('. config('app.env') .') '. config('app.url') .'',
            'content' => 'The schedule:run command has been triggered by the API',
        ]);

        Artisan::call('schedule:run');
        $output = Artisan::output();
    }

    public function list() {
        Artisan::call('schedule:list');
        $output = Artisan::output();
        return $output;
    }

}
