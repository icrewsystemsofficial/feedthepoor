<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class FaqEntries extends Model
{
    use HasFactory, Uuid;

    protected $table = 'faq_entries';

    protected $fillable = [
        'category_id',
        'entry_question',
        'entry_answer',
        'author_name',        
    ];
}
