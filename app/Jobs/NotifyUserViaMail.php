<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Helpers\NotificationHelper;
use App\Models\User;
use Exception;

class NotifyUserViaMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $title;
    public $body;
    public $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($title, $body, $user)
    {
        $this->title = $title;
        $this->body = $body;
        $this->user = User::where('id', $user)->exists() ? User::find($user) : throw new Exception("Notification Helper Error: User with ID $user not found");
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        app(NotificationHelper::class)->        
        user($this->user)->
        content($this->title, $this->body)->
        type('1')->
        notify();
    }
}
