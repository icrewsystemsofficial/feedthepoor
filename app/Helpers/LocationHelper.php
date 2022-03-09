<?php

namespace App\Helpers;

use Exception;
use App\Models\Location;
use App\Models\User;

// This is a custom php class to do all our php dirty work, so that
// we keep our view files clean.
// - Leonard,
// 9th March, 2022

class LocationHelper {



    /**
     * all_statuses - Retrives all the status from the moodel.
     *
     * @return array
     */
    public static function all_statuses() : array {
        return Location::$status;
    }

    /**
     * A collection of all the Location Statuses
     *
     * @return array
     */
    private static function status() : array {

        $status = array();

        $status[Location::$status['INOPERATIONAL']] = array(
            'text' => 'Inoperational',
            'icon' => 'fa-solid fa-exclamation-triangle',
            'color' => 'info',
        );


        $status[Location::$status['ACTIVE']] = array(
            'text' => 'Active',
            'icon' => 'fa-solid fa-check-circle',
            'color' => 'success',
        );

        $status[Location::$status['INACTIVE']] = array(
            'text' => 'Inactive',
            'icon' => 'fa-solid fa-times',
            'color' => 'warning',
        );

        $status[Location::$status['PERMANENTLY_CLOSED']] = array(
            'text' => 'Permanently Closed',
            'icon' => 'fa-solid fa-times-circle',
            'color' => 'danger',
        );

        return $status;
    }

    /**
     * getStatus Pass the status ID, and get the HTML markup for that status.
     *
     * @param  mixed $id
     * @return html
     */
    public static function getStatus($id) {

        if($id == ''){
            if($id != 0) {

                // PHP assumes "0" as false, and throws error.
                // - Leonard

                throw new Exception('Error: status ID not passed.' . $id);
            }
        }

        $all_statuses = self::status();

        if(!isset($all_statuses[$id])){
            throw new Exception('Error: No status with ID '. $id. ' was found');
        }

        $status = $all_statuses[$id];

        $html = "<span class='badge badge-".$status['color']."'><i class='".$status['icon']." me-1'></i>".$status['text']."</span>";
        return $html;
    }

    public static function getAllStatuses() {
        $all_statuses = self::status();
        $html = '';
        foreach($all_statuses as $id => $status) {
            $html .= "<option value='".$id."'>".$status['text']."</option>";
        }
        return $html;
    }

    public static function getAllLocations(){
        $locations = Location::all();
        $html = '';
        $location_names = array();
        foreach ($locations as $location) {
            if (!in_array($location->location_name, $location_names)) {
                array_push($location_names, $location->location_name);
                $html .= "<option value='".$location->location_name."'>".$location->location_name."</option>";
            }
        }
        return $html;
    }

    public static function getAllManagers(){
        $managers = User::all();
        $html = '';
        foreach ($managers as $manager) {
            $html .= "<option value='".$manager->id."'>".$manager->name."</option>";
        }
        return $html;
    }

    public static function getStatusesForManage($status_id){
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

}

?>
