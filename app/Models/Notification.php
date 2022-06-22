<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Notification extends Model
{
    use HasFactory, Uuid;

    protected $table = 'notifications';

    /**
     * types - types of notifications.
     *
     * @var array
     */
    public static $types = [
        'APP' => '0',
        'MAIL' => '1',
        'ALL' => '3',
    ];
}
