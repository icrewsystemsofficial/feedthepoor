<?php
namespace App\Helpers;

use Exception;
use App\Models\Mission;

class MissionHelper {

    /**
     * all_statuses - Retrives all the status from the moodel.
     *
     * @return array
     */
    public static function all_statuses() : array {
        return Mission::$status;
    }

    /**
     * A collection of all the Mission Statuses
     *
     * @return array
     */
    private static function status() : array {

        $status = array();



        $status[Mission::$status['PRE_PLANNING']] = array(
            'text' => 'Pre-planning',
            'icon' => 'fa-solid fa-sync',
            'color' => 'muted',
        );


        $status[Mission::$status['NOT_STARTED']] = array(
            'text' => 'Not-started',
            'icon' => 'fa-solid fa-exclamation-triangle',
            'color' => 'warning',
        );

        $status[Mission::$status['IN_PROGRESS']] = array(
            'text' => 'In Progress',
            'icon' => 'fa-solid fa-sync fa-spin',
            'color' => 'info',
        );

        $status[Mission::$status['COMPLETED']] = array(
            'text' => 'Completed',
            'icon' => 'fa-solid fa-check-circle',
            'color' => 'success',
        );

        return $status;
    }

    /**
     * getStatus Pass the status ID, and get the HTML markup for that status.
     *
     * @param  mixed $id
     * @return html
     */
    public static function getStatus_html($id) {

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

    public static function getAllStatuses($status_id = null) {
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
