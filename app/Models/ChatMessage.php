<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    // Add the new fields to the fillable array
    protected $fillable = ['sender', 'message', 'user_sender', 'admin_sender'];
}
