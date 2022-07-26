<?php

namespace App\Helpers;

use Exception;
use App\Models\User;
use App\Models\Causes;
use App\Models\Campaigns;
use App\Models\Donations;
use App\Models\DonationMedia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use Intervention\Image\Facades\Image;
use ProtoneMedia\LaravelFFMpeg\Filters\WatermarkFactory;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Illuminate\Support\Facades\Validator;

class DonationsHelper {
    
    /**
     * validateDonationRequest - Validate the request data for the donation
     *
     * @param  mixed $request
     * @return void
     */
    public static function validateDonationRequest($request) {
        $validator = Validator::make($request->all(), [
            'donor_id' => 'required|exists:users,id',
            'donation_amount' => 'required|numeric',
            'cause_id' => 'string|exists:causes,id',
            'campaign_id' => 'string|exists:campaigns,id',
            'donation_status' => 'required|integer',
            'payment_method' => 'required|integer',
            'razorpay_payment_id' => 'required_if:payment_method,4',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public static function validateDonationMediaRequest($request) {
        $validator = Validator::make($request->all(), [
            'donation_id' => 'required|string|exists:donations,id',
            'donation_media' => 'required|max:4112',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }


    private static $watermarkImage = "data:image/png;base64,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";

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
     * @param  mixed $id
     * @return html
     */
    public static function getStatus(int $id): string {
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

    public static function getStatusBadges(int $id): string{

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

    public static function getAllDonors(string $id = null): string {
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

    public static function getAllCauses(string $id = null): string {
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

    public static function getAllCampaigns(string $id = null): string{

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

    public static function getAllPaymentMethods(string $method = null): string {
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

    public static function getAllStatuses(int $status_id = null): string {
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
    public static function getTotalDonationsForCause(Causes $cause): int {

        $donations = Donations::where('cause_id', $cause->id)->count();

        /*if($donations == 0) {
            $total_donations = '(Unable to fetch)';
        } else {
            $total_donations = $donations;
        }*/

        return $total_donations;
    }


    /**
     * addDonationActivity - This is required for tracking a donation activity.
     *
     * @param  mixed $donation
     * @param  mixed $description
     * @return void
     */
    public static function addDonationActivity(Donations $donation, string $description): void {

        if(!Auth::check()) {
            /**
             * User is not logged in, this event
             * is likely caused by a background Job.
             *
             */




        }

        activity()
        ->performedOn($donation)
        ->tap(function(Activity $activity) {
            $activity->event = 'Automated Background Task';
         })
        ->log($description);
    }


    /**
     * get_donation_status_badge - for the tracking page.
     *
     * @param  mixed $id
     * @return void
     */
    public static function get_donation_status_badge(int $id): array {
        
        return self::status()[$id];

    }


    /**
     * get_status_change_context
     *
     * @param  mixed $activity
     * @return string
     */
    public static function get_status_change_context($activity, int $style = 1) : string {



        switch($activity->subject_type) {
            case "App\Models\Donations":
                if(!isset($activity->changes['old']) && !isset($activity->changes['old'])) {
                    /**
                     *
                     * This function is executed when Model entries are "created" or "destroyed"
                     *
                     */

                    return "Donation entry (#".$activity->subject_id.") has been ". $activity->description;
                }

                $old = $activity->changes['old']['donation_status'];
                $new = $activity->changes['attributes']['donation_status'];

                $previous = self::get_donation_status_badge($old)['text'];
                $current = self::get_donation_status_badge($new)['text'];


                $all_status = self::status();

                $previous_color = $all_status[$old]['color'];
                $current_color = $all_status[$new]['color'];

                switch($style) {
                    case 1:
                        $context = 'Donation status has been updated. <span class="line-through text-'.$previous_color.'">'. $previous .'</span> <span class="text-'.$current_color.' font-bold">' . $current.'</span>';
                    break;

                    case 2:

                        $context = 'Donation status has been updated from <span class="text-'.$previous_color.' font-bold">'. $previous .'</span> to <span class="text-'.$current_color.' font-bold">' . $current.'</span>';
                    break;

                    default:
                        $context = 'Donation status has been updated. <span class="line-through text-'.$previous_color.'">'. $previous .'</span> <span class="text-'.$current_color.' font-bold">' . $current.'</span>';
                    break;
                }

            break;


            case "App\Models\Operations":
                if(!isset($activity->changes['old']) && !isset($activity->changes['old'])) {
                    /**
                     *
                     * This function is executed when Model entries are "created" or "destroyed"
                     *
                     */

                    return "Procurement list entry (#".$activity->subject_id.") has been ". $activity->description;
                }

                $old = $activity->changes['old']['status'];
                $new = $activity->changes['attributes']['status'];

                $previous = OperationsHelper::get_operations_status_badge($old)['text'];
                $current = OperationsHelper::get_operations_status_badge($new)['text'];


                $all_status = self::status();

                $previous_color = $all_status[$old]['color'];
                $current_color = $all_status[$new]['color'];

                switch($style) {
                    case 1:
                        $context = 'Procurement list status has been updated. <span class="line-through text-'.$previous_color.'">'. $previous .'</span> <span class="text-'.$current_color.' font-bold">' . $current.'</span>';
                    break;

                    case 2:

                        $context = 'Procurement list status has been updated from <span class="text-'.$previous_color.' font-bold">'. $previous .'</span> to <span class="text-'.$current_color.' font-bold">' . $current.'</span>';
                    break;

                    default:
                        $context = 'Procurement list status has been updated. <span class="line-through text-'.$previous_color.'">'. $previous .'</span> <span class="text-'.$current_color.' font-bold">' . $current.'</span>';
                    break;
                }
            break;

            default:
                $context = 'Unable to handle activity. Please report this to our team';
            break;

        }


        return $context;
    }
    
    /**
     * getDonation - Get a donation by ID
     *
     * @param  mixed $id
     * @return void
     */
    public static function getDonation($id): Donations {

        return Donations::find($id);

    }
    
    /**
     * getDonationMedia - Get all media files uploaded for a donation
     *
     * @param  mixed $id
     * @return void
     */
    public static function getDonationMedia($id): string
    {
        $d_media = DonationMedia::where('donation_id', $id)->first();        
        return $d_media->media;
    }

    /**
     * imageWatermark - Watermarks an image with the Roshni Foundation logo and text.
     *
     * @param  mixed $imagePath
     * @param  mixed $text
     * @return void
     */
    public static function imageWatermark(string $imagePath, string $text): void
    {
        $image = Image::make($imagePath);
        $watermark = Image::make(self::$watermarkImage);
        $image->insert($watermark, 'bottom-right', 10, 10);
        $image->text($text, 10, $image->height()-10, function ($font) {
            $font->file(public_path('fonts/Roboto-Bold.ttf'));
            $font->size(7);
            $font->color('#ffffff');
        });
        $image->save($imagePath);
    }
    
    /**
     * videoWatermark - Watermarks a video with the Roshni Foundation logo and text.
     *
     * @param  mixed $videoPath
     * @return void
     */
    public static function videoWatermark(string $videoPath): void
    {
        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open($videoPath);
        $video->addWatermark(function (WatermarkFactory $watermark) {
            $watermark->open(self::$watermarkImage)
                ->horizontalAlignment(WatermarkFactory::RIGHT, 10)
                ->verticalAlignment(WatermarkFactory::BOTTOM, 10);
        });
        $video->save($videoPath);
    }

}

?>
