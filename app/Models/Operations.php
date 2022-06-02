<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// This is the table for procurements.

class Operations extends Model
{
    use HasFactory;

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
