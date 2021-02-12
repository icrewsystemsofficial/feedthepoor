<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function donations(){
        return $this->belongsTo('App\Donation');
    }
}
