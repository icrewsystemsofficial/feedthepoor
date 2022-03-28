<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD:app/Models/Contact.php
class Contact extends Model
=======
// TO BE REFACTORED! NAME OF MODELs should ALWAYS be Singular, and should begin with Capital letters.
class userContact extends Model
>>>>>>> c59e8dbebb0aad057ecb9195d09bace58220fc59:app/Models/userContact.php
{
    use HasFactory;

    protected $table = 'user_contacts';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'status',
    ];
}
