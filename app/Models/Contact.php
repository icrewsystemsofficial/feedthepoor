<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;


class Contact extends Model
{
    use HasFactory, Uuid;

    protected $table = 'user_contacts';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'status',
    ];
}
