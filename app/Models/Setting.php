<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Setting extends Model
{
    use HasFactory, Uuid;

    protected $table = 'setting';

    protected $fillable = [    
        'group_id',
        'key',
        'name',
        'description',
        'value',
        'core',
        'type',
    ];

    

}
