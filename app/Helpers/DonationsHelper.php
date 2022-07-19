<?php

namespace App\Helpers;

use Carbon\Carbon;
use Exception;
use App\Models\User;
use App\Models\Causes;
use App\Models\Campaigns;
use App\Models\Donations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;

class DonationsHelper
{


    public static function all_statuses(): array
    {
        return Donations::$status;
    }

    public static function all_payment_methods(): array
    {
        return Donations::$payment_methods;
    }

    public static function get_payment_method(int $id)
    {
        $all_methods = self::all_payment_methods();
        $all_methods = array_flip($all_methods);

        if (array_key_exists($id, $all_methods)) {
            return $all_methods[$id];
        } else {
            throw new Exception("Given payment method was not found on Donation Model");
        }


    }

    private static function status(): array
    {

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


        $status[Donations::$status['MISSION ASSIGNED']] = array(
            'text' => 'Mission Assigned',
            'icon' => 'fa-solid fa-times',
            'color' => 'warning',
        );

        $status[Donations::$status['FIELD WORK DONE']] = array(
            'text' => 'Field Work Done',
            'icon' => 'fa-solid fa-times',
            'color' => 'warning',
        );

        $status[Donations::$status['PICTURES UPDATED']] = array(
            'text' => 'Pictures updated',
            'icon' => 'fa-solid fa-times',
            'color' => 'warning',
        );


        return $status;
    }

    /**
     * getStatus Pass the status ID, and get the HTML markup for that status.
     *
     * @param mixed $id
     * @return html
     */
    public static function getStatus(int $id)
    {
        if ($id == '') {
            if ($id != 0) {
                throw new Exception('Error: status ID not passed.' . $id);
            }
        }

        $all_statuses = self::status();

        if (!isset($all_statuses[$id])) {
            throw new Exception('Error: No status with ID ' . $id . ' was found');
        }

        $status = $all_statuses[$id];

        $onclick = '$("#search").val("' . $status['text'] . <<<EOF
        ");$("#search").keyup();$("#search").focus();
        EOF;

        $html = "<span class='badge badge-" . $status['color'] . "' onclick='" . $onclick . "'><i class='" . $status['icon'] . " me-1'></i>" . $status['text'] . "</span>";

        return $html;
    }

    public static function getStatusBadges(int $id)
    {

        $all_statuses = self::status();
        $html = '';
        foreach ($all_statuses as $sid => $status) {
            if ($sid == $id) {
                $html .= "<span id='" . $status['text'] . "' class='show-badge badge badge-" . $status['color'] . "'><i class='" . $status['icon'] . " me-1'></i>" . $status['text'] . "</span>";
            } else {
                $html .= "<span id='" . $status['text'] . "' class='hide-badge badge badge-" . $status['color'] . "'><i class='" . $status['icon'] . " me-1'></i>" . $status['text'] . "</span>";
            }
        }
        return $html;

    }

    public static function getAllDonors(int $id = null)
    {
        $html = '';
        foreach (User::all() as $user) {
            if ($user->id == $id) {
                $html .= '<option value="' . $user->id . '" selected>' . $user->name . '</option>';
            } else {
                $html .= '<option value="' . $user->id . '">' . $user->name . '</option>';
            }
        }
        return $html;
    }

    public static function getAllCauses(int $id = null)
    {
        $html = '';
        $selected = 0;
        foreach (Causes::all() as $cause) {
            if ($cause->id == $id) {
                $html .= '<option value="' . $cause->id . '" selected>' . $cause->name . '</option>';
                $selected = 1;
            } else {
                $html .= '<option value="' . $cause->id . '">' . $cause->name . '</option>';
            }
        }
        $html .= $selected ? '' : '<option value="0" selected>None</option>';
        return $html;
    }

    public static function getAllCampaigns(int $id = null)
    {

        $html = '';
        $selected = 0;
        foreach (Campaigns::all() as $campaign) {
            if ($campaign->id == $id) {
                $html .= '<option value="' . $campaign->id . '" selected>' . $campaign->campaign_name . '</option>';
                $selected = 1;
            } else {
                $html .= '<option value="' . $campaign->id . '">' . $campaign->campaign_name . '</option>';
            }
        }
        $html .= $selected ? '' : '<option value="0" selected>None</option>';
        return $html;

    }

    public static function getAllPaymentMethods(string $method = null)
    {
        $html = '';
        $methods = self::all_payment_methods();
        foreach ($methods as $method_name => $mid) {
            if ($mid == $method) {
                $html .= '<option value="' . $mid . '" selected>' . ucfirst(strtolower($method_name)) . '</option>';
            } else {
                $html .= '<option value="' . $mid . '">' . ucfirst(strtolower($method_name)) . '</option>';
            }
        }
        return $html;
    }

