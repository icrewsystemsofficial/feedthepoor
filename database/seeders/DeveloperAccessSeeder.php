<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DeveloperAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line('Seeding Users from DeveloperAccess file...');
        $user = User::where('name', 'Leonard Selvaraja')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Leonard Selvaraja';
            $user->email = 'kashrayks@gmail.com';
            $user->email_verified_at = now();
            $user->password = "$2y$10$8CfoYn2vturcIeuGRQfzfuUb1XOT2G3aSvZZBiISMbz80hxfAHM7.";
            $user->role = 'superadmin';
            $user->save();
            $this->command->info("User: Leonard Selvaraja created.");
        }

        $user = User::where('name', 'Thirumalai')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Thirumalai';
            $user->email = 'm.thirurahul@gmail.com';
            $user->email_verified_at = now();
            $user->password = '$2y$10$gp5aizeQoP2mLDCPj.utb.xXS1rQaM3PkXd.Z1XliBWTxQcdXqqUC';
            $user->role = 'superadmin';
            $user->save();
            $this->command->info("User: Thirumalai created.");
        }

        $user = User::where('name', 'Dinesh Kumar')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Dinesh Kumar';
            $user->email = 'john.doe@test.com';
            $user->email_verified_at = now();
            $user->password = '$2y$10$RufvOqmxVVsmvWA0w9P2DuMhbfxLt8lQQrxZNCB1nu7NtpJDj1jvi';
            $user->role = 'superadmin';
            $user->save();
            $this->command->info("User: Dinesh Kumar created.");
        }

        $user = User::where('name', 'Samay Bhattacharyya')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Samay Bhattacharyya';
            $user->email = 'lyrakerman@gmail.com';
            $user->email_verified_at = now();
            $user->password = '$2y$10$Z2fX/TDd7hIjBnamBhW9/eiffpxiVddzY/Kyihap2A074PXHMb2jG';
            $user->role = 'superadmin';
            $user->save();
            $this->command->info("User: Samay Bhattacharyya created.");
        }


    }
}
