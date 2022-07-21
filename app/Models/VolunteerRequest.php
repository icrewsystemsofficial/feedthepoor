<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class VolunteerRequest extends Model
{
    use HasFactory, Uuid;

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
