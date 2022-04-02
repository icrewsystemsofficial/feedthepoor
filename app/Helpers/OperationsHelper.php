<?php

namespace App\Helpers;

use Exception;
use App\Models\Operations;


class OperationsHelper {

    private static function status() : array {

        $status = array();

        $status['UNACKNOWLEDGED'] = array(
            'text' => 'Unacknowledged',
            'icon' => 'fa-solid fa-exclamation-triangle',
            'color' => '#d9534f',
        );
        
        $status['ACKNOWLEDGED'] = array(
            'text' => 'Acknowledged',
            'icon' => 'fa-solid fa-check-circle',
            'color' => '#f59f00',
        );

        $status['PROCUREMENT ORDER INITIATED'] = array(
            'text' => 'Procurement Order Initiated',
            'icon' => 'fa-solid fa-check-circle',
            'color' => '#388299',
        );

        $status['DELAYED'] = array(
            'text' => 'Delayed',
            'icon' => 'fa-solid fa-times',
            'color' => '#ff0000',
        );

        $status['READY FOR MISSION DISPATCH'] = array(
            'text' => 'Ready for Mission Dispatch',
            'icon' => 'fa-solid fa-check-circle',
            'color' => '#5bc0de',
        );

        $status['ASSIGNED TO MISSION'] = array(
            'text' => 'Assigned to Mission',
            'icon' => 'fa-solid fa-check-circle',
            'color' => '#008000',
        );

        $status['FULFILLED'] = array(
            'text' => 'Fulfilled',
            'icon' => 'fa-solid fa-check-circle',
            'color' => '#5cb85c',
        );

        return $status;
    }

    public static function getProcurementBadge($status) {

        if($status == ''){
            throw new Exception('Error: status not passed.' . $id);
        }

        $all_statuses = self::status();

        if(!isset($all_statuses[$status])){
            throw new Exception('Error: No status with ID '. $id. ' was found');
        }

        $status = $all_statuses[$status];

        $html = "<span class='badge' style='background-color: ".$status['color']."'><i class='".$status['icon']." me-1'></i>".$status['text']."</span>";
        
        return $html;
    }

    public static function getProcurementStatus($status, $i){
        
        if($status == ''){
            throw new Exception('Error: status not passed.' . $id);
        }

        $all_statuses = self::status();

        if(!isset($all_statuses[$status])){
            throw new Exception('Error: No status with ID '. $id. ' was found');
        }

        $html = "<select id='status_".$i."' class='form-control'>";

        foreach($all_statuses as $id => $val) {
            $html .= ($id == $status) ? "<option value='".$id."' selected>".$id."</option>" : "<option value='".$id."'>".$id."</option>";
        }
        
        return $html;

    }

}