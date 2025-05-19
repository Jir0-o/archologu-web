<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_image1',
        'hero_image2',
        'hero_title',
        'hero_text',
        'our_history',
        'dg_image',
        'dg_name',
        'mission_vision',
    ];
}
