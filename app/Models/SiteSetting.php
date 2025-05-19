<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $table = 'site_settings';

    protected $fillable = [
        'email',
        'phone',
        'address',
        'twitter_link',
        'linkedin_link',
        'facebook_link',
        'logo_image',
        'hero_image',
        'hero_image2',
        'hero_text1',
        'hero_text2',
        'hero_text3',
        'youtube_video_link',
        'youtube_text1',
        'youtube_text2',
        'youtube_text3',
        'footer_text',
        'website_url',
    ];
}
