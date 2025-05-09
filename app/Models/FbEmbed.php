<?php

// app/Models/FbEmbed.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FbEmbed extends Model
{
    use HasFactory;

    protected $table = 'fb_embeds';

    // Allow mass assignment for these fields
    protected $fillable = ['category', 'embed_code'];
}

