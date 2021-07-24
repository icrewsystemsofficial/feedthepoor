<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempUser extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',  'email', 'unique_code', 'role'
    ];
}
