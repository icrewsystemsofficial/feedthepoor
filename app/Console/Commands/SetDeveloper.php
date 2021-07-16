<?php

namespace App\Console\Commands;

use Database\Seeders\DeveloperSeeder;
use Illuminate\Console\Command;

class SetDeveloper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'developer:set';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an account for developer';

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
        $this->info('This will create a new account for developer');
        $firstName = $this->ask('Enter your first name');
        $lastName = $this->ask('Enter your last name');
        $email = $this->ask('Enter your email');
        $password = $this->secret('Enter Password');
        $confirmPassword = $this->secret('Confirm Password');

        if ($firstName == null || $lastName == null) {
            $this->error('Names should not be null. Try Again :(');
            exit();
        }

        if ($email == null) {
            $this->error('Email should not be null. Try Again :(');
            exit();
        }

        if ($password == null || $confirmPassword == null) {
            $this->error('Names should not be null. Try Again :(');
            exit();
        }

        if ($password != $confirmPassword) {
            $this->error('Passwords do not match. Try again :(');
            exit();
        }
        $seeder = new DeveloperSeeder();
        $seeder->run($firstName, $lastName, $email, $password, true);
    }
}
