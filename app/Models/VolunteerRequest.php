<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerRequest extends Model
{
    use HasFactory;

    protected $table = 'volunteer_request';

    protected $fillable = [
           'name',
           'age',
           'email',
           'number',
           'organization',
           'state',
           'city',
           'address',
           'pincode',
           'experience',
           'education',
           'reason',
           'facebook',
           'instagram',
           'twitter'
    ];
}
