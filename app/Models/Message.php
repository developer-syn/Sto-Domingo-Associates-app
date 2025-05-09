<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Assuming you'll have a user associated with the message
        'content', // The content of the message
        'is_admin', // Boolean to check if the message is from admin
    ];

    // Define relationships here, if needed
}
