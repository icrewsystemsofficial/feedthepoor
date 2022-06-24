<?php

namespace App\Helpers;

use Exception;
use App\Models\Operations;
use App\Models\Location;


class OperationsHelper {

    /**
     * status
     *
     * Return status details for their respective IDs
     *
     * @return array
     */
    private static function status() : array {

        $status = array();

        $status[Operations::$status['UNACKNOWLEDGED']] = array(
            'text' => 'Unacknowledged',
            'icon' => 'fa-solid fa-exclamation-triangle',
            'color' => '#d9534f',
        );

        $status[Operations::$status['ACKNOWLEDGED']] = array(
            'text' => 'Acknowledged',
            'icon' => 'fa-solid fa-check-circle',
            'color' => '#f59f00',
        );

        $status[Operations::$status['PROCUREMENT ORDER INITIATED']] = array(
            'text' => 'Procurement Order Initiated',
            'icon' => 'fa-solid fa-check-circle',
            'color' => '#388299',
        );

        $status[Operations::$status['DELAYED']] = array(
            'text' => 'Delayed',
            'icon' => 'fa-solid fa-times',
            'color' => '#ff0000',
        );

        $status[Operations::$status['READY FOR MISSION DISPATCH']] = array(
            'text' => 'Ready for Mission Dispatch',
            'icon' => 'fa-solid fa-check-circle',
            'color' => '#5bc0de',
        );

        $status[Operations::$status['ASSIGNED TO MISSION']] = array(
            'text' => 'Assigned to Mission',
            'icon' => 'fa-solid fa-check-circle',
            'color' => '#008000',
        );

        $status[Operations::$status['FULFILLED']] = array(
            'text' => 'Fulfilled',
            'icon' => 'fa-solid fa-check-circle',
            'color' => '#5cb85c',
        );

        return $status;
    }

    /**
     * getProcurementBadge
     *
     * Accept a status ID and return the status badge HTML markup
     *
     * @param  int $status
     * @return void
     */
    public static function getProcurementBadge(int $status) {

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

    /**
     * getProcurementStatus
     *
     * Accept a status ID and Operation ID and return a select HTML element
     *
     * @param  int $status
     * @param  inr $i
     * @return string
     */
    public static function getProcurementStatus(string $status, string $i){

        if($status == ''){
            throw new Exception('Error: status not passed.' . $status);
        }

        $all_statuses = self::status();

        if(!isset($all_statuses[$status])){
            throw new Exception('Error: No status with ID '. $status. ' was found');
        }

        $html = "<select id='status_".$i."' class='form-control'>";

        foreach($all_statuses as $id => $val) {
            $html .= ($id == $status) ? "<option value='".$id."' selected>".$val['text']."</option>" : "<option value='".$id."'>".$val['text']."</option>";
        }

        return $html;

    }

    /**
     * getLocationBadge
     *
     * Accept location ID as parameter and return the location name
     *
     * @param  int $id
     * @return string
     */
    public static function getLocationBadge(string $id){

        return Location::find($id)->location_name ?? 'None';

    }

    /**
     * getProcurementLocation
     *
     * Accept location ID as parameter and return a select HTML element
     *
     * @param  mixed $id
     * @param  mixed $i
     * @return void
     */
    public static function getProcurementLocation( string $id, string $i){

        if($id == ''){
            throw new Exception('Error: location ID not passed.' . $status);
        }

        $locations = Location::all();

        if(!Location::find($id) && $id != 0){
            throw new Exception('Error: No location with ID '. $id. ' was found');
        }

        $html = "<select id='location_".$i."' class='form-control'>";
        $selected = 0;

        foreach($locations as $location) {
            if ($location->id == $id){
                $html .= "<option value='".$id."' selected>".$location->location_name."</option>";
                $selected = 1;
            } else {
                $html .= "<option value='".$location->id."'>".$location->location_name."</option>";
            }
        }

        if (!$selected){
            $html .= "<option value='0' selected>None</option>";
        }

        return $html;


    }

    /**
     * getStatusNumbers
     *
     * Return an array of status numbers and their respective counts
     *
     * @return array
     */
    public static function getStatusNumbers(){

        $operations = Operations::all();

        $status = [
            0 => 0,
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
        ];

        foreach ($operations as $operation) {

            $status[$operation->status]++;

        }

        return $status;
    }

    /**
     * get_operations_status_badge - for the tracking page.
     *
     * @param  mixed $id
     * @return void
     */
    public static function get_operations_status_badge(int $id) {
        $all_statuses = self::status();
        return $all_statuses[$id];
    }


}
