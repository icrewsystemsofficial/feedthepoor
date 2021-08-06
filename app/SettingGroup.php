<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingGroup extends Model
{
    use HasFactory;
    protected $table = 'settings_group';
    protected $fillable = [
        'name',
        'description',
    ];
}
