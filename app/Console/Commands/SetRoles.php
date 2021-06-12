<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class SetRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set Roles for users';

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
        Role::create(['name' => 'guest']);
        Role::create(['name' => 'donor']);
        Role::create(['name' => 'volunteer']);
        Role::create(['name' => 'staff']);
        Role::create(['name' => 'admin']);
        $this->info("Following Roles Generated: Guest | Donor | Volunteer | Staff | Admin");
    }
}
