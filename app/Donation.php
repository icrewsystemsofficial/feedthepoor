<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $table= 'donations';

    public function images(){
        return $this->hasMany('App\Image');
    }

}
