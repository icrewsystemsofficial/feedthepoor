<?php

namespace App\Helpers;

use Exception;
use App\Models\Location;
use App\Models\Causes;
use App\Models\Campaigns;

class CampaignsHelper {



    /**
     * all_statuses - Retrives all the status from the moodel.
     *
     * @return array
     */
    public static function all_statuses() : array {
        return Campaigns::$status;
    }

    /**
     * A collection of all the Location Statuses
     *
     * @return array
     */
    private static function status() : array {

        $status = array();

        $status[Campaigns::$status['INACTIVE']] = array(
            'text' => 'Inactive',
            'icon' => 'fa-solid fa-times',
            'color' => 'danger',
        );


        $status[Campaigns::$status['ACTIVE']] = array(
            'text' => 'Active',
            'icon' => 'fa-solid fa-ellipsis-h',
            'color' => 'info',
        );

        $status[Campaigns::$status['PAUSED']] = array(
            'text' => 'Paused',
            'icon' => 'fa-solid fa-exclamation-triangle',
            'color' => 'warning',
        );

        $status[Campaigns::$status['COMPLETED']] = array(
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
    public static function getStatus($id) {

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

    public static function getStatusBadges($id){

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

    public static function getAllStatuses($status_id = null) {
        $all_statuses = self::status();
        $html = '';
        foreach($all_statuses as $id => $status) {
            if ($status_id == $id) {
                $html .= "<option value=".$id." selected>".$status['text']."</option>";
            }
            else {
                $html .= "<option value=".$id.">".$status['text']."</option>";
            }
        }
        return $html;
    }

    public static function formatDate($date) {
        return ($date ? date('F j, Y', strtotime($date)) : '-');
    }

    public static function getLocationsForManage($arr){
        $arr = json_decode($arr);
        $locations = Location::groupBy('id')->get(['id','location_name']);
        $html = '';
        foreach($locations as $location) {
            if (in_array($location->id, $arr)) {
                $html .= "<option value=".$location->id." selected>".$location->location_name."</option>";
            }
            else {
                $html .= "<option value=".$location->id.">".$location->location_name."</option>";
            }
        }
        return $html;
    }

    public static function getCausesForManage($arr){
        $arr = json_decode($arr) ?? [];
        $causes = Causes::groupBy('id')->get(['id','name']);
        $html = '';
        foreach($causes as $cause) {
            if (in_array($cause->id, $arr)) {
                $html .= "<option value=".$cause->id." selected>".$cause->name."</option>";
            }
            else {
                $html .= "<option value=".$cause->id.">".$cause->name."</option>";
            }
        }
        return $html;
    }

    /**
     * getActiveCampaigns - Retrieves all the active campaigns
     *
     * @return array
     */
    public static function getActiveCampaigns()
    {

        return Campaigns::where('campaign_status', Campaigns::$status['ACTIVE'])->get();

    }

    public static function processMoney(int $amount) {
        return '₹'.number_format($amount, '0', '.', ',');
    }

}

?>
