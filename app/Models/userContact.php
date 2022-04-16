<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// TO BE REFACTORED! NAME OF MODELs should ALWAYS be Singular, and should begin with Capital letters.
class UserContact extends Model
{
    use HasFactory;

    protected $table = 'user_contacts';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'status',
    ];
}
