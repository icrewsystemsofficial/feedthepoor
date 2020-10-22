<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testmonial extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'name','email','message','status'
  ];

  /** About Status
  * Status 0: Default Submission: Not Yet Approved
  * Status 1: Approved to be shown on Testimonials List Page but not on Home Page Slider
  * Status 2: Approved to be shown on Testimonials List Page and on Home Page Slider
  */

  protected $table = 'testimonials';
}
