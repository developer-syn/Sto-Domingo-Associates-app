<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Assuming you'll store user information
        'request_data', // Data related to the user request
        'status', // Status of the request (pending, accepted, etc.)
    ];

    // Define relationships here, if needed
}
