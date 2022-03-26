<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use App\Models\Causes;

class Campaigns extends Model
{
    use HasFactory;

    protected $table = 'campaigns';

    protected $fillable = [
        'campaign_name',
        'campaign_description',
        'campaign_poster',
        'is_campaign_goal_based',
        'campaign_goal_amount',
        'campaign_start_date',
        'campaign_end_date',
        'campaign_location',
        'campaign_has_cause',
        'campaign_causes',
        'campaign_status',
    ];

    public function scopeLocations()
    {
        return $this->hasMany(Location::class, 'id');
    }

    public function scopeCauses()
    {
        return $this->hasMany(Causes::class, 'id');
    }

    public static $status = [
        'INACTIVE' => 0,
        'ACTIVE' => 1,
        'PAUSED' => 2,
        'COMPLETED' => 3,
    ];

}
