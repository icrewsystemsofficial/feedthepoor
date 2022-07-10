<?php

namespace App\Models;

use App\Models\Users;
use App\Models\Causes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Helpers\DonationsHelper;

class Donations extends Model
{
    use HasFactory, LogsActivity;



    # The attributes we wish to monitor for this model.
    protected static $logAttributes = ['donation_status'];
    // protected static $logName = 'system';

    # We want to log ONLY if there are changes.
    protected static $logOnlyDirty = true;

    # The events we wish to fire the activity log
    protected static $recordEvents = ['updated'];




    protected $table = 'donations';

    protected $fillable = [
        'donor_id',
        'donor_name',
        'donation_amount',
        'donation_in_words',
        'cause_id',
        'campaign_id',
        'cause_name',
        'donation_status',
        'payment_method',
        'razorpay_payment_id',
    ];

    public static $status = [
        'PENDING' => 0,
        'VERIFIED' => 1,
        'FAILED' => 2,
        'REFUNDED' => 3,
        'MISSION ASSIGNED' => 4,
        'FIELD WORK DONE' => 5,
        'PICTURES UPDATED' => 6
    ];

    public static $payment_methods = [
        'UNKNOWN' => 0,
        'CASH' => 1,
        'CHEQUE' => 2,
        'DEMAND DRAFT' => 3,
        'RAZORPAY' => 4,
    ];

    public function donor_id()
    {
        return $this->belongsTo(Users::class, 'donor_id', 'id');
    }

    public function cause_id()
    {
        return $this->belongsTo(Causes::class, 'cause_id', 'id');
    }
    
    public static function Show_Amount_In_Words($num) {
        return DonationsHelper::Show_Amount_In_Words($num);   
    }

}
