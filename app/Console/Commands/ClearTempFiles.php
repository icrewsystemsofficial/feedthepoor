<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Models\Activity;

class ClearTempFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ClearTempFiles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear existing temporary files from campaigns/tmp folder';

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
        activity()->log('Clearing temporary files from campaigns/tmp and donation_media/tmp folder');
        $files = Storage::disk('public')->files('campaigns/tmp') + Storage::disk('public')->files('donation_media/tmp');        
        foreach($files as $file){
            if (time() - filemtime(storage_path('app/public/'.$file)) >= 15 * 60) {
                Storage::disk('public')->delete($file);
            }
        }
        return 0;
    }
}
