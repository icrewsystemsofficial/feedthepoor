<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// This is the table for procurements.

class Operations extends Model
{
    use HasFactory, LogsActivity;

    # The attributes we wish to monitor for this model.
    protected static $logAttributes = ['status'];
    // protected static $logName = 'system';

    # We want to log ONLY if there are changes.
    protected static $logOnlyDirty = true;

    # The events we wish to fire the activity log
    protected static $recordEvents = ['updated'];

    protected $table = 'operations';

    protected $fillable = [
        'donation_id',
        'location_id',
        'procurement_item',
        'procurement_quantity',
        'vendor',
        'status',
        'last_updated_by',
        'mission_id',
    ];

    public static $status = [

        'UNACKNOWLEDGED' => 0,
        'ACKNOWLEDGED' => 1,
        'PROCUREMENT ORDER INITIATED' => 2,
        'DELAYED' => 3,
        'READY FOR MISSION DISPATCH' => 4,
        'ASSIGNED TO MISSION' => 5,
        'FULFILLED' => 6,

    ];
}
