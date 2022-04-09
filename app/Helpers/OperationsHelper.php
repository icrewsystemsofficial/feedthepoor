<?php

namespace App\Helpers;

use Exception;
use App\Models\Operations;
use App\Models\Location;


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
            throw new Exception('Error: status not passed');
        }

        $all_statuses = self::status();

        if(!isset($all_statuses[$status])){
            throw new Exception('Error: No status with was found');
        }

        $status = $all_statuses[$status];
        $onclick = <<<EOF
        $("#search").val($(this).text());$("#search").keyup();$("#search").focus();
        EOF;
        $html = "<span class='badge' style='background-color: ".$status['color']."' onclick='".$onclick."'><i class='".$status['icon']." me-1'></i>".$status['text']."</span>";

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

    public static function getProcurementLocation($id,$i){

        $locations = Location::all();

        $html = "<select id='location_".$i."' class='form-control'>";

        foreach ($locations as $location){
            $html .= ($location->id == $id) ? "<option value='".$location->id."' selected>".$location->location_name."</option>" : "<option value='".$location->id."'>".$location->location_name."</option>";
        }

        return $html;

    }

    public static function getStatusNumbers(){
        $operations = Operations::all();
        $status = [
                'UNACKNOWLEDGED' => 0,
                'ACKNOWLEDGED' => 0,
                'PROCUREMENT ORDER INITIATED' => 0,
                'DELAYED' => 0,
                'READY FOR MISSION DISPATCH' => 0,
                'ASSIGNED TO MISSION' => 0,
                'FULFILLED' => 0,
        ];
        foreach ($operations as $operation) {
            $status[$operation->status]++;
        }
        return $status;
    }

}
