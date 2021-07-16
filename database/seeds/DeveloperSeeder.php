<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($firstName = '', $lastName = '', $email = '', $password = '', $shouldSeed = false)
    {
        if ($shouldSeed) {
            $user = User::where('email', $email)->first();
            if (!$user) {
                $encPass = Hash::make($password);
                DB::table('users')->insert([
                    'name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $email,
                    'email_verified_at' => now(),
                    'password' => $encPass,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $usern = User::where('email', $email)->first();
                $usern->assignRole('admin');
                Storage::disk('public')->append('Developers.txt', $firstName . " " . $lastName . " " . $email . " " . $encPass);

                echo "\nUser: " . $firstName . " " . $lastName . " created.\n";
            } else {
                echo "\nUser already exists!\n";
            }
        } else {
            if (Storage::disk('public')->exists('Developers.txt')) {
                $contents = Storage::disk('public')->get('Developers.txt');

                foreach (preg_split("/((\r?\n)|(\r\n?))/", $contents) as $line) {
                    if ($line != '') {
                        $devArray = explode(" ", $line);
                        $firstName = $devArray[0];
                        $lastName = $devArray[1];
                        $email = $devArray[2];
                        $password = $devArray[3];

                        $user = User::where('email', $email)->first();
                        if (!$user) {
                            $encPass = $password;
                            DB::table('users')->insert([
                                'name' => $firstName,
                                'last_name' => $lastName,
                                'email' => $email,
                                'email_verified_at' => now(),
                                'password' => $encPass,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                            $usern = User::where('email', $email)->first();
                            $usern->assignRole('admin');
                            echo "\nUser: " . $firstName . " " . $lastName . " created.\n";
                        } else {
                            echo "\nUser already exists!\n";
                        }
                    }
                }
            } else {
                echo "\nFile Not Found. Cannot Seed Developers in DB\n";
            }
        }
    }
}
