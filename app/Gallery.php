<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table="gallerys";

    protected $fillable = [
        'photo', 'caption', 'active'
    ];
}
