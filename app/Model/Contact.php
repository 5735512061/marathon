<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = 'contacts';

	protected $fillable = [
    	'admin_id', 'phone', 'facebook', 'facebook_url', 'youtube', 'youtube_url', 'ig', 'ig_url', 'twitter', 'twitter_url', 'tiktok', 'tiktok_url'
    ];

    protected $primaryKey = 'id';
}
