<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Causes extends Model
{
    use HasFactory, Uuid;

    protected $table = 'causes';

    protected $fillable = [
        'name',
        'icon',
        'per_unit_cost',
        'yield_context'
    ];
}
