<?php
namespace App\Helpers;

use App\Models\User;
use App\Models\Location;
use Illuminate\Support\Str;

class UserHelper {


    /**
     * generate_role_status_badges
     *
     * @param  mixed $role
     * @return void
     */
    public static function generate_role_status_badges($role) {

        $role_name = $role->name;


        switch($role_name) {
            case "superadmin":
                $icon = '<i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> ';
                $color = 'bg-danger';
            break;

            case "administrator":
                $icon = '<i class="fa-solid fa-star"></i>';
                $color = 'bg-danger';
            break;

            case "manager":
                $icon = '<i class="fa-solid fa-star"></i> ';
                $color = 'bg-info';
            break;

            case "volunteer":
                $icon = '<i class="fa-solid fa-user"></i>';
                $color = 'bg-info';
            break;

            case "donor":
                $icon = '<i class="fa-solid fa-money-bill"></i>';
                $color = 'bg-success';
            break;

            default:
                $icon = '<i class="fa-solid fa-times"></i>';
                $color = 'bg-secondary';
            break;
        }

        $role_name = Str::upper($role_name);

        $html = '<span class="badge ' . $color . ' cursor-pointer" onclick="getUsers(\'' . $role->name . '\')">
                    '. $icon . ' '. $role_name .'
                </span>';

        return $html;
    }

    /**
     * get_user_roles
     *
     * @param  mixed $user
     * @return void
     */
    public static function get_user_roles(User $user) {
        // check if the user has roles.
        $roles = $user->getRoleNames();

        if($roles->count() > 0) {
            $role_name = $roles[0];
        } else {
            // The user does not have a role.
            $role_name = 'No role assigned';
        }

        switch($role_name) {
            case "superadmin":
                $icon = '<i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> ';
                $color = 'bg-danger';
            break;

            case "administrator":
                $icon = '<i class="fa-solid fa-star"></i>';
                $color = 'bg-danger';
            break;

            case "manager":
                $icon = '<i class="fa-solid fa-star"></i> ';
                $color = 'bg-info';
            break;

            case "volunteer":
                $icon = '<i class="fa-solid fa-user"></i>';
                $color = 'bg-info';
            break;

            case "donor":
                $icon = '<i class="fa-solid fa-money-bill"></i>';
                $color = 'bg-success';
            break;

            default:
                $icon = '<i class="fa-solid fa-times"></i>';
                $color = 'bg-secondary';
            break;
        }

        $html = '<span class="badge '. $color .' cursor-pointer">'. $icon . ' ' . Str::upper($role_name) .'</span>';
        return $html;
    }


}

?>
