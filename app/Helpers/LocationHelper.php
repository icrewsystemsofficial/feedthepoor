<?php

namespace App\Helpers;

use Exception;
use App\Models\Location;

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

        $status[0] = array(
            'text' => 'Inoperational',
            'icon' => 'fa-solid fa-exclamation-triangle',
            'color' => 'info',
        );


        $status[1] = array(
            'text' => 'Active',
            'icon' => 'fa-solid fa-check-circle',
            'color' => 'success',
        );

        $status[2] = array(
            'text' => 'Inactive',
            'icon' => 'fa-solid fa-times',
            'color' => 'warning',
        );

        $status[3] = array(
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
     * @return void
     */
    public static function getStatus($id) {

        if(is_null($id) || empty($id)) {
            if($id != 0) {
                // Because we use "0" as a location status, so allow it to pass...
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
}

?>