    public static function getAllStatuses(int $status_id = null)
    {
        $all_statuses = self::status();
        $html = '';
        foreach ($all_statuses as $id => $status) {
            if ($id == $status_id) {
                $html .= "<option value='" . $id . "' selected>" . $status['text'] . "</option>";
            } else {
                $html .= "<option value='" . $id . "'>" . $status['text'] . "</option>";
            }
        }
        return $html;
    }


    /**
     * getTotalDonationsForCause
     *
     * @param mixed $cause
     * @return void
     */
    public static function getTotalDonationsForCause(Causes $cause)
    {

        $donations = Donations::where('cause_id', $cause->id)->count();

        if ($donations == 0) {
            $total_donations = '(Unable to fetch)';
        } else {
            $total_donations = $donations;
        }

        return $total_donations;
    }


    /**
     * addDonationActivity - This is required for tracking a donation activity.
     *
     * @param mixed $donation
     * @param mixed $description
     * @return void
     */
    public static function addDonationActivity(Donations $donation, string $description)
    {

        if (!Auth::check()) {
            /**
             * User is not logged in, this event
             * is likely caused by a background Job.
             *
             */


        }

        activity()
            ->performedOn($donation)
            ->tap(function (Activity $activity) {
                $activity->event = 'Automated Background Task';
            })
            ->log($description);

        return;
    }


    /**
     * get_donation_status_badge - for the tracking page.
     *
     * @param mixed $id
     * @return void
     */
    public static function get_donation_status_badge(int $id)
    {
        $all_statuses = self::status();
        return $all_statuses[$id];
    }


    /**
     * get_status_change_context
     *
     * @param mixed $activity
     * @return string
     */
    public static function get_status_change_context($activity, int $style = 1): string
    {


        switch ($activity->subject_type) {
            case "App\Models\Donations":
                if (!isset($activity->changes['old']) && !isset($activity->changes['old'])) {
                    /**
                     *
                     * This function is executed when Model entries are "created" or "destroyed"
                     *
                     */

                    return "Donation entry (#" . $activity->subject_id . ") has been " . $activity->description;
                }

                $old = $activity->changes['old']['donation_status'];
                $new = $activity->changes['attributes']['donation_status'];

                $previous = self::get_donation_status_badge($old)['text'];
                $current = self::get_donation_status_badge($new)['text'];


                $all_status = self::status();

                $previous_color = $all_status[$old]['color'];
                $current_color = $all_status[$new]['color'];

                switch ($style) {
                    case 1:
                        $context = 'Donation status has been updated. <span class="line-through text-' . $previous_color . '">' . $previous . '</span> <span class="text-' . $current_color . ' font-bold">' . $current . '</span>';
                        break;

                    case 2:

                        $context = 'Donation status has been updated from <span class="text-' . $previous_color . ' font-bold">' . $previous . '</span> to <span class="text-' . $current_color . ' font-bold">' . $current . '</span>';
                        break;

                    default:
                        $context = 'Donation status has been updated. <span class="line-through text-' . $previous_color . '">' . $previous . '</span> <span class="text-' . $current_color . ' font-bold">' . $current . '</span>';
                        break;
                }

                break;


            case "App\Models\Operations":
                if (!isset($activity->changes['old']) && !isset($activity->changes['old'])) {
                    /**
                     *
                     * This function is executed when Model entries are "created" or "destroyed"
                     *
                     */

                    return "Procurement list entry (#" . $activity->subject_id . ") has been " . $activity->description;
                }

                $old = $activity->changes['old']['status'];
                $new = $activity->changes['attributes']['status'];

                $previous = OperationsHelper::get_operations_status_badge($old)['text'];
                $current = OperationsHelper::get_operations_status_badge($new)['text'];


                $all_status = self::status();

                $previous_color = $all_status[$old]['color'];
                $current_color = $all_status[$new]['color'];

                switch ($style) {
                    case 1:
                        $context = 'Procurement list status has been updated. <span class="line-through text-' . $previous_color . '">' . $previous . '</span> <span class="text-' . $current_color . ' font-bold">' . $current . '</span>';
                        break;

                    case 2:

                        $context = 'Procurement list status has been updated from <span class="text-' . $previous_color . ' font-bold">' . $previous . '</span> to <span class="text-' . $current_color . ' font-bold">' . $current . '</span>';
                        break;

                    default:
                        $context = 'Procurement list status has been updated. <span class="line-through text-' . $previous_color . '">' . $previous . '</span> <span class="text-' . $current_color . ' font-bold">' . $current . '</span>';
                        break;
                }
                break;

            default:
                $context = 'Unable to handle activity. Please report this to our team';
                break;

        }


        return $context;
    }

    public static function getPerdayDonations()
    {
        $donations = Donations::whereDate('created_at', '=', Carbon::yesterday())->get();
        $total_amount = $donations->sum('donation_amount');

        return $total_amount;
    }

    public static function getTotalDonars()
    {
        $donations = Donations::whereDate('created_at', '=', Carbon::yesterday())->get();
        return $donations->count();
    }

}

?>
