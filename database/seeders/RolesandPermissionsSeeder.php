<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesandPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          //Seed the default roles



          $roles = array(
            'superadmin',
            'administrator',
            'manager',
            'volunteer',
            'donor',
            'user'
          );

          // Seed the default permissions
          $permissions = array(
            'supreme_control',
            'can_access_dashboard',
            'can_manage_settings',
            'can_manage_payments',
            'can_manage_missions',
            'can_manage_users',
            'can_manage_causes',
            'can_manage_campaigns',
            'is_mission_manager',
            'is_volunteer',
            'is_donor',
          );



          foreach ($permissions as $perms) {
              Permission::firstOrCreate(['name' => $perms]);
              $this->command->warn("Permission: $perms created.");
          }

          foreach ($roles as $role) {

            $role = Role::firstOrCreate(['name' => trim($role)]);
            $this->command->warn("Role: $role->name created.");
            if( $role->name == 'superadmin' ) {
                // assign all permissions
                $role->syncPermissions(Permission::all());
                $this->command->info('SUPER ADMIN: Created, granted all the permissions');

            }
            else if( $role->name == 'manager' ) {
                // assign all permissions
                $role->syncPermissions(
                    Permission::where('name', 'can_manage_settings')
                    ->where('name', 'can_access_dashboard')
                    ->where('name', 'can_manage_payments')
                    ->where('name', 'can_manage_users')
                    ->where('name', 'can_manage_causes')
                    ->where('name', 'can_manage_campaigns')
                    ->where('name', 'can_manage_missions')
                    ->get()
                );
                $this->command->info('Manager: Created, granted can_manage_settings, can_manage_payments permissions');

            }

            else if($role->name == 'donor') {
                $role->syncPermissions(
                    Permission::where('name', 'is_donor')
                    ->get()
                );
                $this->command->info('Manager: Created, granted can_manage_settings, can_manage_payments permissions');
            }
            else if($role->name == 'volunteer'){
                // for others by default only read access

                $role->syncPermissions(
                    Permission::where('name', 'can_manage_settings')
                    ->where('name', 'can_access_dashboard')
                    ->where('name', 'can_manage_payments')
                    ->where('name', 'can_manage_missions')
                    ->where('name', 'is_volunteer')
                    ->get()
                );
                $this->command->info($role->name.': Created, granted can_manage_missions, can_manage_users, can_manage_campaigns permissions');
            }
          }

          $this->command->info('SUCCESS! All roles and permissions seeded');

          // Confirm roles needed
        //   if ($this->command->confirm('Do you wish to grant administrator access to all seeded users?', true)) {
        //       $users = User::all();
        //       foreach($users as $user) {
        //         $user->assignRole('superadmin');
        //         $this->command->info("SUPER ADMIN: Access granted for $user->name.");
        //       }
        //   } else {
        //       $this->command->error('No users were given administrator access. Add manually using artisan command to view the dashboard, OR run the seeder again');
        //   }

              $users = User::all();
              foreach($users as $user) {
                $user->assignRole('superadmin');
                $this->command->info("SUPER ADMIN: Access granted for $user->name.");
              }
    }
}
