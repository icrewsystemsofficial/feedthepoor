<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class DonationMedia extends Model
{
    use HasFactory, Uuid;

    protected $table = 'donations_media';

    protected $fillable = [
        'donation_id',
        'media',
        'last_modified_by',
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
    
    
}
