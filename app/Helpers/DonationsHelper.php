<?php

namespace App\Helpers;

use Exception;
use App\Models\Donations;
use App\Models\User;
use App\Models\Causes;
use App\Models\Campaigns;

class DonationsHelper {


    public static function all_statuses() : array {
        return Donations::$status;
    }

    public static function all_payment_methods() : array {
        return Donations::$payment_methods;
    }

    public static function get_payment_method(int $id) {
        $all_methods = self::all_payment_methods();
        $all_methods = array_flip($all_methods);

        if(array_key_exists($id, $all_methods)) {
            return $all_methods[$id];
        } else {
            throw new Exception("Given payment method was not found on Donation Model");
        }


    }

    private static function status() : array {

        $status = array();

        $status[Donations::$status['PENDING']] = array(
            'text' => 'Processing',
            'icon' => 'fa-solid fa-exclamation-triangle',
            'color' => 'info',
        );


        $status[Donations::$status['VERIFIED']] = array(
            'text' => 'Fullfilled',
            'icon' => 'fa-solid fa-check-circle',
            'color' => 'success',
        );

        $status[Donations::$status['FAILED']] = array(
            'text' => 'Failed',
            'icon' => 'fa-solid fa-times-circle',
            'color' => 'danger',
        );

        $status[Donations::$status['REFUNDED']] = array(
            'text' => 'Refunded',
            'icon' => 'fa-solid fa-times',
            'color' => 'warning',
        );

        return $status;
    }

    /**
     * getStatus Pass the status ID, and get the HTML markup for that status.
     *
     * @param  mixed $id
     * @return html
     */
    public static function getStatus(int $id) {
        if($id == ''){
            if($id != 0) {
                throw new Exception('Error: status ID not passed.' . $id);
            }
        }

        $all_statuses = self::status();

        if(!isset($all_statuses[$id])){
            throw new Exception('Error: No status with ID '. $id. ' was found');
        }

        $status = $all_statuses[$id];

        $onclick = '$("#search").val("' . $status['text'] . <<<EOF
        ");$("#search").keyup();$("#search").focus();
        EOF;

        $html = "<span class='badge badge-".$status['color']."' onclick='".$onclick."'><i class='".$status['icon']." me-1'></i>".$status['text']."</span>";

        return $html;
    }

    public static function getStatusBadges(int $id){

        $all_statuses = self::status();
        $html = '';
        foreach($all_statuses as $sid => $status){
            if ($sid == $id) {
                $html .= "<span id='".$status['text']."' class='show-badge badge badge-".$status['color']."'><i class='".$status['icon']." me-1'></i>".$status['text']."</span>";
            }
            else {
                $html .= "<span id='".$status['text']."' class='hide-badge badge badge-".$status['color']."'><i class='".$status['icon']." me-1'></i>".$status['text']."</span>";
            }
        }
        return $html;

    }

    public static function getAllDonors(int $id = null) {
        $html = '';
        foreach(User::all() as $user) {
            if ($user->id == $id) {
                $html .= '<option value="'.$user->id.'" selected>'.$user->name.'</option>';
            }
            else {
                $html .= '<option value="'.$user->id.'">'.$user->name.'</option>';
            }
        }
        return $html;
    }

    public static function getAllCauses(int $id = null) {
        $html = '';
        $selected = 0;
        foreach(Causes::all() as $cause) {
            if ($cause->id == $id) {
                $html .= '<option value="'.$cause->id.'" selected>'.$cause->name.'</option>';
                $selected = 1;
            }
            else {
                $html .= '<option value="'.$cause->id.'">'.$cause->name.'</option>';
            }
        }
        $html .= $selected ? '' : '<option value="0" selected>None</option>';
        return $html;
    }

    public static function getAllCampaigns(int $id = null){

        $html = '';
        $selected = 0;
        foreach(Campaigns::all() as $campaign) {
            if ($campaign->id == $id) {
                $html .= '<option value="'.$campaign->id.'" selected>'.$campaign->campaign_name.'</option>';
                $selected = 1;
            }
            else {
                $html .= '<option value="'.$campaign->id.'">'.$campaign->campaign_name.'</option>';
            }
        }
        $html .= $selected ? '' : '<option value="0" selected>None</option>';
        return $html;

    }

    public static function getAllPaymentMethods(string $method = null) {
        $html = '';
        $methods = self::all_payment_methods();
        foreach($methods as $method_name => $mid) {
            if ($mid == $method) {
                $html .= '<option value="'.$mid.'" selected>'.ucfirst(strtolower($method_name)).'</option>';
            }
            else {
                $html .= '<option value="'.$mid.'">'.ucfirst(strtolower($method_name)).'</option>';
            }
        }
        return $html;
    }

    public static function getAllStatuses(int $status_id = null) {
        $all_statuses = self::status();
        $html = '';
        foreach($all_statuses as $id => $status) {
            if ($id == $status_id) {
                $html .= "<option value='".$id."' selected>".$status['text']."</option>";
            }
            else {
                $html .= "<option value='".$id."'>".$status['text']."</option>";
            }
        }
        return $html;
    }


    /**
     * getTotalDonationsForCause
     *
     * @param  mixed $cause
     * @return void
     */
    public static function getTotalDonationsForCause(Causes $cause) {

        $donations = Donations::where('cause_id', $cause->id)->count();

        if($donations == 0) {
            $total_donations = '(Unable to fetch)';
        } else {
            $total_donations = $donations;
        }

        return $total_donations;
    }

}

?>
