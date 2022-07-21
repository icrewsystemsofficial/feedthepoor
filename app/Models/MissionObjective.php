<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class MissionObjective extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'donation_id',
        'assigned_volunteer_id',
        'instructions',
        'media_items',
        'objective_status',
    ];
}
