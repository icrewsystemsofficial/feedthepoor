<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleAccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_name',
        'module_controller_class',
        'module_route_path',
        'permissions_that_can_access',
    ];
}
