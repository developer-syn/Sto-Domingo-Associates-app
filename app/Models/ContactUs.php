<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    // Define the table associated with this model
    protected $table = 'contact_us';

    // Enable mass assignment for these fields
    protected $fillable = [
        'inquiry_type',
        'job_type',
        'manager_name',
        'branch',
        'hear_from_us',
        'name',
        'email',
        'phone',
        'message',
        'specify_manager', // Add this line
        'specify_branch', // Add this line
    ];
}

