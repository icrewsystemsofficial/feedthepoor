<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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


    /*
        Location::$status returns an array.
        If you want to access a specific status,
        you can do so by:

        Location::$status['INOPERATIONAL'];

        Modify the CSS & HTML rendering for this in
        "app/Helpers/LocationHelpers.php"


        - Leonard,
        9th March, 2022

        @return array
    */
    public static $status = [
        'INOPERATIONAL' => 0,
        'ACTIVE' => 1,
        'INACTIVE' => 2,
        'PERMANENTLY_CLOSED' => 3,
        'PROCESSING' => 4,
    ];

    public function user(){
        return $this->belongsTo(User::class, 'location_manager_id', 'id');
    }

}
