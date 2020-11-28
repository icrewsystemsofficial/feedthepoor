<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class addvolunteers extends Model
{
    //
    protected $table = 'addvolunteers';
    protected $fillable = ['name','location', 'desc','facebook','instagram','linkedin','image'];
}
