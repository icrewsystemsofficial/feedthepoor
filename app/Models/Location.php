<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';

    protected $fillable = [
        'location_name',
        'location_description',
        'location_address',
        'location_pin_code',
        'location_latitude',
        'location_longitude',
        'location_manager_id',
        'location_status',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'location_manager_id');
    }
}
