<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class MissionAssignment extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'mission_id',
        'user_id',
        'status',
    ];

    public static $status = [
        'PENDING' => 0,
        'ACCEPTED' => 1,
        'REJECTED' => 2,
    ];
}
