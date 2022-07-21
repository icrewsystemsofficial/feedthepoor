<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Helpers\NotificationHelper;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class NotifyAllAdmins implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;

    //Using a job to do this because ALL/MAIL type notifications will take quite a while to be sent    
    public $title;
    public $body;
    public $type;
    public $action;
    public $color;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($title, $body, string $type = 'APP', string $action = '#', string $color = 'dark')
    {
        $this->title = $title;
        $this->body = $body;
        $this->type = $type;
        $this->action = $action;
        $this->color = $color;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        app(NotificationHelper::class)->
        notifyAllAdmins($this->title, $this->body, $this->type, $this->action, $this->color);
    }
}
