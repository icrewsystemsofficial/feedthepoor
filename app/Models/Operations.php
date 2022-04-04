<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operations extends Model
{
    use HasFactory;

    protected $table = 'operations';

    protected $fillable = [
        'donation_id',
        'procurement_item',
        'procurement_quantity',
        'vendor',
        'status',
        'last_updated_by',
        'mission_id',
    ];
}
