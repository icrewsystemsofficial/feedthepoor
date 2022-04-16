<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionObjective extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_id',
        'assigned_volunteer_id',
        'instructions',
        'media_items',
        'objective_status',
    ];
}
