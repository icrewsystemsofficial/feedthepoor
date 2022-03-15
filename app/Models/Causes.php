<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Causes extends Model
{
    use HasFactory;

    protected $table = 'Causes';

    protected $fillable = [
        'name',
        'icon',
        'per_unit_cost',
        'yield_context'
    ];
}
