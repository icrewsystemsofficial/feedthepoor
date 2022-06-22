<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class FaqCategories extends Model
{
    use HasFactory, Uuid;

    protected $table = 'faq_categories';

    protected $fillable = [
        'category_name',
        'category_description',
        'category_status',
    ];


}
